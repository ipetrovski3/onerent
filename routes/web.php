<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CarModelsController;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Dashboard\Bookings\CarAvailabilityMonth;

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
Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cars', function () {
    return view('cars.index');
})->name('cars.index');

Route::get('/cars/{id}', [CarsController::class, 'show_car'])->name('show.car');

Route::get('about-us', function () {
    return view('about-us');
})->name('about');

Route::get('terms-and-conditions', function () {
    return view('terms');
})->name('terms');

Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

Route::post('/contact-us', [ContactsController::class, 'create'])->name('contact');

//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Route::get('/available-cars', [BookingsController::class, 'first_step_booking'])->name('first_step');
// Route::get('/available-cars', [App\Http\Livewire\Bookings::class, 'first_step_booking'])->name('first_step');
Route::post('/create-client', [ClientsController::class, 'create'])->name('clients.create');

Route::controller(CarsController::class)
    ->group(function () {
        Route::get('/available-cars/{booking_id}', 'available_cars')->name('available-cars');
        // Route::get('/registration-dog-info', 'registration_dog_info')->name('registration_dog_info');
        // Route::get('/registration-map', 'registration_map')->name('registration_map');
        // Route::get('/registration-subscription', 'registration_subscription')->name('registration_subscription');
    });

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/cars', function () {
        return view('dashboard.cars.index');
    })->name('detail.cars.index');
    
    Route::get('/cars/new', function () {
        return view('dashboard.cars.car-form');
    })->name('add.car');
    
    Route::get('/models/new', function () {
        return view('dashboard.cars.car-model-form');
    })->name('add.car.model');

    Route::get('/bookings', function () {
        return view('dashboard.bookings.index');
    })->name('bookings.index');

    Route::get('/calendar', function () {
        return view('calendar');
    })->name('calendar');
});
