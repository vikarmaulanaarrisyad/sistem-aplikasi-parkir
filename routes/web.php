<?php

use App\Http\Controllers\{
    DashboardController,
    PetugasController
};
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
    return view('auth.login');
});

Route::group([
    'middleware' => ['auth', 'role:admin,karyawan'],
], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group([
        'middleware' => 'role:admin',
        'prefix' => 'admin'
    ], function () {
        // route petugas
        Route::get('/petugas/data', [PetugasController::class, 'data'])->name('petugas.data');
        Route::resource('/petugas', PetugasController::class)->except('edit', 'create');
        Route::post('/petugas/import/excel', [PetugasController::class, 'importExcel'])->name('petugas.import_excel');

    });
    Route::group([
        'middleware' => 'role:karyawan',
        'prefix' => 'karyawan'
    ], function () {
        //
    });
});
