<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleTypeController;
use App\Http\Controllers\WasherController;
use App\Http\Controllers\WashTransactionController;
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
// Auth::routes(['verify' => true]);

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified']);

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__.'/auth.php';

Route::middleware(['role_web:1', 'verified'])
    ->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('admin/users', 'index')->name('users.index');
            Route::get('admin/users/create', 'create')->name('users.create');
            Route::post('admin/users/create', 'store')->name('users.store');
            Route::get('admin/users/edit/{id}', 'edit')->name('users.edit');
            Route::put('admin/users/update/{id}', 'update')->name('users.update');
            Route::get('user/edit/profile/{id}', 'editProfile')->name('profile.edit');
            Route::post('user/update/profile/{id}', 'updateProfile')->name('profile.update');
            Route::post('admin/users/delete', 'destroy')->name('users.delete');
            Route::post('admin/users/reset-password/{id}', 'resetPassword')->name('users.resetPassword');
            Route::post('admin/users/import-users', 'import')->name('users.import');
        });

        //# Role
        Route::controller(RoleController::class)->group(function () {
            Route::get('admin/roles', 'index')->name('roles.index');
            Route::get('admin/roles/create', 'create')->name('roles.create');
            Route::post('admin/roles/store', 'store')->name('roles.store');
            Route::get('admin/roles/edit/{id}', 'edit')->name('roles.edit');
            Route::put('admin/roles/update/{id}', 'update')->name('roles.update');
            Route::delete('admin/roles/hapus/{id}', 'destroy')->name('roles.delete');
        });
        //# Absen

        //# Setting
        Route::controller(SettingController::class)->group(function () {
            Route::get('admin/settings', 'edit')->name('settings.edit');
            Route::post('admin/settings', 'update')->name('settings.update');
        });

        Route::resource('vehicle-types', VehicleTypeController::class)->except(['create', 'show', 'edit']);
        Route::resource('vehicles', VehicleController::class)->except(['create', 'show', 'edit']);
        Route::resource('washers', WasherController::class)->except(['create', 'show', 'edit']);

        Route::resource('logs', LogController::class)->except(['create', 'show', 'edit', 'update', 'destroy']);

        Route::get('wash-transactions/invoice/{id}', [WashTransactionController::class, 'generateInvoice'])->name('wash-transactions.invoice');
        Route::resource('wash-transactions', WashTransactionController::class)->except(['create', 'show', 'edit']);
    });
