<?php

// トップページ
Route::get('/top', function() {
    return view('top');
})->name('topPage');

Route::prefix('products')->group(function () {

    // ログインメンバとゲストが入れる商品一覧ページ&検索ページ
    Route::get('/list/', 'ProductController@list')
    ->name('product.list');

    // 商品詳細ページ
    Route::get('/show/{product}', 'ProductController@show')
    ->name('product.show');

});

Route::get('/list/members', 'MemberController@page')
->name('member.list');

// レビュー一覧ページ
Route::get('/review-list/{product}', 'ReviewController@list')
    ->name('reviewListPage');

Route::group(['middleware' => ['guest:member']], function() {

    Route::get('/', function () {
        return view('members.register');
    })->name('registerPage');

    // メンバ登録確認ページへ移動
    Route::post('/register/member/confirm', 'MemberController@registerConf')
        ->name('registerConf');

    Route::post('/register/member/complete', 'MemberController@registerMember')
        ->name('registerComp');

    // 完了ページ
    Route::get('/register/member/complete', function() {
        return view('members.register_comp');
    })->name('registerCompPage');

    Route::get('/loginpage', function() {
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

    // 完了ページ
    Route::get('/send-email-comp-page', function() {
        return view('email_send_complete');
    })->name('sendEmailCompPage');

    Route::get('/password-reset-page', function() {
        return view('password_reset');
    })->name('passwordResetPage');

    // パスワードリセット処理
    Route::post('/password-reset', 'Auth\ResetPasswordController@resetPassword')
        ->name('passwordReset');

});


Route::group([
    'prefix' => 'admin',
    'middleware' => 'guest:administer',
    'namespace' => 'Administer',
    // 'name' => 'admin.'
    ], function() {

    // ログインページ
    Route::get('/login', function () {

        return view('admin.login');
    })->name('admin.loginpage');

    // ログイン処理
    Route::post('/login', 'LoginController@login')
        ->name('admin.login');

    //管理ユーザ作成画面
    Route::get('register', function () {
        return view('admin.regist');
    });

    // 管理ユーザ作成
    Route::post('register', 'LoginController@regist')
        ->name('adminCreate');
});

Route::group(['middleware' => ['auth:member']], function() {


    Route::post('logout', 'Auth\LoginController@logout')
        ->name('logout');

    // 商品の登録ページ

    Route::prefix('products')->group(function () {

        Route::get('/register', 'ProductController@showProductPage')
        ->name('registerProductPage');

        // 商品登録確認ページへの移動
        Route::post('register/confirm', 'ProductController@registerConf')
            ->name('registerProductConfPage');

        // 商品の登録処理
        Route::post('register/complete', 'ProductController@registerProduct')
            ->name('registerProduct');

        // 画像のアップロード
        Route::post('upload/image', 'ProductController@registerImage')
        ->name('registerImage');

        // 小カテゴリを出現させる。
        Route::get('set-subcategory/{categoryId}', 'ProductController@setSubCategory')
            ->name('setSubCategory');

    });

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
    Route::post('change-info-conf-page', 'MemberController@changeInfoConfPage')
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
    Route::get('change-mail-page', function () {
        return view('members.change_mail');
    })->name('changeMemberMailPage');

    // メアド変更コード入力ページ
    Route::post('change-mail-code-page', 'MemberController@changeMailCode')
        ->name('changeEmailCodePage');

    // メアド変更処理
    Route::post('change-mail', 'MemberController@changeEmail')
        ->name('changeEmail');

    // ログインユーザのレビュー管理ページ
    Route::get('control-review-page', 'ReviewController@showControl')
        ->name('controlReviewPage');

    //　ユーザによるレビュー編集ページ
    Route::get('review-edit-page/{review}', 'ReviewController@editPage')
        ->name('reviewEditPage');

    //レビュー編集確認ページ
    Route::post('review-edit-conf-page/{review}', 'ReviewController@editConfPage')
        ->name('reviewEditConfPage');

    Route::post('review-edit/{review}', 'ReviewController@edit')
        ->name('editReview');

    //　ユーザによるレビュー削除ページ
    Route::get('review-delete-page/{review}', 'ReviewController@deletePage')
        ->name('reviewDeletePage');

    Route::get('review-delete/{review}', 'ReviewController@delete')
        ->name('deleteReview');

});

// 管理者ログイン状態
Route::group([
    'prefix' => 'admin',
    'namespace' => 'Administer',
    'middleware' => 'auth:administer',
    // 'name' => 'admin.'
    ], function() {

    Route::get('home', function () {
        return view('admin.home');
    })->name('admin.home');

    Route::post('logout', 'LoginController@logout')
        ->name('admin.logout');

    // 一覧ページ
    Route::get('members/list', 'MemberController@showList')
        ->name('admin.members.list');

    Route::get('products/list', 'ProductController@showList')
        ->name('admin.products.list');

    // 登録画面
    Route::get('members/register', 'MemberController@registerpage')
        ->name('admin.members.registerpage');

    // 登録確認画面
    Route::post('members/register/conf', 'MemberController@register_confpage')
    ->name('admin.members.register_conf');

    // 登録処理
    Route::post('members/register/comp', 'MemberController@register')
        ->name('admin.members.register');


    // Route::get('products/register, ')

    // 会員編集画面
    Route::get('members/edit', 'MemberController@editpage')
        ->name('admin.members.editpage');

    Route::get('members/edit/conf', 'MemberController@edit_confpage')
        ->name('admin.members.edit_conf');

    Route::get('members/edit/comp', 'MemberController@edit')
        ->name('admin.members.edit');

});


