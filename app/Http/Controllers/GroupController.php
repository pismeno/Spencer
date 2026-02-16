<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Role;
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

    /**
     * Display a listing of the resource.
     */
    public function list(Request $request): JsonResponse
    {
        return response()->json($this->searchService->groups($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $user)
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $groups = auth()->user()->groups()->with('users')->get();

        return view('group', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('test/creategroup');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:128'],
                'description' => ['nullable', 'string'],
                'users_ids' => ['nullable', 'array'],
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

            if (!empty($data['users_ids'])) {
                foreach ($data['users_ids'] as $userId) {
                    if ($userId != auth()->id()) {
                        $group->users()->attach($userId, [
                            'role_id' => Role::first()->id,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }
            }

            return response()->json(['message' => 'Created'], 201);
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        return DB::transaction(function () use ($request, $group) {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:128'],
                'description' => ['nullable', 'string'],
                'users_ids' => ['nullable', 'array'],
            ]);

            $group->update([
                'name' => $data['name'],
                'description' => $data['description']
            ]);

            $newMembers = $data['users_ids'] ?? [];
            if (!in_array(auth()->id(), $newMembers)) {
                $newMembers[] = auth()->id();
            }

            $syncData = [];
            foreach ($newMembers as $id) {
                $syncData[$id] = ['role_id' => Role::first()->id];
            }
            $group->users()->sync($syncData);

            return response()->json(['message' => 'Updated']);
        });
    }
}
