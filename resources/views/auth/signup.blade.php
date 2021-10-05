@extends('layouts.app')


@section('content')
<div class="d-flex p-2 justify-content-center">
    <form class="form-signup text-center" method="POST" action="signup">
      @csrf  
	  <h1 class="h3 mb-3 font-weight-normal">Sign up for a new account</h1>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control mb-3 " placeholder="Email address" required="" autofocus="" name="email">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control mb-3 " placeholder="Password" required="" name="password">

      <label for="inputPassword" class="sr-only">Confirm Password</label>
      <input type="password" id="inputPassword" class="form-control mb-3 " placeholder="Confirm Password" required="" name="password_confirmation">

      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
    </form>
</div>
@endsection