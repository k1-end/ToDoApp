@extends('layouts.app')

@section('content')
<h2> {{$todo->title}} </h2>

<span>{{$todo->due}}</span>

<p>{{$todo->content}}</p>

<a href="{{$todo->id}}/edit" class="btn">Edit</a>
<form method="POST" action="{{url('/todo/' . $todo->id)}}">
    @csrf
    @method('Delete')
    <input type="submit" value="Delete" class="btn btn-danger">
</form>

@endsection