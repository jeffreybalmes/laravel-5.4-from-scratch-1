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

    /**
     * Route Model Binding
     * Specify the param type: Task, match wildcard {tasks} with param variable name $tasks
     * @param Task $task
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Task $task)
    {
        //$task = Task::find($tasks);
        return $task;

        //dd($task);        // die and dump.. will also show the value of the variable.
        //return view('tasks.show', compact('task'));
    }
}
