@extends('layouts.app')

@section('content')
    @if(count($todos) > 0)
        @foreach($todos as $t)
            <div class="card p-2 m-2">
                <h2><a href="/todo/{{$t->id}}">{{$t->title}}</a></h2>
				<div class="card-title">
				<span class="card-header badge badge-info ">{{$t->due}}</span>
				</div>
                <section>{{$t->content}}</section>
                
            </div>
        @endforeach
    @else
		<p class="text-center alert alert-danger"> You have not created any todos yet.<br> Create one by clicking the create button in the navigation menu</p>
	
	@endif
@endsection