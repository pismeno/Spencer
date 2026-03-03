<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Membership;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GroupController extends Controller
{
    protected SearchService $searchService;

    public function __construct(SearchService $groupService)
    {
        $this->searchService = $groupService;
    }

    public function search(Request $request): JsonResponse
    {
        return response()->json($this->searchService->groups($request));
    }

    public function index(): View
    {
        $groups = auth()->user()->groups()->with('users')->get();
        return view('group', compact('groups'));
    }

    public function store(Request $request): JsonResponse
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:128'],
                'description' => ['nullable', 'string'],
                'users_ids' => ['nullable', 'array'],
                'users_ids.*' => ['exists:users,id']
            ]);

            $group = Group::create([
                'name' => $data['name'],
                'description' => $data['description']
            ]);

            $group->users()->attach(auth()->id(), [
                'role_id' => Role::first()->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $requester = auth()->user();

            if (!empty($data['users_ids'])) {
                foreach ($data['users_ids'] as $userId) {
                    if ($userId == $requester->id) continue;

                    $this->storeMember($userId, $group);
                }
            }

            return response()->json(['message' => 'Created'], 200);
        });
    }

    public function update(Request $request, Group $group): JsonResponse
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:128'],
            'description' => ['nullable', 'string'],
        ]);

        $requester = auth()->user();

        if (!$this->hasRole($requester, $group, 'owner') && !$this->hasRole($requester, $group, 'cashier')) {
            abort(403, 'Unauthorized action.');
        }

        $group->update($request->only(['name', 'description']));

        return response()->json(['message' => 'Updated'], 200);
    }

    public function addMembers(Request $request, Group $group): JsonResponse
    {
        $data = $request->validate([
            'users_ids' => ['nullable', 'array'],
            'users_ids.*' => ['exists:users,id']
        ]);

        $requester = auth()->user();

        if (!$this->hasRole($requester, $group, 'owner') && !$this->hasRole($requester, $group, 'cashier')) {
            abort(403, 'Unauthorized action.');
        }

        if (!empty($data['users_ids'])) {
            foreach ($data['users_ids'] as $userId) {
                if ($userId == $requester->id) continue;
                if ($this->isMember($userId, $group)) continue;

                $this->storeMember($userId, $group);
            }
        }

        return response()->json(['message' => 'Members added'], 200);
    }

    public function destroyMembers(Request $request, Group $group): JsonResponse
    {
        $data = $request->validate([
            'users_ids' => ['nullable', 'array'],
            'users_ids.*' => ['exists:users,id']
        ]);

        if (!$this->hasRole(auth()->user(), $group, 'owner') && !$this->hasRole(auth()->user(), $group, 'cashier')) {
            abort(403, 'Unauthorized action.');
        }

        if (!empty($data['users_ids'])) {
            $group->users()->detach($data['users_ids']);
        }

        return response()->json(['message' => 'Deleted'], 200);
    }

    public function destroy(Group $group): JsonResponse
    {
        $group->delete();
        return response()->json(['message' => 'Deleted'], 200);
    }

    private function hasRole(Authenticatable $user, Group $group, string $roleName): bool
    {
        $membership = $this->userMembership($user, $group);

        return $membership && $membership->role->name === $roleName;
    }

    private function userMembership(Authenticatable $user, Group $group): ?Membership
    {
        return Membership::where('user_id', $user->id)
            ->where('group_id', $group->id)
            ->first();
    }

    private function isMember(int $userId, Group $group): bool
    {
        return Membership::where('user_id', $userId)
            ->where('group_id', $group->id)
            ->exists();
    }

    private function storeMember(int $userId, Group $group): void
    {
        $group->users()->attach($userId, [
            'role_id' => Role::first()->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
