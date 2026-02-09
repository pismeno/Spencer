<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['nullable', 'string', 'min:1'],
        ]);

        $requester = auth()->user();

        if (!$request->filled('email')) {
            return response()->json($this->relatedUsers($requester));
        }

        $users = User::whereLike('email', '%' . $request->email . '%')
            ->where('id', '!=', $requester->id)
            ->limit(10)
            ->get();

        return response()->json($users);
    }

    //TODO: implement actual logic
    private function relatedUsers(Authenticatable $user): array
    {
        return [];
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }
}
