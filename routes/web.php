<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\AppointmentStatusController;
use App\Http\Controllers\Admin\DashboardStatController;
use App\Http\Controllers\Admin\ProfileController;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
//     return view('dashboard');
// });

// Route::get('/dasboard', function () {
//     return view('dashboard');
// });
Route::middleware('auth')->group(function () {

    Route::get('/api/stats/appointments', [DashboardStatController::class, 'index']);
    Route::get('/api/stats/appointments', [DashboardStatController::class, 'getAppointmentsCount']);
    Route::get('/api/appointments', [DashboardStatController::class, 'getAllAppointments']);
    Route::get('/api/stats/pie-chart-data', [DashboardStatController::class, 'getPieChartData']);

    Route::get('/api/users', [UserController::class, 'index']);
    Route::post('/api/users', [UserController::class, 'store']);
    // Route::get('/api/users/search', [UserController::class, 'search']);
    Route::put('/api/users/{user}', [UserController::class, 'update']);
    Route::delete('/api/users/{user}', [UserController::class, 'destory']);
    Route::delete('/api/users', [UserController::class, 'bulkDelete']);
    Route::get('/api/appointments-status', [AppointmentStatusController::class, 'getStatusCount']);
    Route::get('/api/appointments', [AppointmentController::class, 'index']);
    Route::post('/api/appointments', [AppointmentController::class, 'store']);
    Route::delete('/api/appointments/{appointment}', [AppointmentController::class, 'destroy']);
    Route::get('/api/appointments/{appointment}', [AppointmentController::class, 'show']);
    Route::put('/api/appointments/{appointment}', [AppointmentController::class, 'update']);

    Route::get('/api/profile', [ProfileController::class, 'index']);
    Route::put('/api/profile', [ProfileController::class, 'update']);
});


Route::get('{view}', ApplicationController::class)->where('view', '(.*)')->middleware('auth');
// Route::get('/api/users', [UserController::class, 'index']);
// Route::post('/api/users', [UserController::class, 'store']);
// Route::get('/api/users/search', [UserController::class, 'search']);
// Route::put('/api/users/{user}', [UserController::class, 'update']);
// Route::delete('/api/users/{user}', [UserController::class, 'destory']);
// Route::delete('/api/users', [UserController::class, 'bulkDelete']);

// Route::get('{view}', ApplicationController::class)->where('view', '(.*)')->middleware('auth');
