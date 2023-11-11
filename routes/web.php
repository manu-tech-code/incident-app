<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IncidentRequestController;
use App\Models\User;
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
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $users = User::all();
    $admin = User::whereRole(1)->get();
    $personnel = User::whereRole(2)->get();
    $employees = User::whereRole(3)->get();
    $requests = \App\Models\IncidentRequest::all();
    return view('dashboard', compact('users', 'personnel', 'employees', 'requests','admin'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/incidents', IncidentRequestController::class);
    Route::post('incidents/{incident}', [IncidentRequestController::class, 'assign'])->name('incidents.assign');
    Route::patch('incidents/status/{incident}', [IncidentRequestController::class, 'status'])->name('incidents.status');
    Route::controller(\App\Http\Controllers\AdminController::class)->group(function (){
        Route::get('/add-user','index')->name('adduser.index');
        Route::post('/add-user','adduser')->name('adduser.create');
        Route::get('/users','allUsers')->name('users');
        Route::get('/report', 'incidentsReport')->name('report');
        Route::get('/generate-pdf', 'generatePDF')->name('generate-pdf');
        Route::get('/generate-excel', 'generateExcel')->name('generate-excel');
    });
});

require __DIR__.'/auth.php';
