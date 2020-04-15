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

Route::get('/diplom/{typeWork}/{workId}', 'Reward\GenerationDiplom@generate')->name('diplom-generate');

//DB::listen(function ($query) {
//    echo '<pre>';
//    print_r($query->sql);
//    echo '</pre>';
//});

Route::group(['middleware' => 'emailCheck'], function () {
    Route::get('/', 'MainPageController@show')->name('home');

    Route::group(['prefix' => 'competitions'], function () {
        Route::get('/', ['as' => 'competitions', 'uses' => 'Competitions\CompetitionsController@showCompetitions']);
        Route::get('/search/', ['as' => 'search-с', 'uses' => 'Competitions\FilterCompetitionController@search']);
    });

    Route::get('/search-diplom', ['as' => 'search-diplom', 'uses' => 'SearchController@searchDiplom']);

    Route::get('/competition/{id}', ['as' => 'competition', 'uses' => 'Competitions\CompetitionsController@showCompetition']);

    Route::get('/archive-competitions', ['as' => 'arch-competitions', 'uses' => 'Competitions\CompetitionsController@showArchCompetitions']);

    Route::get('/form-competition', ['as' => 'form-competition', 'uses' => 'Competitions\FormCompetitionController@show']);
    Route::post('/form-competition', ['as' => 'form-competition', 'uses' => 'Competitions\FormCompetitionController@saveWorkCompetition']);
    Route::get('/competition/{id}/nomination/', ['as' => 'search-work', 'uses' => 'Competitions\FilterCompetitionController@searchWork']);
    Route::get('/competition/{id}/work/{workId}', ['as' => 'competition-work', 'uses' => 'Competitions\WorkController@show']);

    Route::get('/express-competitions', ['uses' => 'Competitions\ExpressCompetitionsController@show']);
    Route::get('/express-competitions/search', ['uses' => 'Competitions\ExpressCompetitionsController@show', 'as' => 'express-competitions-search']);
    Route::get('/express-competition-form', ['uses' => 'Competitions\ExpressCompetitionFormController@show']);
    Route::post('/express-competition-form', ['uses' => 'Competitions\ExpressCompetitionFormController@saveExpressWork', 'as' => 'express-competitions']);

    Route::group(['prefix' => 'publications'], function () {
        Route::get('', ['as' => 'publications', 'uses' => 'Publication\PublicationsPageController@show']);
        Route::get('/search/', ['as' => 'search', 'uses' => 'Publication\FilterPublicationController@search']);
    });

    Route::get('/publication/{id}', ['as' => 'publication', 'uses' => 'Publication\PublicationsPageController@showPublication']);
    Route::get('/form-publication', ['as' => 'form-publication', 'uses' => 'Publication\FormPublicationController@show']);
    Route::post('/form-publication', ['uses' => 'Publication\FormPublicationController@save']);
    Route::post('ajaxLoadKinds/{education_id}','Publication\FormPublicationController@ajaxLoadKinds');
    Route::post('ajaxLoadNumberSymbolsInRelationOnType/{type_id}','Publication\FormPublicationController@ajaxLoadNumberSymbolsInRelationOnType');

    /**
     * Установление куков для фильтрации
     */
    Route::post('competitions/orderBy/{column}/{filter}', ['uses' => 'CookiesController@setCookieOrderCompetitions']);
    Route::post('competition-filter/{valueFilter}', ['uses' => 'CookiesController@setCookieFilterNomination']);
    Route::post('competition/orderBy/{column}/{filter}', ['uses' => 'CookiesController@setCookieOrderCompetition']);
    Route::post('arch-competition/orderBy/{column}/{filter}', ['uses' => 'CookiesController@setCookieOrderArchCompetition']);
    Route::post('express-competitions/{column}/{filter}', ['uses' => 'CookiesController@setCookieFilter']);
    Route::post('publications/orderBy/{column}/{filter}', ['uses' => 'CookiesController@setCookieOrderPublication']);


    Route::group(['middleware' => 'auth'], function () {
        Route::group(['prefix' => 'account'], function () {
            Route::get('/personal-data', 'Account\PersonalDataController@show');
            Route::post('/personal-data', ['as' => 'personal-data', 'uses' => 'Account\PersonalDataController@update']);
            Route::get('/my-publication', ['uses' => 'Account\PublicationController@show']);
            Route::get('/part-in-contests', ['uses' => 'Account\CompetitionController@show']);
            Route::get('/my-express-competition', ['uses' => 'Account\ExpressCompetitionController@show']);

            Route::get('/no-mailing/{id?}', function ($id = null) {
                $id = $id ?? Auth::user()->id;
                App\User::where('id', $id)->update([
                    'mailing' => 0,
                ]);
                return redirect(route('personal-data'));
            })->name('no-mailing');
        });
        Route::get('payment-from-account/{workId}/{type}', ['as' => 'payment-from-account', 'uses' => 'PaymentController@paymentFromAccount']);
    });

});

