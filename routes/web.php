<?php

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
//Clear route cache:
Route::get('route-cache', function () {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache:
Route::get('config-cache', function () {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:cache');
    return 'Config cache cleared';
});

// Clear application cache:
Route::get('clear-cache', function () {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache:
Route::get('view-clear', function () {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('view:clear');
    return 'View cache cleared';
});
/*Route::get('{any}', 'Frontend\SinglePageController@index')->where('any', '.*');*/

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '^(?!backend).*$');

Route::get('edit{id}', 'Frontend\AccountController@edit')->name('edit');
Route::get('about', 'Frontend\PageController@get');
Route::get('verify/{key}', 'Frontend\VerifyController@indax');
Route::get('contact', 'Frontend\PageController@get');
Route::get('howtouse', 'Frontend\PageController@get');

\Illuminate\Support\Facades\Auth::routes();

Route::get('verify/{key}', 'Frontend\AuthController@verify');

Route::get('/backend', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/backend/login/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/backend/doLogin/', 'Auth\LoginController@doLogin')->name('doLogin');
Route::get('/backend/logout/', 'Auth\LoginController@logout')->name('logout');
Route::post('/backend/logout/', 'Auth\LoginController@logout')->name('logout');


//backend
Route::prefix('backend')->
name('backend.')
    ->group(function () {

        Route::get('password/request', 'Auth\ForgotPasswordController@showLinkRequestForm')
            ->name('password.request');

//pages
        Route::get('dashboard/', 'Backend\DashboardController@index')->name('dashboard');
        Route::resource('admin', 'Backend\AdminController');
        Route::match(['put', 'patch'], 'changePassword/{id}', 'Backend\AdminController@changePassword');
        Route::post('sendEmail', 'Backend\BaseController@sendEmail');
        Route::post('sendEmails', 'Backend\BaseController@sendEmails');

//videos
        Route::resource('videos', 'Backend\VideoController');

        Route::post('videos/{id}', 'Backend\VideoController@update');

//images S3
        Route::resource('image', 'Backend\ImageController');
//books
        Route::resource('book', 'Backend\BookController');

        Route::post('book/{id}', 'Backend\BookController@update');

//courses
        Route::get('course/result', 'Backend\CoursesController@result');
        Route::get('course/result-speciality', 'Backend\CoursesController@resultSpeciality');
        Route::resource('course', 'Backend\CoursesController');
        Route::post('course/{id}', 'Backend\CoursesController@update');

//accounts
        Route::get('account/{role}', 'Backend\AccountController@index', ['only' => [
            'index'
        ]])->where('role', 'user|lecture');
        Route::get('account/create', 'Backend\AccountController@create');
        Route::post('account/{role}', 'Backend\AccountController@store')->name('account.store');
        Route::match(['put', 'patch'], 'account/{id}', 'Backend\AccountController@update')->name('account.update');
        Route::match(['put', 'patch'], 'updateAccount/{id}', 'Backend\AccountController@updateAccount')->name('account.edit');
        Route::get('account/{id}', 'Backend\AccountController@show')->name('account.show');
        Route::get('account_tests/{id}', 'Backend\AccountTestController@index')->name('test.tests');
        Route::post('change_status', 'Backend\AccountController@changeStatus')->name('account.member_of_palace');
        Route::get('account_test/{a_id}/{id}', 'Backend\AccountTestController@show')->name('test.show');
        Route::post('accountCheck', 'Backend\AccountController@checkAccount')->name('account.check');
        Route::delete('account', 'Backend\AccountController@destroy')->name('account.destroy');
        Route::get('account/{id}/edit', 'Backend\AccountController@edit')->name('account.edit');
        Route::post('sendEmail', 'Backend\BaseController@sendEmail');
        Route::post('sendAttachment', 'Backend\AccountTestController@sendAttachment');

//specialty
        Route::resource('type', 'Backend\TypeController');
//generate pdf
        Route::get('admin_gdPDF', 'Backend\AdminController@gdPDF');
        Route::get('admin_gdExcel', 'Backend\AdminController@gdExcel');
        Route::get('course_gdPDF', 'Backend\CoursesController@gdPDF');
        Route::get('course_gdExcel', 'Backend\CoursesController@gdExcel');
        Route::get('course_gdExcel_account/{id}', 'Backend\CoursesController@gdExcelByAccount');
        Route::get('type_gdPDF', 'Backend\TypeController@gdPDF');
        Route::get('type_gdExcel', 'Backend\TypeController@gdExcel');
        Route::get('account_gdPDF', 'Backend\AccountController@gdPDFRole');
        Route::get('account_gdExcel', 'Backend\AccountController@gdExcel');
        Route::get('tests_gdPDF/{id}', 'Backend\AccountTestController@gdPDF');
        Route::get('test_gdPDF/{a_id}/{id}', 'Backend\AccountTestController@gdPDFTest');

//settings
        Route::resource('message', 'Backend\MessageController')->except(['destroy']);
        Route::get('account_gdPDF/{id}', 'Backend\AccountController@gdPDF');
        Route::resource('logs', 'Backend\LogController')->only([
            'index', 'show'
        ]);
        //check specialty
        Route::post('specialtyCheck', 'Backend\SpecialtyController@checkSpecialty');
        Route::post('ajaxImageUpload', 'Backend\BaseController@ajaxImageUpload');
        Route::delete('ajaxRemoveImage', 'Backend\BaseController@ajaxRemoveImage');
        Route::post('typeCheck', 'Backend\TypeController@typeCheck');
        Route::get('specialty/list', "Backend\SpecialtyController@list");
        Route::resource('specialty', 'Backend\SpecialtyController');
        Route::resource('pages', 'Backend\PageController');
        Route::resource('comments', 'Backend\CommentController');
        Route::resource('payments', 'Backend\PaymentController');
        Route::get('account/cancelPayment', 'Backend\AccountController@cancelPayment')->name('account.cancelPayment');


//tests
Route::get('test/getCourses', "Backend\TestsController@getCourses");
Route::resource('test', 'Backend\TestsController');
Route::post('test/{id}', 'Backend\TestsController@update');
Route::post('territory', 'Backend\AccountController@getTerritory');
//todo compare with SpecialtyController

    });

Route::post('delete-video', 'Backend\VideoController@removeVideo');
Route::post('delete-book', 'Backend\BookController@removeBook');
Route::post('delete-image', 'Backend\ImageController@removeImage');
Route::post('commentstatus', 'Backend\CommentController@commentstatus');
Route::post('edu', 'Backend\AccountController@getEducation');
Route::post('spec', 'Backend\AccountController@getSpecialty');
Route::post('updateSpec', 'Backend\SpecialtyController@updateSpecialty');
Route::post('specialty', 'Backend\SpecialtyController@getSpecialty');
