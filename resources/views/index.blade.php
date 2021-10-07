@extends('layouts.app')

@section('content')
<style>
#loading-overlay {
    position: absolute;
    width: 100%;
    height:100%;
    left: 0;
    top: 0;
    display: none;
    align-items: center;
    background-color: #000;
    z-index: 999;
    opacity: 0.5;
}
.loading-icon{ 
	position:absolute;
	border-top:2px solid #fff;
	border-right:2px solid #fff;
	border-bottom:2px solid #fff;
	border-left:2px solid #767676;
	border-radius:25px;
	width:25px;height:25px;margin:0 auto;
	position:absolute;
	left:50%;
	margin-left:-20px;
	top:50%;
	margin-top:-20px;
	z-index:4;
	-webkit-animation:spin 1s linear infinite;
	-moz-animation:spin 1s linear infinite;
	animation:spin 1s linear infinite;
}
[data-completed="true"]{
	text-decoration : line-through;
}
@-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
@-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
@keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } } 
<?php
$user = \App\Models\User::find(Auth::id());
if($user->show_completed == true){
	echo '[data-completed="true"]{
		display : none;
		}';
}
?>

</style>
<input type="checkbox" value="1" name="showOrHide" class="btn btn-primary" id="showOrHide" {{($user->show_completed == true)?'checked':''}}>
<lable for="showOrHide">Show/Hide completed todos</lable>
    @if(count($todos) > 0)
        @foreach($todos as $t)
            <div class="card p-2 m-2" data-completed="{{($t->done)? 'true' : 'false'}}" display="{{($t->show_completed==true)?'none':''}}">
                <h2><a href="/todo/{{$t->id}}">{{$t->title}}</a></h2>
				<input type="checkbox" value="1" name="done-{{$t->id}}" {{($t->done)? 'checked' : ''}}>
				<div class="card-title">
				<span class="card-header badge badge-info ">{{$t->due}}</span>
				</div>
                <section>{{$t->content}}</section>
            </div>
        @endforeach
    @else
		<p class="text-center alert alert-danger"> You have not created any todos yet.<br> Create one by clicking the create button in the navigation menu</p>
	
	@endif
	<div id="loading-overlay">
		<div class="loading-icon"></div>
	</div> 
@endsection

@section('scripts')
<script>
$( document ).ready(function() {
	function onSend (data , status , xhr)
	{
		 $("#loading-overlay").show();
	}
	
	function onComplete(){
		 $("#loading-overlay").hide();
	}
	
	function onError(){
		 $("#loading-overlay").hide();
		 alert('Something went wrong!');
	}
	
	function onSuccess(){
		$('div.card').each(function(){
		$(this).attr('data-completed' , $(this).find('input')[0].checked)});
	}
	
	$(".card input[type='checkbox']").each(function(){
		$(this).click(function() {
			$options = {
				beforeSend: onSend,
				complete: onComplete,
				error: onError,
				success: onSuccess
			};
			id = $(this).attr('name').slice(5);
			$.ajax('/ajax/done/' + id + '/' + $(this)[0].checked , $options)
		});
	});
	$("#showOrHide").click(function(){
		$("[data-completed=true]").toggle();
		$.ajax('/ajax/show_completed/'+$(this)[0].checked);
	});
});

</script>
<script>

</script>
@endsection