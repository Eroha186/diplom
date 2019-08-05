<?php
use Illuminate\Support\Facades\DB;
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

//DB::listen(function($query) {
//    echo '<pre>';
//    print_r($query->sql);
//    echo '</pre>';
//});

Route::get('/', 'MainPageController@show')->name('home');

Route::get('/competitions', function () {
    return view('competitions/competitions');
})->name('competitions');
Route::get('/archive-competitions', function () {
    return view('competitions/arch-competitions');
})->name('arch-competitions');

Route::group(['prefix' => 'publications'], function() {
    Route::get('', ['as' => 'publications', 'uses' => 'PublicationsPageController@show']);
    Route::post('/orderBy/{column}/{filter}', ['uses' => 'FilterPublicationController@setCookieOrder']);
    Route::post('/search/{request?}', ['uses' => 'FilterPublicationController@search']);
});

Route::get('/publication/{id}', ['as' => 'publication', 'uses' => 'PublicationsPageController@showPublication']);
Route::get('/form-publication', ['as' => 'form-publication', 'uses' => 'PublicationsPageController@showForm']);
Route::post('/form-publication', ['as' => 'form-publication', 'uses' => 'PublicationsPageController@savePublication']);

Route::group(['prefix' => 'account', 'middleware' => 'auth'], function () {
    Route::get('personal-data', 'AccountController@showPersonalData');
    Route::post('personal-data', ['middleware' => 'web', 'as' => 'personal-data', 'uses' => 'AccountController@saveChangePersonalData']);

    Route::get('/my-publication', function () {
        return view('account/my-publication');
    });
    Route::get('/part-in-contests', function () {
        return view('account/part-contests');
    });
    Route::get('/order', function () {
        return view('account/order');
    });
    Route::get('/order-publication', function () {
        return view('account/order-publication');
    });
});

Route::auth();

Route::get('/verify/{token}', 'Auth\RegisterController@verifyUser');
