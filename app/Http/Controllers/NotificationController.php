<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function list(Request $request): JsonResponse
    {
        return response()->json([
            'unread' => $request->user()->unreadNotifications,
            'all'    => $request->user()->notifications()->paginate(10)
        ]);
    }

    public function read(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required', 'integer'],
        ]);

        auth()->user()->unreadNotifications->where('id', $data['id'])->markAsRead();
        return back();
    }

    public function readAll(): RedirectResponse
    {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    }
}
