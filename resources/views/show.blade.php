@extends('layouts.app')

@section('content')
<h2> {{$todo->title}} </h2>

<br>
<span class="badge badge-info">{{$todo->due}}</span>

<p>{{$todo->content}}</p>

<a href="{{$todo->id}}/edit" class="btn btn-info">Edit</a>
<form method="POST" action="{{url('/todo/' . $todo->id)}}" class="float-right">
    @csrf
    @method('Delete')
    <input type="submit" value="Delete" class="btn btn-danger">
</form>

@endsection