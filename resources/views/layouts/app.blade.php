<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('/css/app.css')}}">
	<script src="{{asset('js/app.js')}}"></script>
    <title>Todo</title>
</head>
<body>
   
	@include('inc.nav')
    
    @include('inc.msg')
    <div class="container">
    @yield('content')
    </div>
	@yield('scripts')
    
</body>
</html>