Route::get('two-step-registration', function () {
    return view('auth.two-step-registration');
})->name('two-step-registration');

Route::post('/two-step-registration', 'Auth\SocialController@addEmailSocialUser')->name('add-email');

Route::get('/social-auth/{provider}', ['uses' => 'Auth\SocialController@redirectToProvider', 'as' => 'auth.social']);
Route::get('/social-auth/{provider}/callback', ['uses' => 'Auth\SocialController@handleProviderCallback', 'as' => 'auth.social.callback']);


Route::get('/diplom-download/{type_work}/{id_work}', ['uses' => 'Reward\GenerationDiplom@generate', 'as' => 'diplom']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('publication', ['as' => 'a-publication', 'uses' => 'Admin\PublicationController@show']);
    Route::post('publication/change-themes/{mode}', ['as' => 'change-themes', 'uses' => 'Admin\PublicationController@changeThemes']);
    Route::post('competition/change-type/{mode}', ['as' => 'change-types', 'uses' => 'Admin\CompetitionController@changeTypes']);

    Route::get('confirmation-publication/{id}', ['as' => 'a-confirmation-publ', 'uses' => 'Admin\ConfirmationController@confirmPublication']);
    Route::get('reject-publication/{id}', ['as' => 'a-reject-publ', 'uses' => 'Admin\ConfirmationController@rejectPublication']);
    Route::get('confirmation-competition/{competition_id}/{id}', ['as' => 'a-confirmation-comp', 'uses' => 'Admin\ConfirmationController@confirmWork']);
    Route::get('reject-competition/{competition_id}/{id}', ['as' => 'a-reject-comp', 'uses' => 'Admin\ConfirmationController@rejectWork']);



    Route::get('competition', ['as' => 'a-competitions', 'uses' => 'Admin\CompetitionController@show']);
    Route::get('competition/{id}', ['as' => 'a-competition', 'uses' => 'Admin\CompetitionController@showCompetition']);
    /*
        flag = 0 - обычный конкурс
        flag = 1 - экспресс конкурс
    */
    Route::post('create-competition', ['as' => 'create-competition', 'uses' => 'Admin\CompetitionController@createCompetition']);
    Route::post('create-express-competition', ['as' => 'create-express-competition', 'uses' => 'Admin\CompetitionController@createExpressCompetition']);
    Route::get('express-competition', ['as' => 'a-express-competition', 'uses' => 'Admin\ExpressCompetitionController@show']);
    Route::get('competition/place/{place}/{id}', ['as' => 'a-place', 'uses' => 'Admin\CompetitionController@changePlace']);
    Route::post('add-substrates', ['as' => 'a-add-substrate', 'uses' => 'Reward\SubstrateController@addSubstrate']);
    Route::get('substrates', ['as' => 'a-add-substrate-show', 'uses' => 'Reward\SubstrateController@show']);
    Route::post('view-substrate', ['as' => 'view-substrate', 'uses' => 'Reward\SubstrateController@viewSubstrate']);
    Route::post('active-substrate-for-publication', ['as' => 'active-substrate-for-publication', 'uses' => 'Reward\SubstrateController@publicationSubstrate']);
    Route::get('mailing', ['as' => 'a-mailing', 'uses' => 'Admin\MailingController@show']);
    Route::post('load-template', ['uses' => 'Admin\MailingController@loadTemplate']);
    Route::post('global-mailing', ['as' => 'a-global-mailing', 'uses' => 'Admin\MailingController@sendMail']);
    Route::get('end-mailing', ['as' => 'a-end_mailing', 'uses' => 'Admin\MailingController@endMailing']);
    Route::get('/progress', 'Admin\MailingController@progressMailing');
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
Route::post('/payment', ['as' => 'payment', 'uses' => 'PaymentController@payment']);
Route::get('/test', 'Test@test');
Route::post('/uploadfilepubl', 'UploadFileController@uploaderPublication');
Route::post('/uploadercomp', 'UploadFileController@uploaderWork');
Route::auth();
