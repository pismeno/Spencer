<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request) : string
    {
        $incomingFields = $request->validate([
            'name' => ['required', 'min:3', 'max:50'],
            'email' => 'required',
            'password' => 'required'
        ]);
        return 'hello from controller';
    }
}
