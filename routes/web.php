<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [TodoController::class , 'index'])->middleware('auth');

Route::resource('todo' , TodoController::class )->middleware('auth');

Route::get('login' , [AuthController::class , 'loginPage'])->name('login');

Route::post('login' , [AuthController::class , 'authenticate']);

Route::get('signup' , [AuthController::class , 'signupPage']);

Route::post('signup' , [AuthController::class , 'register']);

Route::get('logout', [AuthController::class , 'logout']);

Route::get('/forgot-password',[AuthController::class , 'forgotPasswordPage'])->middleware('guest')->name('password.request');


Route::post('/forgot-password', [AuthController::class , 'sendResestLink'])->middleware('guest')->name('password.email');


Route::get('/reset-password/{token}',  [AuthController::class , 'resetPasswordPage'] )->middleware('guest')->name('password.reset');

Route::post('/reset-password', [AuthController::class , 'resetPassword'])->middleware('guest')->name('password.update');

Route::get('/ajax/done/{id}/{check}' , function( $id , $check)
{
	$todo = \App\Models\Todo::find($id);
	if($todo->user_id != Auth::id()){
		return 'You do not have access to the requested todo.';
	}
	if($check === 'true'){
		$todo->done = 1;
	}elseif($check === 'false'){
		$todo->done = 0;
	}else{
		return 'Unvalid url.';
	}
	$todo->save();
	
	return 'Successfull';
	
});

Route::get('/ajax/show_completed/{show}' , function($show)
{
	$user = \App\Models\User::find(Auth::id());
	if($show === 'true'){
		$user->show_completed = 1;
	}elseif($show === 'false'){
		$user->show_completed = 0;
	}else{
		return 'Unvalid url.';
	}
	$user->save();
	
	return 'Successfull';
	
});