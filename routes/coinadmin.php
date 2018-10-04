<?php

// Route::get('/home', function () {
//     $users[] = Auth::user();
//     $users[] = Auth::guard()->user();
//     $users[] = Auth::guard('coinadmin')->user();

//     //dd($users);

//     return view('coinadmin.home');
// })->name('home');


Route::get('/home', 'AdminController@dashboard')->name('home');
Route::get('/newsletter', 'AdminController@newsletter');
Route::get('/subscription_status/{id}/{status}', 'AdminController@subscription_status');
Route::get('/compose_newsletter', 'AdminController@compose_newsletter');

Route::resource('cointype', 'CoinTypeResource');
Route::get('cointype/{id}/enableStatus', 'CoinTypeResource@enableStatus')->name('cointype.enableStatus');
Route::get('cointype/{id}/disableStatus', 'CoinTypeResource@disableStatus')->name('cointype.disableStatus');

// contacts
Route::get('contacts', 'AdminController@contacts')->name('contact.index');

Route::resource('user', 'UserResource');
Route::get('user/add/{id}', 'UserResource@Add')->name('user.add');
Route::post('user/add', 'UserResource@addCoin')->name('user.addcoin');
Route::get('user/{id}/history', 'UserResource@history')->name('user.history');
Route::get('user/{id}/kycdoc', 'UserResource@kycdoc')->name('user.kycdoc');

Route::resource('bonus', 'BonusResource');
Route::resource('promocode', 'PromocodeResource');
Route::resource('document', 'DocumentResource');


Route::get('history', 'AdminController@history')->name('history');

Route::get('history/success/{id}', 'AdminController@historySuccess')->name('history.success');

Route::get('history/failed/{id}', 'AdminController@historyFailed')->name('history.failed');

Route::post('ctc', 'AdminController@ctc')->name('ctc');

Route::post('settings/store', 'AdminController@settings_store')->name('settings.store');

Route::get('settings/index', 'AdminController@settings')->name('settings.index');

Route::post('userdocument/approve', 'AdminController@userdocument_approve')->name('userdocument.approve');

Route::post('userdocument/reject', 'AdminController@userdocument_reject')->name('userdocument.reject');


Route::get('user/{id}/approve', 'UserResource@approve')->name('user.approve');
Route::get('user/{id}/disapprove', 'UserResource@disapprove')->name('user.disapprove');



Route::get('profile', 'AdminController@profile')->name('profile');
Route::post('profile', 'AdminController@profile_update')->name('profile.update');

Route::get('password', 'AdminController@password')->name('password');
Route::post('password', 'AdminController@password_update')->name('password.update');

Route::get('/translation',  'AdminController@translation')->name('translation');
