<?php

use Mango\Services\AuthorizationService;
use Mango\Services\CrudService;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    dump(csrf_token());
    return view('welcome');
});

Route::get('/test', function () {
    $user = Auth::user();
    MangoApp::setSiteFromUser($user);

    dump(MangoApp::getSite());
});


Route::any('/login', [AuthorizationService::class, 'doLogin'])->name('login');
Route::any('/logout', [AuthorizationService::class, 'doLogout'])->name('logout');

Route::any('/crud/{service}/{operation}', [CrudService::class, 'handle'])->where(['service' => '[A-Za-z]+', 'operation' => '[A-Za-z]+']);
Route::any('/crud', [CrudService::class, 'handle'])->middleware('auth');
