<?php

use Illuminate\Support\Facades\Route;

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
//frontend
// Route::get('/', function () {
//     return view('layouts.backend.design');
// });
Route::get('/login','UserController@loginForm');
Route::get('/','UserController@loginForm')->name('user.login');
Route::post('/user/login','UserController@login')->name('user.login.store');
Route::get('/registration','UserController@registrationForm')->name('user.registration');
Route::post('/registration/store','UserController@registrationStore')->name('user.registration.store');
Route::match(['get','post'],'/forget-password','UserController@forgetPassword' )->name('forget.password');
Route::get('/confirm/{code}','UserController@userConfirmEmail' );

 Route::get('/logout','UserController@logout' )
 ;
Route::group(['middleware' => ['userLogin']], function() {
Route::get('/exam','UserController@exam');
Route::get('/start-test','UserController@startTest');
Route::match(['get','post'],'/questions','QuestionController@userQuestions');
Route::post('/paragraph','QuestionController@paragraph' );
Route::match(['get','post'],'/profile','UserController@profile' );
});
//Auth::routes();

//backend
Route::get('/admin','AdminController@loginForm')->name('admin.login');
Route::match(['get','post'],'/admin/forget-password','AdminController@forgetPassword' );

Route::post('/admin/login','AdminController@login');
Route::group(['middleware' => ['admin']], function() {
    	//settings
	Route::match(['get','post'],'/admin/settings','SettingsController@settings' );
	
	Route::get('/admin/dashbord','AdminController@dashbord' );
	Route::get('/admin/examinees','AdminController@examineesList' );
	Route::get('/admin/examinee/{status}/{id}','AdminController@examineeStatusChange' );
	Route::get('/admin/examinee-delete/{id}','AdminController@examineeDelete' );
	Route::get('/admin/examinees/{id}/answersheet-list','AdminController@examineesAnswersheetList' );
	Route::get('/admin/examinees/{id}/answersheet','AdminController@examineesAnswersheet' );
	Route::match(['get','post'],'/admin/profile','AdminController@profile' );
	Route::get('/admin/logout','AdminController@logout' );

	// question
	Route::get('/admin/questions','QuestionController@listQuestion' );
	Route::get('/admin/question-delete/{id}','QuestionController@deleteQuestion' );
	Route::match(['get','post'],'/admin/add-question','QuestionController@addQuestion' );
	Route::match(['get','post'],'/admin/edit-question/{id}','QuestionController@editQuestion' );
});