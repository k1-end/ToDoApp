@extends('layouts.app')

@section('content')
<div class="d-flex p-2 justify-content-center m2">
    <form class="form-signin" method="POST" action="forgot-password">
      @csrf  
      <h1 class="h3 mb-3 font-weight-normal">Enter your email</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="mb-3 form-control" placeholder="Email address" required="" autofocus="" name="email">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Send email</button>
      <a href="/signup" class="btn btn-lg btn-primary btn-block">Sign Up</a>
    </form>
</div>
@endsection