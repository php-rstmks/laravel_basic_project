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

    });

    // 画像のアップロード
    Route::post('upload/image', 'ProductController@registerImage')
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

    // メアド変更コード入力ページへ、
    Route::get('change-mail-code-repage', 'MemberController@showEmailCodePage')
        ->name('show.email.codepage');


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

    // 一覧ページ（会員、商品カテゴリ、商品、レビュー）
    Route::get('members/list', 'MemberController@showList')
        ->name('admin.members.list');

    Route::get('products/list', 'ProductController@showList')
        ->name('admin.products.list');

    Route::get('categories/list', 'CategoryController@showList')
        ->name('admin.categories.list');

    Route::get('reviews/list', 'ReviewController@showList')
        ->name('admin.reviews.list');

    // 登録画面（会員、商品カテゴリ、商品、レビュー）
    Route::get('members/register', 'MemberController@registerpage')
        ->name('admin.members.registerpage');

    Route::get('categories/register', 'CategoryController@registerpage')
        ->name('admin.categories.registerpage');

    Route::get('products/register', 'ProductController@registerpage')
        ->name('admin.products.registerpage');

    Route::get('reviews/register', 'ReviewController@registerpage')
        ->name('admin.reviews.registerpage');

    // 登録確認画面（会員、商品カテゴリ、商品、レビュー）
    Route::post('members/register/conf', 'MemberController@register_confpage')
    ->name('admin.members.register_conf');

    Route::post('categories/register/conf', 'CategoryController@register_confpage')
    ->name('admin.categories.register_conf');

    Route::post('products/register/conf', 'ProductController@register_confpage')
    ->name('admin.products.register_conf');

    Route::post('reviews/register/conf', 'ReviewController@register_confpage')
    ->name('admin.reviews.register_conf');

    // 登録処理（会員、商品カテゴリ、商品、レビュー）
    Route::post('members/register/comp', 'MemberController@register')
        ->name('admin.members.register');

    Route::post('categories/register/comp', 'CategoryController@register')
        ->name('admin.categories.register');

    Route::post('products/register/comp', 'ProductController@register')
        ->name('admin.products.register');

    Route::post('reviews/register/comp', 'ReviewController@register')
        ->name('admin.reviews.register');


    // 編集画面（会員、商品カテゴリ、商品、レビュー）
    Route::get('members/edit/{member}', 'MemberController@editpage')
        ->name('admin.members.editpage');

    Route::get('categories/edit/{category}', 'CategoryController@editpage')
        ->name('admin.categories.editpage');

    Route::get('products/edit/{product}', 'ProductController@editpage')
        ->name('admin.products.editpage');

    Route::get('reviews/edit/{review}', 'ReviewController@editpage')
        ->name('admin.reviews.editpage');

    // 編集確認画面（会員、商品カテゴリ、商品、レビュー）
    Route::post('members/edit/conf/{member}', 'MemberController@edit_confpage')
        ->name('admin.members.edit_conf');

    Route::post('categories/edit/conf/{category}', 'CategoryController@edit_confpage')
        ->name('admin.categories.edit_conf');

    Route::post('products/edit/conf/{product}', 'ProductController@edit_confpage')
        ->name('admin.products.edit_conf');

    Route::post('reviews/edit/conf/{review}', 'ReviewController@edit_confpage')
        ->name('admin.reviews.edit_conf');

    // 編集処理（会員、商品カテゴリ、商品、レビュー）
    Route::post('members/edit/comp/{member}', 'MemberController@edit')
        ->name('admin.members.edit');

    Route::post('categories/edit/comp/{category}', 'CategoryController@edit')
        ->name('admin.categories.edit');

    Route::post('products/edit/comp/{product}', 'ProductController@edit')
        ->name('admin.products.edit');

    Route::post('reviews/edit/comp/{review}', 'ReviewController@edit')
        ->name('admin.reviews.edit');

    // 詳細ページ（会員、商品カテゴリ、商品、レビュー）
    Route::get('members/detail/{member}', 'MemberController@detailpage')
        ->name('admin.members.detailpage');

    Route::get('categories/detail/{category}', 'CategoryController@detailpage')
        ->name('admin.categories.detailpage');

    Route::get('products/detail/{product}', 'ProductController@detailpage')
        ->name('admin.products.detailpage');

    Route::get('reviews/detail/{review}', 'ReviewController@detailpage')
        ->name('admin.reviews.detailpage');

    // 削除処理（会員、商品カテゴリ、商品、レビュー）
    Route::get('members/delete/{member}', 'MemberController@delete')
        ->name('admin.members.delete');

    Route::get('categories/delete/{category}', 'CategoryController@delete')
        ->name('admin.categories.delete');

    Route::get('products/delete/{product}', 'ProductController@delete')
        ->name('admin.products.delete');

    Route::get('reviews/delete/{review}', 'ReviewController@delete')
        ->name('admin.reviews.delete');
});


