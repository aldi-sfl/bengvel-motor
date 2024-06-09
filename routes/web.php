<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Livewire\Admin\Product\Preview;
use App\Http\Controllers\ListOrderController;
use App\Http\Controllers\ProductInfoController;
use App\Http\Livewire\UserPage\Transaction\Checkout;
use App\Http\Livewire\UserPage\Transaction\CheckOngkir;

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






// user pages

Route::get('/shop', function () {
    $avatar = session('avatar');
    $title = 'Shop - Orbit Motor';
    return view('pages.user.shop', compact('avatar','title'));
})->name('shop');

Route::get('/contact', function () {
    $avatar = session('avatar');
    $title = 'Contact - Orbit Motor';
    return view('pages.user.contact.index', compact('avatar','title'));
})->name('contact');

Route::get('/shop/product/{name}/{hashedId}', [ProductInfoController::class, 'index']);

// checkout
// regular controller
// Route::get('/checkout/{id}', [CheckoutController::class, 'index'])->name('checkout.show');

// livewire component
Route::get('/checkout/{id}', Checkout::class)->name('checkout.show');

    Route::middleware('guest')->group(function () {
        
        
        Route::view('/register', 'main');
        
    // Route::get('/login', Login::class)->name('login');
    // Route::get('/register', Register::class)->name('register');
    // Route::get('/forgot-password', PasswordReset::class)->name('forgot-password');
    // Route::get('/confirm-reset', PwdResetConfirm::class)->name('confirm-reset');
});

Route::middleware('auth')->group(function () {
//    Route::get('/', SocialController::class)->name('redirect');
    
    Route::get('/cart', function () {
        $avatar = session('avatar');
        $title = 'Keranjang Belanja - Orbit Motor';
        return view('pages.user.cart.shoppingCart', compact('avatar','title'));
    })->name('cart');

    
    Route::get('/payment/{id}', [paymentController::class, 'index'])->name('payment');
    Route::get('/myOrder', [ListOrderController::class, 'index'])->name('myOrder');

});

Route::middleware('admin')->group(function () {
//    Route::get('/', SocialController::class)->name('redirect');
   
    Route::view('/admin', 'pages.admin.dashboard.main');
    
    // admin pages
    Route::view('/produk', 'pages.admin.product');
    // Route::view('/preview', 'pages.admin.previewProduc 
    Route::view('/category', 'pages.admin.category');
    Route::view('/user', 'pages.admin.user');

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// just testing routes\

