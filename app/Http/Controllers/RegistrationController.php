<?php

namespace App\Http\Controllers;

use App\User;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store()
    {
        // validate the form
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password'=> 'required|confirmed',
        ]);

        // create and save the user.
        //$user = User::create(request(['name', 'email', bcrypt('password')]));
        $user = User::create([
            'name' => request('name'),
            'email'=> request('email'),
            'password' => bcrypt(request('password'))
        ]);

        // sign them in
        //\Auth::login();       // to use Facade, must import 'use Auth' at top of class,
        auth()->login($user);   // auth() function can directly be called.

        // redirect to the home page.
        //return redirect('/');
        return redirect()->home();  // redirect to named route 'home' in web.php
    }
}