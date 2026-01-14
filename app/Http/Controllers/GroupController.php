<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Group;
use App\Models\Membership;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request): RedirectResponse
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validated();

            // Create the group
            $group = Group::create($data);

            // Prepare memberships
            $memberships = [];

            // Add the Owner
            $memberships[] = [
                'group_id' => $group->id,
                'user_id'  => auth()->id(),
                'role_id'  => Role::fromEnum(Roles::OWNER)->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Add the Members
            if (!empty($data['users_ids'])) {
                $memberRoleId = Role::fromEnum(Roles::MEMBER)->id;
                foreach ($data['users_ids'] as $userId) {
                    $memberships[] = [
                        'group_id' => $group->id,
                        'user_id'  => $userId,
                        'role_id'  => $memberRoleId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            Membership::insert($memberships);

            return back()->with('success', 'Group created successfully!');
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:128'],
            'description' => ['nullable', 'string'],
        ]);

        $group->update($data);

        // Placeholder response
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
}
