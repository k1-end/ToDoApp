@extends('layouts.app')

@section('content')
    @if(count($todos) > 0)
        @foreach($todos as $t)
            <div class="card">
                <h2>{{$t->title}}</h2>
                <section>{{$t->content}}</section>
                <span class="label label-danger">{{$t->due}}</span>
            </div>
        @endforeach
    @endif
@endsection