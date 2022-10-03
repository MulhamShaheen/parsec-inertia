<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DataSferaController;

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
    return Inertia::render('Landing', [
        'title' => 'Homepage'
    ]);
})->name('homepage');

Route::get('/main', [Controller::class, 'index'])->middleware('auth');
Route::get('/login', [CustomAuthController::class, 'login'])->name('login');
Route::post('/login', [CustomAuthController::class, 'loginSubmit']);

Route::get('/register', [CustomAuthController::class, 'register'])->name('register');
Route::post('/register', [CustomAuthController::class, 'registerSubmit']);

Route::get('/logout', [CustomAuthController::class, 'signOut'])->name('logout');
//Route::post('/logout', [CustomAuthController::class, 'logoutSubmit']);

//Route::get('/account/info', [CustomAuthController::class, 'fillInfo'], ['role'=>'activist']);

//Route::get('/account/info/{role}', function (){
//    $role = "activist";
//    return App::call('App\Http\Controllers\CustomAuthController@fillInfo' , ['role' => $role]);
//})->name('account.info.activist');

//Route::get('/account/info', function (){
//    $role = "employer";
//    return App::call('App\Http\Controllers\CustomAuthController@fillInfo' , ['role' => $role]);
//})->name('account.info.employer');



Route::get('/account/info/{role?}', [CustomAuthController::class, 'fillInfo'])->name('account.info');
//Route::get('/account/info/{}', [CustomAuthController::class, 'fillInfo'])->name('account.info.employer');


Route::post('/account/info', [CustomAuthController::class, 'infoSubmit']);
Route::post('/account/info/personal', [CustomAuthController::class, 'infoPersonalSubmit']);
Route::post('/account/info/employer', [CustomAuthController::class, 'infoEmployerSubmit']);

Route::post('/updateProfPicture', [CustomAuthController::class, 'updateProfPicture'])->name('update.picture');


Route::get('/account', [AccountController::class, 'accountManager'])->name('account');
