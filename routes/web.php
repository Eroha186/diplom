<?php

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

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

use Illuminate\Support\Facades\DB;



Route::get('/testDB', function () {
    $search = new \App\Http\Controllers\SearchController();
    $publication = new \App\Publication();
    $search = $search->search('asdafsdasf dsafsdfasdf adsfasdf', $publication);
    dd($search);
});

//DB::listen(function ($query) {
//    echo '<pre>';
//    print_r($query->sql);
//    echo '</pre>';
//});

Route::group(['middleware' => 'emailCheck'], function () {
    Route::get('/', 'MainPageController@show')->name('home');

    Route::group(['prefix' => 'competitions'], function () {
        Route::get('', ['as' => 'competitions', 'uses' => 'Competitions\CompetitionsController@show']);
        Route::post('/orderBy/{column}/{filter}', ['uses' => 'Competitions\FilterCompetitionController@setCookieOrderCompetitions']);
        Route::get('/search/', ['as' => 'search-с', 'uses' => 'Competitions\FilterCompetitionController@search']);
    });

    Route::get('/competition/{id}', ['uses' => 'Competitions\CompetitionsController@showCompetition']);

    Route::get('/archive-competitions', function () {
        return view('competitions/arch-competitions');
    })->name('arch-competitions');

    Route::get('/form-competition', ['as' => 'form-competition', 'uses' => 'Competitions\FormCompetitionController@show']);
    Route::post('/form-competition', ['as' => 'form-competition', 'uses' => 'Competitions\FormCompetitionController@saveWorkCompetition']);
    Route::post('/competition-filter/{valueFilter}', ['uses' => 'Competitions\FilterCompetitionController@setCookieFilterNomination']);
    Route::get('/competition/{id}/nomination/', ['as' => 'search-work', 'uses' => 'Competitions\FilterCompetitionController@searchWork']);
    Route::post('competition/orderBy/{column}/{filter}', ['uses' => 'Competitions\FilterCompetitionController@setCookieOrderCompetition']);
    Route::get('/competition/{id}/work/{workId}', ['as' => 'competition-work', 'uses' => 'Competitions\WorkController@show']);

    Route::get('/express-competitions', ['uses' => 'Competitions\ExpressCompetitionsController@show']);
    Route::post('/express-competitions/{column}/{filter}', ['uses' => 'Competitions\ExpressCompetitionsController@setCookieFilter']);
    Route::get('/express-competitions/search', ['uses' => 'Competitions\ExpressCompetitionsController@show', 'as' => 'express-competitions-search']);
    Route::get('/express-competition-form', ['uses' => 'Competitions\ExpressCompetitionFormController@show']);
    Route::post('/express-competition-form', ['uses' => 'Competitions\ExpressCompetitionFormController@saveExpressWork', 'as' => 'express-competitions']);

    Route::group(['prefix' => 'publications'], function () {
        Route::get('', ['as' => 'publications', 'uses' => 'Publication\PublicationsPageController@show']);
        Route::post('/orderBy/{column}/{filter}', ['uses' => 'Publication\FilterPublicationController@setCookieOrder']);
        Route::get('/search/', ['as' => 'search', 'uses' => 'Publication\FilterPublicationController@search']);
    });

    Route::get('/publication/{id}', ['as' => 'publication', 'uses' => 'Publication\PublicationsPageController@showPublication']);
    Route::get('/form-publication', ['as' => 'form-publication', 'uses' => 'Publication\PublicationsPageController@showForm']);
    Route::post('/form-publication', ['as' => 'form-publication', 'uses' => 'Publication\PublicationsPageController@savePublication']);


    Route::group(['middleware' => 'auth'], function () {
        Route::group(['prefix' => 'account'], function () {

            Route::get('/my-publication', ['uses' => 'Account\AccountController@showMyPublication']);
            Route::get('/part-in-contests', ['uses' => 'Account\AccountController@showPartInContests']);
            Route::get('/order', function () {
                return view('account/order');
            });
            Route::get('/order-publication', function () {
                return view('account/order-publication');
            });

            Route::get('/no-mailing', function () {
                App\User::where('id', Auth::user()->id)->update([
                    'mailing' => 0,
                ]);
                return redirect(route('personal-data'));
            })->name('no-mailing');
        });

    });

});

Route::group(['middleware' => 'auth'], function () {
    Route::get('account/personal-data', 'Account\AccountController@showPersonalData');
    Route::post('account/personal-data', ['middleware' => 'web', 'as' => 'personal-data', 'uses' => 'Account\AccountController@saveChangePersonalData']);
});

Route::get('two-step-registration', function () {
    return view('auth.two-step-registration');
})->name('two-step-registration');

Route::post('/two-step-registration', 'Auth\SocialController@addEmailSocialUser')->name('add-email');

Route::get('/social-auth/{provider}', ['uses' => 'Auth\SocialController@redirectToProvider', 'as' => 'auth.social']);
Route::get('/social-auth/{provider}/callback', ['uses' => 'Auth\SocialController@handleProviderCallback', 'as' => 'auth.social.callback']);

Route::get('/test', ['uses' => 'Reward\GenerationDiplom@generate']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('publication', ['as' => 'a-publication', 'uses' => 'Admin\PublicationController@show']);
    Route::post('publication/change-themes/{mode}', ['as' => 'change-themes', 'uses' => 'Admin\PublicationController@changeThemes']);

    Route::get('confirmation/{id}/{result}/{page}/{idCompetition?}', ['as' => 'a-confirmation', 'uses' => 'Admin\ConfirmationController@confirmation']);

    Route::get('competition', ['as' => 'a-competitions', 'uses' => 'Admin\CompetitionController@show']);
    Route::get('competition/{id}', ['as' => 'a-competition', 'uses' => 'Admin\CompetitionController@showCompetition']);
    /*
        flag = 0 - обычный конкурс
        flag = 1 - экспресс конкурс
    */
    Route::post('create-competition/{flag}', ['as' => 'create-competition', 'uses' => 'Admin\CompetitionController@createCompetition']);
    Route::get('express-competition', ['as' => 'a-express-competition', 'uses' => 'Admin\ExpressCompetitionController@show']);
    Route::get('create-diplom', ['as' => 'a-create-diplom', 'uses' => 'Reward\GenerationDilom@show']);
    Route::get('competition/place/{place}/{id}', ['as' => 'a-place', 'uses' => 'Admin\CompetitionController@changePlace']);
    Route::post('add-substrates', ['as' => 'a-add-substrate', 'uses' => 'Reward\SubstrateController@addSubstrate']);
    Route::post('view-substrate', ['as' => 'view-substrate', 'uses' => 'Reward\SubstrateController@viewSubstrate']);
});


Route::get('/verify/{token}', ['uses' => 'Auth\RegisterController@verifyUser', 'as' => 'verify']);
Route::post('/authCheck/{email}', function ($email) {
    if (Auth::check()) {
        return response()->json(['auth' => 0], 200);
    } else {
        $checking = new RegisterController();
        $user = \App\User::where('email', $email)->first();
        $check = $checking->existenceUser($user);
        return response()->json(['auth' => $check], 200);
    }
});

Route::post('/loginFormPublication', 'Auth\LoginController@login')->name('loginFormPublication');
Route::post('/loginFormCompetition', 'Auth\LoginController@login')->name('loginFormCompetition');
Route::post('/publicationSaveSession', ['uses' => 'Publication\PublicationSaveSession@publicationSaveSession']);
Route::auth();


Route::get('/test', function () {
    return view('test');
});
