<?php

namespace App\Http\Controllers;

use App\Models\Event;
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

        // return response()->json([   
        //     'users'  => $this->searchService->users($request),
        //     'groups' => $this->searchService->groups($request)->whereIn('group_id', $groupIDs),
        // ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function list(Request $request): JsonResponse
    {   
        $request->validate([
            'title' => ['nullable', 'string', 'min:1']
        ]);

        $requester = auth()->user();
        $groupIDs = $requester->groups()->pluck('groups.id');

        if (!$request->filled('title')) {
            return response()->json($this->relatedEvents($requester, $groupIDs));
        }  

        $events = Event::with('group')
        ->whereIn('group_id', $groupIDs)
        ->whereLike('title', '%' . $request->title . '%')
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
            'group_id' => ['required', 'integer'],
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

        return back(); // zatim nic
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
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
}
