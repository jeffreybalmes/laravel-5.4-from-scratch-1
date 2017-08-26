<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Carbon\Carbon;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
//        $posts = Post::latest()->get();
//
//        if ($month = request('month')) {
//            $posts->whereMonth('created_at', Carbon::parse($month)->month);
//        }
//
//        if ($year = request('year')) {
//            $posts->whereYear('created_at', $year);
//        }
//
//        $posts = $posts->get();

        // Above can be refactored as:
        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->get();

        $archives = Post::selectRaw('year(created_at) year, monthname(created_at) month, count(*) published')
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at)')
            ->get()
            ->toArray();


        return view('posts.index', compact('posts', 'archives'));     // posts/index.blade.php
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

        // Validate the input data (server side validation), redirects to same page when validation fails.
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ]);

        /**
        // Create a new post using the request data.
        $post = new Post;=
        $post->title = request('title');
        $post->body = request('body');
        // Save it to the database.
        $post->save();
        */
        /**
        // All the above creating and saving post to database can be done by following with $fillable section in Post Model
        Post::create([
            'title' => request('title'),
            'body' => request('body'),
        ]);
        */

        /*
        // Again, the above can also be done this way.
        Post::create([
            'title' => request('title'),
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);
        */

        // Once again, the above can be done following way as well.
        auth()->user()->publish(
            new Post(request(['title', 'body']))
        );

        // And then redirect to the home page...
        return redirect('/');
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
