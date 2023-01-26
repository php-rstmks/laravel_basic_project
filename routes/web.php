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

Route::get('/', function () {
    return view('members.register');
    // return view('members.register_comp');
});

Route::post('/register-confirm', 'MemberController@registerConf')
    ->name('registerConf');

Route::post('/register-complete', 'MemberController@registerMember')
    ->name('registerComp');

Route::get('/register-complete-page', function() {
    return view('members.register_comp');
})->name('registerCompPage');

