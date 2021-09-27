<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = \App\Models\Todo::orderBy('created_at' , 'desc')->get();
        return view('index')->with('todos' , $todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'new_todo_title' => 'required',
            'new_todo_due' => 'required',
            'new_todo_content' => 'required',
        ],[
            'new_todo_title.required' => 'Title is required.',
            'new_todo_due.required' => 'Due is required.',
            'new_todo_content.required' => 'Content is required.',
        ]);

        $todo = new \App\Models\Todo();
        $todo->title = $request->input('new_todo_title');
        $todo->due = $request->input('new_todo_due');
        $todo->content = $request->input('new_todo_content');
        $todo->save();

        return redirect('/')->with('success' , 'Todo created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = \App\Models\Todo::find($id);

        return view('show')->with('todo',$todo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = \App\Models\Todo::find($id);
        return view('edit')->with('todo',$todo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request , [
            'new_todo_title' => 'required',
            'new_todo_due' => 'required',
            'new_todo_content' => 'required',
        ],[
            'new_todo_title.required' => 'Title is required.',
            'new_todo_due.required' => 'Due is required.',
            'new_todo_content.required' => 'Content is required.',
        ]);

        $todo = \App\Models\Todo::find($id);
        $todo->title = $request->input('new_todo_title');
        $todo->due = $request->input('new_todo_due');
        $todo->content = $request->input('new_todo_content');
        $todo->save();

        return redirect('/')->with('success' , 'Todo updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = \App\Models\Todo::find($id);
        $todo->delete();
        return redirect('/')->with('success' , 'Todo deleted successfully!');

    }
}
