<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', ['as'=>'home','uses'=>'HomeController@index'])->middleware(['auth','checklogin']);
Route::post('/postlogin','ExecuteController@postlogin')->name('postlogin');
Route::get('/logout','ExecuteController@getSignOut')->name('logout');
Route::get('/changepass',['as'=>'changepass','uses'=>'ExecuteController@getChangePassword'])->middleware('checkrole');
Route::post('/postchagepass',['as'=>'postchangepass','uses'=>'ExecuteController@postChangePassword'])->middleware('checkrole');
Route::resource('/employee', 'HomeController')->middleware(['checkrole','checklogin']);
Route::resource('/department', 'DepartmentController')->middleware(['checkrole','checklogin']);
//export exccel
Route::get('export', 'ExportController@export')->name('export');

//gorget
//rest pass

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
/*Route::get('email/verify', 'Auth\VerificationController@show')
->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')
->name('verification.resend');*/
