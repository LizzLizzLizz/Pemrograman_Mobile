<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Http\Requests\StoreNotificationRequest;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    // List all notifications (Admin only)
    public function index()
    {
        $this->authorize('viewAny', Notification::class);
        $notifications = Notification::with('user')->get();
        return response()->json($notifications, Response::HTTP_OK);
    }

    // Show details of a specific notification (Admin only)
    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        $this->authorize('view', $notification);
        return response()->json($notification, Response::HTTP_OK);
    }

    // Store a new notification (Admin only)
   public function store(StoreNotificationRequest $request)
{
    $user = auth()->user();

    if (!$user) {
        return response()->json(['error' => 'Unauthorized - no user authenticated'], 401);
    }

    // Debug
    \Log::info('Authenticated user:', ['user_id' => $user->id, 'email' => $user->email]);

    $validated = $request->validated();

    $notification = Notification::create([
        'title' => $validated['title'],
        'message' => $validated['message'],
        'user_id' => $user->id,
    ]);

    return response()->json($notification, Response::HTTP_CREATED);
}



    // Delete a notification (Admin only)
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $this->authorize('delete', $notification);
        $notification->delete();
        return response()->json(['message' => 'Notification deleted successfully.'], Response::HTTP_OK);
    }
}
