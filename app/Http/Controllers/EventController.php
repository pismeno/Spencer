<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Event;
use App\Models\Membership;
use App\Services\SearchService;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;

class EventController extends Controller
{
    protected SearchService $searchService;

    public function __construct(SearchService $userService)
    {
        $this->searchService = $userService;
    }

    /**
     * Search for both Users and Groups in one request, used for event assignment
     */
    public function listUsersAndGroups(Request $request) : JsonResponse
    {
        $groupIDs = auth()->user()->groups()->pluck('groups.id');
        $users = $this->searchService->users($request);
        $groups = $this->searchService->groups($request)
        ->whereIn('id', $groupIDs)
        ->values();

        return response()->json([
            'users' => $users,
            'groups' => $groups,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'min:1']
        ]);

        $requester = auth()->user();
        $groupIDs = $requester->groups()->pluck('groups.id');

        if (!$request->filled('title')) {
            return response()->json($this->relatedEvents($requester, $groupIDs));
        }

        $events = Event::with('group')
        ->whereIn('group_id', $groupIDs)
        ->whereLike('title', '%' . $data['title'] . '%')
        ->latest()
        ->get();

        return response()->json($events);
    }
    public function relatedEvents(Authenticatable $user, $groupIDs)
    {
        return Event::with('group')
        ->whereIn('group_id', $groupIDs)
        ->latest()
        ->get();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
         return view('event');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:256'],
            'description' => ['required', 'string'],
            'deadline' => ['nullable', 'date'],
            'from' => ['required', 'date'],
            'to' => ['required', 'date'],
            'group_id' => ['required', 'integer', 'exists:groups,id'],
            'img' => ['nullable', 'image', 'max:4096']
        ]);
        $imgPath = null;
        if ($request->hasFile('img')) {
            $imgPath = $request->file('img')->store('thumbnails', 'public');
        }

        $event = Event::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'deadline' => $data['deadline'],
            'starts_at' => $data['from'],
            'ends_at' => $data['to'],
            'group_id' => $data['group_id'],
            'thumbnail_url' => $imgPath
        ]);

        $memberships = $event->group->memberships;

        foreach ($memberships as $membership) {
            Attendance::create([
                'membership_id'  => $membership->id,
                'event_id' => $event->id,
                'attends' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return back();
    }

    /**
     * Show
     */
    public function show(Event $event)
    {
        $user = auth()->user();

        if (!$user->groups->contains($event->group_id)) {
            return back();
        }

        return view('detail', compact('event'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event): RedirectResponse
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:256'],
            'description' => ['required', 'string'],
            'deadline'    => ['nullable', 'date'],
            'from'        => ['required', 'date'],
            'to'          => ['required', 'date'],
            'img'         => ['nullable', 'image', 'max:4096']
        ]);

        if ($request->hasFile('img')) { // TODO img deletion!!!!!!
            $data['img_path'] = $request->file('img')->store('thumbnails', 'public');
        }

        $event->update([
            'title'       => $data['title'],
            'description' => $data['description'],
            'deadline'    => $data['deadline'],
            'starts_at'   => $data['from'], // Use 'from'
            'ends_at'     => $data['to'],   // Use 'to'
            'thumbnail_url'    => $data['img_path'] ?? $event->img_path,
        ]);

        // Placeholder response
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }

    /**
     * Set attendance of user for event
     */
    public function setAttendance(Request $request, Event $event): RedirectResponse
    {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'attends' => ['required', 'boolean']
        ]);

        $membership = Membership::where('user_id', $data['user_id'])
            ->where('group_id', $event->group_id)
            ->first();

        if (!$membership) {
            return back()->withErrors(['user_id' => 'User is not a member of this group.']);
        }

        $attendance = Attendance::where('event_id', $event->id)
            ->where('membership_id', $membership->id)
            ->first();

        if ($attendance) {
            $attendance->attends = $data['attends'];
            $attendance->save();
        }

        return back();
    }
}
