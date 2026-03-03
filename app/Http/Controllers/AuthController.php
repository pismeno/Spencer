<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Registers new user and logs them in.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => [
                'required',
                'email',
                'unique:users',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                ],
        ]);

        $user = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        return response()->json(['message' => 'Created'], 201);
    }

    /**
     * Responds to login requests, if valid credentials are passed in $request, it logs the user in.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
            ],
        ]);

        $attempt = Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        if ($attempt) {
            $request->session()->regenerate();

            $user = auth()->user();

            return response()->json([
                'message' => 'Přihlášení proběhlo úspěšně',
                'user' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                    'avatar_url' => $user->avatar_url,
                ]
            ], 200);
        }

        return response()->json([
            'message' => 'No account matches with the given credentials.'
        ], 401);
    }

    /**
     * Logs out the currently authenticated user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out'], 200);
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
