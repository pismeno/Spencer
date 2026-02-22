<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $allSettings = Setting::with('options')->get();
        
        $currentSelect = Auth::user()->settings()->pluck('setting_options.id')->toArray();

        return view('settings', compact('allSettings', 'currentSelect'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'options' => 'nullable|array',
            'options.*' => 'exists:setting_options,id',
        ]);

        $optionsID = array_values($request->input('options', []));
        
        // sync

        Auth::user()->settings()->sync($optionsID);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
