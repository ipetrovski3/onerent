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

// Route::get('/', [HomeController::class, 'index'])->name('homepage');
// Route::get('/cars', [CarsController::class, 'front_index'])->name('cars.front.index');
// Route::get('/cars/{id}', [CarsController::class, 'front_show'])->name('front.show');
// Route::post('/get_cars', [CarsController::class, 'set_dates'])->name('set_dates');
Route::post('/booked-days', [CarsController::class, 'car_booked_days'])->name('car_booked_days');
Route::post('/update-car-price', [CarsController::class, 'update_car_price'])->name('update_car_price');

// Route::get('/', [HomeController::class, 'index'])->name('homepage');
// Route::get('/', function () {
//     return view('front.index');
// })->name('homepage');

// Route::get('/cars', [CarsController::class, 'front_index'])->name('cars.front.index');
Route::get('/cars/{id}', [CarsController::class, 'show_car'])->name('show.car');
// Route::post('/get_cars', [CarsController::class, 'set_dates'])->name('set_dates');
// Route::post('/booked-days', [CarsController::class, 'car_booked_days'])->name('car_booked_days');
// Route::post('/update-car-price', [CarsController::class, 'update_car_price'])->name('update_car_price');

Route::get('about-us', function () {
    return view('about-us');
})->name('about');

Route::get('terms-and-conditions', function () {
    return view('terms');
})->name('terms');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact-us', [ContactsController::class, 'create'])->name('contact_us');

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

// Route::get('/available-cars', [BookingsController::class, 'first_step_booking'])->name('first_step');
// Route::get('/available-cars', [App\Http\Livewire\Bookings::class, 'first_step_booking'])->name('first_step');
Route::post('/create-client', [ClientsController::class, 'create'])->name('clients.create');

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('cars')->group(function () {
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
    Route::prefix('models')->group(function () {
        Route::get('/new', [CarModelsController::class, 'new'])->name('models.new');
        Route::post('/store', [CarModelsController::class, 'store'])->name('models.store');
    });
    Route::get('/calendar', function () {
        return view('calendar');
    })->name('calendar');
});




Route::controller(CarsController::class)
    ->group(function () {
        Route::get('/available-cars/{booking_id}', 'available_cars')->name('available-cars');
        // Route::get('/registration-dog-info', 'registration_dog_info')->name('registration_dog_info');
        // Route::get('/registration-map', 'registration_map')->name('registration_map');
        // Route::get('/registration-subscription', 'registration_subscription')->name('registration_subscription');
    });

// Route::get('/available-cars/{booking_id}', function () {
//     return view('cars.available-cars');
// })->name('available-cars');


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
    
});

Route::get('/cars', function () {
    return view('cars.index');
})->name('cars.index');

// Route::get('/calendar', function () {
//     return view('calendar');
// })->name('calendar');

Route::get('/calendar-month', function () {
    return view('calendar-month');
})->name('calendar-month');

// Route::livewire('calendar/month', CarAvailabilityMonth::class)->name('calendar.month');
