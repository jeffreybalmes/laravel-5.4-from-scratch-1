<?php

namespace App\Http\Controllers;

use App\Task;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::all();

        //return $tasks;  // this will automatically cast to json format in the page. easier for APIs
        return view('tasks.index', compact('tasks'));
    }

    public function show($id)
    {
        $task = Task::find($id);

        //dd($task);        // die and dump.. will also show the value of the variable.
        return view('tasks.show', compact('task'));
    }
}
