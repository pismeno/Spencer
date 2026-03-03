<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Factory|View
    {
        return view('notifications');
    }

    /**
     * get user's notifications.
     */
    public function list(Request $request): JsonResponse // TODO maybe this should be standardized?
    {
        return response()->json([
            'unread' => $request->user()->unreadNotifications,
            'all'    => $request->user()->notifications()->paginate(10) // TODO forgot what this does, maybe should rework?
        ]);
    }

    /**
     * Mark a notification as read.
     */
    public function read(Notification $notification): JsonResponse
    {
        if ($notification->notifiable_id !== auth()->id()) {
            abort(403, 'Neoprávněná akce.');
        }

        $notification->markAsRead();

        return response()->json([
                'message' => 'Notification was marked as read successfully.',
                'data' => $notification
            ]
        );
    }

    /**
     * Mark all user's notifications as read.
     */
    public function readAll(): JsonResponse
    {
        $notifications = auth()->user()->unreadNotifications;
        $notifications->markAsRead();

        return response()->json([
            'message' => 'All notifications were marked as read successfully.',
            'data' => $notifications
        ]);
    }
}
