<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Resolve the Service Container Binding out of container with ::make() Facade or resolve() helper function
//$stripe = App::make('App\Billing\Stripe');        // using App::make() Facade
//$stripe = resolve('App\Billing\Stripe');     // using resolve() helper function

//dd($stripe);
/**
 * This is a Route with closure function
Route::get('/', function () {
    return view('welcome');
});
 */

/**
 * Controller       => PostsController
 * Eloquent Model   => Post
 * Migration        => create_posts_table
 * php artisan make:model Post -mc
 *
 * View             GET         /posts
 * Create           GET         /posts/create
 * Submit           POST        /posts/
 * View Specific    GET         /posts/{id}
 * Edit             GET         /posts/{id}/edit
 * Submit Edit      PATCH       /posts/{id}
 * Delete           DELETE      /posts/{id}
 */
Route::get('/', 'PostsController@index')->name('home');     // naming the route as 'home'
Route::get('/posts/create', 'PostsController@create');
Route::post('/posts', 'PostsController@store');
Route::get('/posts/{post}', 'PostsController@show');

Route::post('/posts/{post}/comments', 'CommentsController@store');

Route::get('/register', 'RegistrationController@create');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

// Passing data to View
Route::get('/about', function () {
    return view('about', [
        'name' => ''
    ]);
});

/**
 * Pass Data to View
 * can be passed by second argument like below or
 * return view('passdata')->with('name', 'World');      // or
 * if stored as a variable like
 * $name = 'World';
 * return view('passdata', compact('name'));            // equivalent to return view('passdata', ['name' => $name]);
 */
Route::get('/passdata', function () {
    $tasks = [
        'go to the store',
        'finish my screencas',
        'clean the house',
    ];

    return view('passdata', [
        'name' => 'World',
        'tasks' => $tasks,
    ]);
});

Route::get('/tasks', 'TasksController@index');

/**
 * Route Model Binding
 * wild card {task} variable must match with variable name '$task' in the Controller show method.
 * Specify the param type in method: Task
 */
Route::get('/tasks/{task}', 'TasksController@show');