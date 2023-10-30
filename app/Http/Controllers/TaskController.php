<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;

        $tasklist = Task::select('tasks.*', 'users.name as username')
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->where('tasks.user_id', $user_id) 
            ->orderBy('tasks.id', 'ASC')
            ->get();
          return view('task.index',compact('tasklist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $userlist = User::orderBy('id', 'ASC')->get();
        return view('task.create',compact('userlist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required', 
        ]);

        Task::create($request->all());
        return redirect()->route('task')->with('success','Task added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $userlist = User::orderBy('id', 'ASC')->get();
        $task=Task::where('id', $id)->firstOrFail();

         return view('task.edit',compact('task','userlist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required', 
        ]);

        Task::where('id', '=', $id)->update(
            ['title' => $request->title,'description' => $request->description,'user_id' => $request->user_id,'completed' => $request->completed]);      
        return redirect()->route('task')->with('success','Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::where('id', $id)->delete();
        return redirect()->route('task')->with('success','Task deleted successfully');

    }
}
