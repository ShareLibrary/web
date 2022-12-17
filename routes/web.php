<?php

use App\Http\Controllers\{
    BooksController,
    CategoriesController,
    CustomAuthController,
    OrderController,
    ProfileController,
};
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    /**
     * Book
     */
    Route::name('book.')
        ->controller(BooksController::class)
        ->prefix('book')
        ->group(function () {
            Route::get('/', 'list')->name('list');
            Route::get('/add', 'add')->name('add');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/insert', 'insert')->name('insert');
            Route::post('/update/{id}', 'update')->name('update');
        });

    /**
     * Category
     */
    Route::name('category.')
        ->prefix('category')
        ->controller(CategoriesController::class)
        ->group(function () {
            Route::get('/', 'list')->name('list');
            Route::get('/add', 'add')->name('add');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/insert', 'insert')->name('insert');
            Route::post('/update/{id}', 'update')->name('update');
        });

    /**
     * Order
     */
    Route::name('order.')
        ->prefix('order')
        ->controller(OrderController::class)
        ->group(function () {
            Route::get('/', 'list')->name('list');
            Route::get('/detail/{id}', 'detail')->name('detail');
        });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * Profile
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(CustomAuthController::class)->group(function () {
    /**
     * Login
     */
    Route::get('login', 'index')->name('login');
    Route::post('custom-login', 'customLogin')->name('login.custom');

    /**
     * Registration
     */
    Route::get('registration', 'registration')->name('registration');
    Route::post('custom-registration', 'customRegistration')->name('registration.custom');

    /**
     * Sign out
     */
    Route::get('signout', 'signOut')->name('signout');
});



//require __DIR__.'/auth.php';
