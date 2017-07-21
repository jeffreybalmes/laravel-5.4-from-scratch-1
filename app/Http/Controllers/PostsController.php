<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts.index');     // posts/index.blade.php
    }

    public function create()
    {
        return view('posts.create');    // posts/create.blade.php
    }

    public function store()
    {
        //dd(request()->all());                 // see what contains in request() data.
        //dd(request('body'));                  // request just the title
        //dd(request(['title', 'body']));       // request just the title and the body
        // Create a new post using the request data.
        // Save it to the database.
        // And then redirect to the home page...
    }
}
