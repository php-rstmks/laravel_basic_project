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

// トップページ
Route::get('/top', function() {
    return view('top');
})->name('topPage');

// 商品一覧ページ&検索ページ
Route::get('/products-list', 'ProductController@list')
    ->name('productListPage');

    //詳細ページ
Route::get('/products-show/{product}', 'ProductController@show')
    ->name('productShowPage');

// レビュー一覧ページ
Route::get('/review-list/{product}', 'ReviewController@list')
    ->name('reviewListPage');

Route::group(['middleware' => ['guest']], function() {

    Route::get('/', function () {
        return view('members.register');
    })->name('registerPage');

    // メンバ登録確認ページへ移動
    Route::post('/register-member-confirm', 'MemberController@registerConf')
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

    // パスワード忘れて変更用のメール送信
    Route::get('/send-email-page', function() {
        return view('email_send');
    })->name('sendEmailPage');

    Route::post('/send-email', 'Auth\ResetPasswordController@sendEmail')
        ->name('sendEmail');

    Route::get('/send-email-comp-page', function() {
        return view('email_send_complete');
    })->name('sendEmailCompPage');

    Route::get('/password-reset-page', function() {
        return view('password_reset');
    })->name('passwordResetPage');

    Route::post('/password-reset', 'Auth\ResetPasswordController@resetPassword')
        ->name('passwordReset');

});

Route::group(['middleware' => ['auth']], function() {
    Route::post('logout', 'Auth\LoginController@logout')
        ->name('logout');

    // 商品の登録ページ

    Route::get('register-product-page', 'ProductController@showProductPage')
        ->name('registerProductPage');

    // 商品登録確認ページへの移動
    Route::post('register-product-confirm-page', 'ProductController@registerConf')
        ->name('registerProductConfPage');

    // 商品の登録
    Route::post('register-product', 'ProductController@registerProduct')
        ->name('registerProduct');

    // 画像のアップロード
    Route::post('register-product-image', 'ProductController@registerImage')
        ->name('registerImage');

    // 小カテゴリを出現させる。
    Route::get('set-subcategory/{categoryId}', 'ProductController@setSubCategory')
        ->name('setSubCategory');

    // れびゅー登録ページ
    Route::get('register-review-page/{product}', 'ReviewController@showRegisterPage')
        ->name('registerReviewPage');

    // レビュー登録確認ページ
    Route::post('register-review-conf-page/{product}', 'ReviewController@showRegisterConfPage')
        ->name('registerReviewConfPage');

    // レビュー登録＆完了ページへ
    Route::post('register-review-comp-page/{product}', 'ReviewController@create')
    ->name('registerReviewCompPage');

    // マイページ
    Route::get('myPage', function () {
        return view('mypage');
    })->name('myPage');

    // 退会ページ
    Route::get('withdraw-page', function () {
        return view('members.withdrawal');
    })->name('withdrawPage');

    // 退会処理
    Route::post('withdrawal', 'MemberController@withdrawal')
        ->name('withdrawal');

    // 会員情報変更ページ
    Route::get('change-info-page', function () {
        return view('members.info_change');
    })->name('changeMemberInfoPage');

    // 会員情報変更確認ページ
    // Route::post('change-info-conf-page', function () {
    Route::post('change-info-conf-page', 'MemberController@changeInfoConfPage')
        // return view('members.info_conf_change');
    ->name('changeMemberInfoConfPage');

    // 会員情報変更処理
    Route::post('change-member-info', 'MemberController@changeInfo')
        ->name('changeMemberInfo');

    Route::get('change-password-page', function() {
        return view('members.change_password');
    })->name('changeMemberPasswordPage');

    // パスワード変更
    Route::post('change-password', 'MemberController@changePassword')
        ->name('changeMemberPassword');

    // メアド変更ページ
    // Route::get('change-mail-page', 'MemberController@changeMail')
    Route::get('change-mail-page', function () {
        return view('members.change_mail');
    })->name('changeMemberMailPage');

    // メアド変更コード入力ページ
    Route::post('change-mail-code', 'MemberController@changeMailCode')
        ->name('changeEmailCodePage');

    Route::post('change-mail', 'MemberController@changeEmail')
        ->name('changeEmail');
});
