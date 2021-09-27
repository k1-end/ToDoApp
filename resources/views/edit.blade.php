@extends('layouts.app')

@section('content')
<h1>Edit todo</h1>
<form method="POST" action="{{url('/todo/'.$todo->id)}}">
    @csrf
    @method('PUT')
  <div class="form-group">
    <label>Title</label>
    <input id="new_todo_title" name="new_todo_title" class="form-control" placeholder="Enter todo title" value="{{$todo->title}}">
  </div>
  <div class="form-group">
    <label >Due</label>
    <input id="new_todo_due" name="new_todo_due" class="form-control" placeholder="Enter Due"  value="{{$todo->due}}">
  </div>
  <div class="form-group">
    <label>Content</label>
    <textarea id="new_todo_content" name="new_todo_content" class="form-control" cols="30" rows="10" placeholder="Enter content" >{{$todo->content}}</textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection