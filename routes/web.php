<?php

use Illuminate\Support\Facades\Route;
use App\Mail\TestEmail;
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

Route::get('/', 'HomeController@index');
Route::post('sign-in', 'Auth\LoginController@loginA');
Auth::routes();
Route::get('get/image', 'HomeController@getImage');
Route::get('thankyou', 'HomeController@thankyou');
Route::any('newsletter', 'HomeController@newsLetter');
// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','middleware' => ['auth']], function () {
    Route::get('/','Admin\HomeController@index');
    Route::get('gallary/datatable', 'Admin\GallaryController@datatableData');
    Route::resource('gallary', 'Admin\GallaryController');
    
});
