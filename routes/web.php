<?php

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

Route::get('/top', function() {
    return view('top');
})->name('topPage');


Route::group(['middleware' => ['guest']], function() {

    Route::get('/', function () {
        return view('members.register');
    })->name('registerPage');

    Route::post('/register-confirm', 'MemberController@registerConf')
        ->name('registerConf');

    Route::post('/register-complete', 'MemberController@registerMember')
        ->name('registerComp');

    Route::get('/register-complete-page', function() {
        return view('members.register_comp');
    })->name('registerCompPage');

    Route::get('/login-page', function() {
        return view('Auth.login');
    })->name('loginPage');

    Route::post('/login', 'Auth\LoginController@login')
        ->name('login');

    Route::get('/send-email-page', function() {
        return view('email_send');
    })->name('sendEmailPage');

    Route::post('/send-email', 'Auth\ResetPasswordController@sendEmail')
        ->name('sendEmail');

    Route::get('/send-email-comp-page', function() {
        return view('email_send_complete');
    })->name('sendEmailCompPage');

});

Route::group(['middleware' => ['auth']], function() {
    Route::post('logout', 'Auth\LoginController@logout')
        ->name('logout');
});
