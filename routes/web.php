<?php

use App\Http\Controllers\SocialController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\PasswordReset;




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


// Route::get('/', function () {
//     return view('main'); 
// })->name('home');
Route::get('/', function () {
    $avatar = session('avatar');
    return view('main', compact('avatar'));
})->name('home');



Auth::routes([
    // 'login' => false,
    // 'register' => false,
    // 'password.request' => false,
    // 'verify' => true,
]);



Route::get('/auth/redirect', [SocialController::class, 'redirect'])->name('google.redirect');
Route::get('/google.redirect', [SocialController::class, 'googleCallback'])->name('google.callback');
Route::post('/google/addPhone', [SocialController::class, 'addPhone'])->name('google.addPhone');




Route::view('/admin', 'pages.admin.dashboard.main');
Route::view('/produk', 'pages.admin.product');
Route::view('/category', 'pages.admin.category');
Route::view('/user', 'pages.admin.user');


Route::get('/shop', function () {
    $avatar = session('avatar');
    return view('pages.user.shop', compact('avatar'));
})->name('shop');


    
Route::middleware('guest')->group(function () {
        
        Route::view('/register', 'main');
        
    // Route::get('/login', Login::class)->name('login');
    // Route::get('/register', Register::class)->name('register');
    // Route::get('/forgot-password', PasswordReset::class)->name('forgot-password');
    // Route::get('/confirm-reset', PwdResetConfirm::class)->name('confirm-reset');
});
Route::middleware('auth')->group(function () {
//    Route::get('/', SocialController::class)->name('redirect');
   
      
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
