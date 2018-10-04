<?php
header('Access-Control-Allow-Origin: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
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

Route::post('/contact/store/', 'HomeController@contact');
Route::post('/check_subscription', 'HomeController@check_subscription');
Route::post('/subscription', 'HomeController@add_subscription');

Route::group(['prefix' => 'coinadmin'], function () {
  Route::get('/login', 'CoinadminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'CoinadminAuth\LoginController@login');
  Route::post('/logout', 'CoinadminAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'CoinadminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'CoinadminAuth\RegisterController@register');

  Route::post('/password/email', 'CoinadminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'CoinadminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'CoinadminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'CoinadminAuth\ResetPasswordController@showResetForm');
});


Route::get('/', function () {
  if(Auth::user()) {
    return redirect('home');
  } else {
    return view('auth.login');
  }
});


Auth::routes();



Route::group(['middleware' => 'auth'], function () {
  Route::post('/change/password', 'HomeController@update_password');
  Route::get('/profile', 'HomeController@profile');
  Route::post('/profile', 'HomeController@profile_store');
  Route::post('/address', 'HomeController@Address');
  Route::post('/btcaddress', 'HomeController@btcAddress');
  Route::get('/download', 'HomeController@download');
  Route::post('/download', 'HomeController@downloadProcess');
  Route::post('/email/regulation', 'HomeController@emailRegulation');
  Route::get('/kyc', 'HomeController@kyc');
  Route::post('/kyc', 'HomeController@kycProcess');
  Route::get('/referral', 'HomeController@referral');


  Route::get('/coinstatus', 'HomeController@coinStatus');
  Route::get('/transaction', 'HomeController@getTransaction');
  Route::get('/checkTransaction', 'HomeController@checkTransaction');
  Route::post('/transaction', 'HomeController@Transaction');

  Route::get('/home', 'HomeController@index')->name('home');
});
