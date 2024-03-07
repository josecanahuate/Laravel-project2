<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AuthManager;
use App\Http\Controllers\ForgetPasswordManager;
use  App\Http\Controllers\UploadManager;
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
    return view('welcome');
})->name('home');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::get('/upload', [UploadManager::class, 'upload'])->name('upload')->middleware(["auth"]);
Route::post('/upload', [UploadManager::class, 'uploadPost'])->name('upload.post');

//cada vez que creemos una nueva ruta en donde el usuario debe estar logeado para verla  debemos agregarle la directiva auth
//sino esta logeado, sera redirigido al login
Route::group(['middleware'=> 'auth'], function() {
    Route::get('/profile', function () {
        return "Profile Page in Construction...";
    });

});
//rutas para manejar la opcion de OLVIDE CONTRASEÑA
Route::get('/forget-password', [ForgetPasswordManager::class, 'forgetPassword'])
->name( 'forget.password' );

Route::post('/forget-password', [ForgetPasswordManager::class, 'forgetPasswordPost'])
->name( 'forget.password.post' );

Route::get('/reset-password/{token}', [ForgetPasswordManager::class, 'resetPassword'])
->name( 'reset.password' );

Route::post('/reset-password', [ForgetPasswordManager::class, 'resetPasswordPost'])
->name( 'reset.password.post' );


