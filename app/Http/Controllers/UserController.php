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
}
