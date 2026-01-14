<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;



class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
         return view('test/createevent');
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
            'starts_at' => ['required', 'date'],
            'ends_at' => ['required', 'date'],
            'group_id' => ['required', 'integer']
        ]);

        $event = Event::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'deadline' => $data['deadline'],
            'starts_at' => $data['starts_at'],
            'ends_at' => $data['ends_at'],
            'group_id' => $data['group_id']
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
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
