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

/**
 * This is a Route with closure function
Route::get('/', function () {
    return view('welcome');
});
 */

/**
 * Controller => PostsController
 * Eloquent Model => Post
 * Migration => create_posts_table
 * php artisan make:model Post -mc
 */
Route::get('/', 'PostsController@index');

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