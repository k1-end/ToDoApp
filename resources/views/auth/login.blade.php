@extends('layouts.app')

@section('content')
<div class="d-flex p-2 justify-content-center">
    <form class="form-signin text-center" method="POST" action="login">
      @csrf  
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control mb-3 " placeholder="Email address" required="" autofocus="" name="email" value="Demo@demo">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control mb-3 " placeholder="Password" required="" name="password" value="Demo">
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	  <div class="form-check">
		  <input class="form-check-input" type="checkbox" value="1" name="remember">
		  <label class="form-check-label" >
			Remeber Me!
		  </label>
	  </div>
      <a href="/signup" class="btn btn-lg btn-primary btn-block">Sign Up</a>
      <a href="/forgot-password" class="btn btn-lg btn-primary btn-block">Forget your password?</a>
    </form>
</div>
@endsection