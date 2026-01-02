<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //Display a listing of the resource.
    public function index()
    {
        $tasks=Task::latest()->get();
        return view('tasks.index',compact('tasks'));
    }

    //creating a new resource.
   public function create()
    {   
        return view('tasks.create');
    }

    //Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 0
         ]);

        return redirect()->route('tasks.index')->with('success', 'Task added successfully');
    }
    

     //Show the form for editing the specified resource.
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

   
    //Update the specified resource in storage.
    
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }


    //Remove the specified resource from storage.
    
   public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }


    //Task completion.

    public function complete(Task $task)
    {
        $task->update([
            'status' => 1
        ]);

        return redirect()->route('tasks.index');
    }

}
