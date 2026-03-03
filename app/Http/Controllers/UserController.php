<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected SearchService $searchService;

    public function __construct(SearchService $userService)
    {
        $this->searchService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function search(Request $request): JsonResponse
    {
        return response()->json($this->searchService->users($request));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    public function delete(Request $request): RedirectResponse
    {
        $user = Auth::user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function updateProfile(Request $request): JsonResponse
    {
        if ($request->has('delete_avatar')) {
            auth()->user()->update(['avatar_url' => null]);
            return response()->json(['status' => 'success', 'path' => null]);
        }

        $data = $request->validate([
            'first_name' => 'sometimes|nullable|string|max:255',
            'last_name' => 'sometimes|nullable|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('avatars', 'public');
            $data['avatar_url'] = $path;
            unset($data['profile_picture']);
        }

        Auth::user()->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Profile Updated',
            'path' => Auth::user()->avatar_url
        ]);
    }
}
