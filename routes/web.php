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
    return view('main');
})->name('home');

Route::get('/competitions', function () {
	return view('competitions/competitions');
})->name('competitions');

Route::get('/archive-competitions', function () {
	return view('competitions/arch-competitions');
})->name('arch-competitions');

Route::get('/publications', function () {
	return view('publication/publication');
})->name('publications');

Route::prefix('/account')->group(function () {
	Route::get('/personal-data', function () {
		return view('account/personal-data');
	});
	Route::get('/my-publication', function () {
		return view('account/my-publication');
	});
	Route::get('/part-in-contests', function () {
		return view('account/part-contests');
	});
	Route::get('/order', function() {
		return view('account/order');
	});
	Route::get('/order-publication', function() {
		return view('account/order-publication');
	});
});



Route::get('/account', function () {

});

