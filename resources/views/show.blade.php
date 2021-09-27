@extends('layouts.app')

@section('content')
<h2> {{$todo->title}} </h2>

<span>{{$todo->due}}</span>

<p>{{$todo->content}}</p>

@endsection