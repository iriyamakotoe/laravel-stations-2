<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReservationController;

// Route::get('URL', [Controllerの名前::class, 'Controller内のfunction名']);
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/{id}', [MovieController::class, 'detailMovie']);
Route::get('/admin/movies', [MovieController::class, 'admin']);
Route::get('/admin/movies/create', [MovieController::class, 'createMovie']);
Route::get('/admin/movies/{id}', [MovieController::class, 'detailAdminMovie']);
Route::post('/admin/movies/store', [MovieController::class, 'postMovie']);
Route::get('/admin/movies/{id}/edit', [MovieController::class, 'editMovie']);
Route::patch('/admin/movies/{id}/update', [MovieController::class, 'patchMovie']);
Route::delete('/admin/movies/{id}/destroy', [MovieController::class, 'deleteMovie']);

Route::get('/admin/schedules', [ScheduleController::class, 'adminSchedule']);
Route::get('/admin/schedules/{id}', [ScheduleController::class, 'detailSchedule']);
Route::get('/admin/movies/{id}/schedules/create', [ScheduleController::class, 'createSchedule']);
Route::post('/admin/movies/{id}/schedules/store', [ScheduleController::class, 'postSchedule']);
Route::get('/admin/schedules/{id}/edit', [ScheduleController::class, 'editSchedule']);
Route::patch('/admin/schedules/{id}/update', [ScheduleController::class, 'patchSchedule']);
Route::delete('/admin/schedules/{id}/destroy', [ScheduleController::class, 'deleteSchedule']);

Route::get('/sheets', [SheetController::class, 'sheets']);

Route::get('/movies/{movie_id}/schedules/{schedule_id}/sheets', [ReservationController::class, 'getSheets']);
Route::get('/movies/{movie_id}/schedules/{schedule_id}/reservations/create', [ReservationController::class, 'createReservation']);
Route::post('/reservations/store', [ReservationController::class, 'postReservation']);

Route::get('/admin/reservations', [ReservationController::class, 'adminReservation']);
Route::get('/admin/reservations/create', [ReservationController::class, 'createAdminReservation']);
Route::post('/admin/reservations', [ReservationController::class, 'postAdminReservation']);
Route::get('/admin/reservations/{id}/edit', [ReservationController::class, 'editReservation']);
Route::patch('/admin/reservations/{id}', [ReservationController::class, 'patchReservation']);
Route::delete('/admin/reservations/{id}', [ReservationController::class, 'deleteReservation']);



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
