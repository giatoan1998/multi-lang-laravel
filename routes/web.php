<?php

use App\Http\Controllers\SendMailController;
use App\Http\Controllers\UploadFileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
    Route::get('/', function () {
        $tag = DB::table('tags')->first();

        return view('welcome', ['tag' => $tag]);
    });
    Route::get('/test', function () {
        return view('test');
    })->name('test');

    Route::post('/sendmail', [SendMailController::class, 'sendMail'])->name('sendmail');
});
/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/

