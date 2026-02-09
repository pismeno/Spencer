<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SearchService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    public function list(Request $request): JsonResponse
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
}
