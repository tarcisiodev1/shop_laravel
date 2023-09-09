<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Models\Order;
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
    return view('home');
})->name('home');
Route::get('clear-session-message', [SessionController::class, 'clearMessage'])->name('clear.session.message');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// ->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });

    Route::resource('products', ProductController::class);
    Route::get('/register', [RegisteredUserController::class, 'createAdmin'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'storeAdmin'])->name('store');
    Route::get('/users', [AdminController::class, 'indexUser'])->name('users.index');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
});

Route::get('/test', [OrderController::class, 'indexAdmin']);

Route::middleware('auth')->group(function () {

    // Route::get('/admin', function () {
    //     return view('admin.index');
    // });
    // Route::Resource('products', ProductController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
