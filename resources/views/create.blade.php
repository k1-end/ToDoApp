@extends('layouts.app')

@section('content')
<h1>Create new todo</h1>
<form method="POST" action="/todo">
    @csrf
  <div class="form-group">
    <label>Title</label>
    <input id="new_todo_title" name="new_todo_title" class="form-control" placeholder="Enter todo title">
  </div>
  <div class="form-group">
    <label >Due</label>
    <input id="new_todo_due" name="new_todo_due" class="form-control" placeholder="Due">
  </div>
  <div class="form-group">
    <label>Content</label>
    <textarea id="new_todo_content" name="new_todo_content" class="form-control" cols="30" rows="10"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection