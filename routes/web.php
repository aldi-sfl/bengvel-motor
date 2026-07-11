<?php

use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\Admin\Product\Preview;
use App\Http\Controllers\ListOrderController;
use App\Http\Controllers\Payment_MethodController;
use App\Http\Controllers\ProductInfoController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\TransactionAdminController;
use App\Http\Controllers\UserAdminController;
use App\Http\Livewire\UserPage\Transaction\Checkout;
use App\Http\Livewire\UserPage\Transaction\CheckOngkir;
use App\Models\settings;

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
    $heroImage = settings::all();
    return view('main', compact('avatar', 'heroImage'));
})->name('homepage');


Auth::routes([
    // 'login' => false,
    // 'register' => false,
    // 'password.request' => false,
    'verify' => true,
]);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


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

Route::middleware('guest')->group(function () {
        
        
// Route::view('/register', 'main');
        
    // Route::get('/login', Login::class)->name('login');
    // Route::get('/register', Register::class)->name('register');
    // Route::get('/forgot-password', PasswordReset::class)->name('forgot-password');
    // Route::get('/confirm-reset', PwdResetConfirm::class)->name('confirm-reset');
});

Route::middleware('auth')->group(function () {
//    Route::get('/', SocialController::class)->name('redirect');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/updateProfile', [ProfileController::class, 'updateProfile'])->name('profileUpdate');
    
    Route::get('/cart', function () {
        $avatar = session('avatar');
        $title = 'Keranjang Belanja - Orbit Motor';
        return view('pages.user.cart.shoppingCart', compact('avatar','title'));
    })->name('cart');

    
    // livewire component
    Route::get('/checkout/{id}', Checkout::class)->name('checkout.show');

    
    Route::get('/payment/{id}', [paymentController::class, 'index'])->name('payment');
    Route::get('/myOrder', [ListOrderController::class, 'index'])->name('myOrder');
    
    Route::post('/myOrder/Cart/{id}', [ListOrderController::class, 'buyAgain'])->name('beli-lagi');
    
    Route::get('/invoice/download/{id}', [InvoiceController::class, 'view_pdf'])->name('download.invoice');
    Route::get('/invoice/{id}', [InvoiceController::class,  'index'])->name('invoice');
});

Route::middleware('admin')->group(function () {
//    Route::get('/', SocialController::class)->name('redirect');

    Route::get('/admin', [SalesController::class, 'salesReport'])->name('admin');

    // Route::view('/admin', 'pages.admin.dashboard.main')->name('admin');

    
    // admin pages
    Route::view('/admin/produk', 'pages.admin.product')->name('produk'); 
    Route::view('/admin/category', 'pages.admin.category')->name('category');
    
    // Route::view('/admin/transaction', 'pages.admin.transactionAdmin')->name('transaction');
    // Route::view('/admin/user', 'pages.admin.user')->name('user');
    
    Route::get('/admin/transaction', [TransactionAdminController::class, 'index'])->name('transaction');
    Route::get('/admin/transaction/view/{id}', [TransactionAdminController::class, 'view_pdf'])->name('transaction-detail');
    Route::get('/admin/transaction/view/download/{id}', [TransactionAdminController::class, 'download_pdf'])->name('transaction-download');
    Route::put('/admin/transactions/{id}/status', [TransactionAdminController::class, 'changeStatus'])->name('transaction.changeStatus');
    
    Route::get('/admin/users', [UserAdminController::class, 'index'])->name('user-admin');
    Route::get('/admin/users/add', [UserAdminController::class, 'addUser'])->name('add-user');
    Route::post('/admin/users/add/create', [UserAdminController::class, 'create'])->name('create-user');
    Route::delete('/user/{id}', [UserAdminController::class, 'delete'])->name('user.delete');

    Route::get('/admin/users/edit/{id}', [UserAdminController::class, 'edit'])->name('edit-user');
    Route::put('/admin/users/{id}', [UserAdminController::class, 'update'])->name('update-user');

    Route::get('/admin/list-payment', [Payment_MethodController::class, 'index'])->name('list-payment');
    Route::post('/admin/list-payment', [Payment_MethodController::class, 'store'])->name('list-payment.store');
    Route::get('/admin/list-payment/edit/{id}', [Payment_MethodController::class, 'edit'])->name('payment-methods.edit');
    Route::post('/admin/list-payment/update/{id}', [Payment_MethodController::class, 'update'])->name('payment-methods.update');
    Route::post('/admin/list-payment/delete/{id}', [Payment_MethodController::class, 'destroy'])->name('payment-methods.destroy');

    Route::get('/admin/settings', [HeroController::class, 'index'])->name('settings');
    Route::post('/admin/settings', [HeroController::class, 'insert'])->name('hero-insert');
});





// just testing routes\
// Route::get('/download', [ListOrderController::class, 'view_pdf'])->name('download');

// Route::get('/myOrder/detail/{id}', [ListOrderController::class, 'view_pdf'])->name('details');

// Route::get('/myOrder/view/{id}', [InvoiceController::class, 'index'])->name('view');

