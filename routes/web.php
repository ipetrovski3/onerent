<?php

use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CarModelsController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/cars', [CarsController::class, 'front_index'])->name('cars.front.index');
Route::get('/cars/{id}', [CarsController::class, 'front_show'])->name('front.show');
Route::post('/get_cars', [CarsController::class, 'set_dates'])->name('set_dates');
Route::post('/booked-days', [CarsController::class, 'car_booked_days'])->name('car_booked_days');
Route::post('/update-car-price', [CarsController::class, 'update_car_price'])->name('update_car_price');

Route::get('about-us', function () {
    return view('front.about-us');
})->name('about');

Route::get('terms-and-conditions', function () {
    return view('front.terms');
})->name('terms');

Route::get('/contact', function () {
    return view('front.contact');
})->name('contact');

Route::post('/contact-us', [ContactsController::class, 'create'])->name('contact_us');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/available-cars', [BookingsController::class, 'first_step_booking'])->name('first_step');
Route::post('/create-client', [ClientsController::class, 'create'])->name('clients.create');

Route::prefix('dashboard')->middleware('auth')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('cars')->group(function() {
        Route::get('/', [CarsController::class, 'index'])->name('cars.index');
        Route::get('/new', [CarsController::class, 'new'])->name('cars.new');
        Route::post('/store', [CarsController::class, 'store'])->name('cars.store');
        Route::post('/select-brand', [CarsController::class, 'select_brand'])->name('select.brand');
        Route::post('/car-status', [CarsController::class, 'car_status'])->name('car.status');
    });
    Route::prefix('bookings')->group(function () {
        Route::get('/', [BookingsController::class, 'index'])->name('bookings.index');
        Route::get('/by-car', [BookingsController::class, 'by_car'])->name('bookings.by_car');
    });
    Route::prefix('models')->group(function() {
        Route::get('/new', [CarModelsController::class, 'new'])->name('models.new');
        Route::post('/store', [CarModelsController::class, 'store'])->name('models.store');
    });
});
