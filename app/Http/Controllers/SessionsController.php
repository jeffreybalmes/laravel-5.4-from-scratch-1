<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->home();
    }

    public function store()
    {
        // Attempt to authenticate the user
        if (! (auth()->attempt(request(['email', 'password'])))) {
            return back()->withErrors([
                'message' => 'Please check your username and password.'
            ]);
        }
        // If not, redirect back.

        // If so, sign them in
        // Redirect to the home page.
        return redirect()->home();
    }
}
