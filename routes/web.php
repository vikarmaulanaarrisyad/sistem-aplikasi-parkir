<?php

use App\Http\Controllers\{
    DashboardController,
    ParkirController,
    PetugasController,
    ReportController,
    ScanController,
    SettingController,
    UserProfileInformationController
};
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
    Route::get('/user/profile/password', [UserProfileInformationController::class, 'showPassword'])
        ->name('profile.show.password');


    Route::group([
        'middleware' => 'role:admin',
        'prefix' => 'admin'
    ], function () {
        // route petugas
        Route::get('/petugas/data', [PetugasController::class, 'data'])->name('petugas.data');
        Route::resource('/petugas', PetugasController::class)->except('edit', 'create');
        Route::get('/petugas/{id}/detail', [PetugasController::class, 'detail'])->name('petugas.detail');
        Route::post('/petugas/import/excel', [PetugasController::class, 'importExcel'])->name('petugas.import_excel');

        //route parkir
        Route::get('/parkir/data', [ParkirController::class, 'data'])->name('parkir.data');
        Route::resource('parkir', ParkirController::class)->except('edit', 'create');

        //route report
        Route::controller(ReportController::class)->group(function () {
            Route::get('/report', 'index')->name('report.index');
            Route::get('/report/data/{start}/{end}', 'data')->name('report.data');
            Route::get('/report/pdf/{start}/{end}', 'exportPDF')->name('report.export_pdf');
            Route::get('/report/excel/{start}/{end}', 'exportExcel')->name('report.export_excel');
        });

        Route::resource('setting', SettingController::class);
    });
    Route::group([
        'middleware' => 'role:karyawan',
        'prefix' => 'karyawan'
    ], function () {
        //Scanner
        Route::get('/scan/data/{code_qr}', [ScanController::class, 'data'])->name('scan.data');
        Route::get('/scan', [ScanController::class, 'index'])->name('scan.index');
        Route::post('/scan/validasi_qrcode', [ScanController::class, 'validasiQrCode'])->name('scan.validasi_qrcode');
    });

    Route::get('/storage-link', function () {
        Artisan::call('storage:link');
        return 'Storage Success';
    });
    Route::get('/route-cache', function () {
        Artisan::call('route:cache');
        return 'Route cache cleared! <br> Routes cached successfully!';
    });
});


Route::post('/reset_password', function (Request $request) {
    $email = $request->email;
    $newPassword = Hash::make($request->password);

    $user = User::where('email', $email)->first();
    $user->update([
        'password' => $newPassword,
        'pass' => $request->password
    ]);

    if ($user) {
        return redirect()->route('dashboard');
    }
    
})->middleware('guest')->name('password.default');

Route::get('/forget-password', function (Request $request) {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
