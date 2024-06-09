<?php

use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use App\Models\Schedule;
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
    return view('pages.auth.auth-login', ['type_menu' => '']);
});
Route::get('/forget', function(){
    return view('pages.auth.auth-forgot-password');
})->name('forget');

Route::middleware(['auth'])->group(function () {

    Route::get('home', function () {
        return view('pages.app.dashboard-sirapat', ['type_menu' => '']);
    })->name('home');
    Route::resource('profile', ProfileController::class);
    Route::middleware('role:admin')->resource('user', UserController::class);
    Route::get('schedule/list', [ScheduleController::class, 'listSchedule'])->name('schedule.list');
    Route::resource('schedule', ScheduleController::class);
    // Route::put('schedule/{schedule}', [ScheduleController::class, 'update'])->name('schedule.update');
    // Route::middleware('role:admin')->resource('student', StudentController::class);
    Route::resource('student', StudentController::class);
    Route::resource('presence', PresenceController::class)->except('show');
    // Route::get('/create-presence', [PresenceController::class, 'create'])->name('create-presence');
    Route::get('/presence/{schedule:title}', [PresenceController::class, 'show'])->name('presence.show');
});




// Route::get('/', function () {

//       return view('pages.app.dashboard-simpadu', ['type_menu'=> '']);

//   });

// Route::get('/login', function () {

//     return view('pages.auth.auth-login');

// })->name('login');
// Route::get('/register', function () {

//       return view('pages.auth.auth-register');

// })->name('register');
// Route::get('/forgot', function () {

//     return view('pages.auth.auth-forgot-password');

// })->name('forgot');
// Route::get('/reset', function () {

//     return view('pages.auth.auth-reset-password');

// })->name('reset');
