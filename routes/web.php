<?php

use Illuminate\Support\Facades\Route;
use App\Models\Fasilitas;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\Pemohon\PeminjamanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PemohonDashboardController;
use App\Http\Controllers\Pemohon\PembayaranController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $fasilitas = Fasilitas::with([
        'bagian',
        'peminjaman' => function($q){
            $q->whereIn('status', [
    'disetujui',
    'dibayar',
    'menunggu_pengembalian'
]);
        }
    ])->get();

    return view('welcome', compact('fasilitas'));
});
/*
|--------------------------------------------------------------------------
| DASHBOARD REDIRECT
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/dashboard', function () {

    $role = auth()->user()->getRoleNames()->first();

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'petugas' => redirect()->route('petugas.dashboard'),
        'pemohon' => redirect()->route('pemohon.dashboard'),
        default => redirect('/'),
    };

})->name('dashboard');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED AREA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | ADMIN AREA
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
        })->name('dashboard');

    Route::resource('fasilitas', FasilitasController::class)
        ->parameters(['fasilitas' => 'fasilitas']); // 🔥 FIX PARAMETER

            // 🔥 DATA PENGGUNA
    Route::resource('users', UserController::class);

    Route::get('fasilitas/{fasilitas}/bagian',
            [App\Http\Controllers\Admin\BagianFasilitasController::class, 'index']
        )->name('bagian.index');

        Route::get('fasilitas/{fasilitas}/bagian/create',
            [App\Http\Controllers\Admin\BagianFasilitasController::class,'create']
        )->name('bagian.create');

        Route::post('fasilitas/{fasilitas}/bagian',
            [App\Http\Controllers\Admin\BagianFasilitasController::class,'store']
        )->name('bagian.store');

        Route::get('bagian/{bagian}/edit',
            [App\Http\Controllers\Admin\BagianFasilitasController::class,'edit']
        )->name('bagian.edit');

        Route::put('bagian/{bagian}',
            [App\Http\Controllers\Admin\BagianFasilitasController::class,'update']
        )->name('bagian.update');

        Route::get('/laporan',
        [App\Http\Controllers\Admin\LaporanController::class, 'index'])
        ->name('laporan.index');

        Route::get('/laporan/download',
        [App\Http\Controllers\Admin\LaporanController::class, 'download'])
        ->name('laporan.download');

        Route::get('/peminjaman',
        [App\Http\Controllers\Admin\DataPeminjamanController::class, 'index'])
        ->name('peminjaman.index');

        Route::get('/peminjaman/{id}',
        [App\Http\Controllers\Admin\DataPeminjamanController::class, 'show'])
        ->name('peminjaman.show');
        });


    /*
    |--------------------------------------------------------------------------
    | PETUGAS LAYANAN AREA
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:petugas')
        ->prefix('petugas')
        ->name('petugas.')
        ->group(function () {

            Route::get('/dashboard', 
    [App\Http\Controllers\Petugas\PeminjamanController::class,'dashboard']
)->name('dashboard');


            Route::get('/verifikasi', 
            [App\Http\Controllers\Petugas\PeminjamanController::class,'verifikasi']
        )->name('verifikasi');

        Route::post('/setujui/{id}', 
            [App\Http\Controllers\Petugas\PeminjamanController::class,'setujui']
        )->name('setujui');

        Route::post('/tolak/{id}', 
            [App\Http\Controllers\Petugas\PeminjamanController::class,'tolak']
        )->name('tolak');

        Route::get('/peminjaman/{id}/download',
        [App\Http\Controllers\Petugas\PeminjamanController::class,'download']
        )->name('download');

        Route::get('/verifikasi-pembayaran',
            [App\Http\Controllers\Petugas\VerifikasiPembayaranController::class, 'index'])
            ->name('verifikasi.index');

        Route::post('/verifikasi/{pembayaran}/valid',
            [App\Http\Controllers\Petugas\VerifikasiPembayaranController::class, 'valid'])
            ->name('verifikasi.valid');

        Route::post('/verifikasi/{pembayaran}/tolak',
            [App\Http\Controllers\Petugas\VerifikasiPembayaranController::class, 'tolak'])
            ->name('verifikasi.tolak');

        Route::get('/laporan',
            [App\Http\Controllers\Petugas\LaporanController::class, 'index'])
            ->name('laporan.index');

            Route::get('/pengembalian',
            [App\Http\Controllers\Petugas\PengembalianController::class, 'index'])
            ->name('pengembalian.index');

            Route::get('/pengembalian/{id}',
            [App\Http\Controllers\Petugas\PengembalianController::class, 'show'])
            ->name('pengembalian.show');

            Route::post('/pengembalian/{id}/valid',
            [App\Http\Controllers\Petugas\PengembalianController::class, 'valid'])
            ->name('pengembalian.valid');

            Route::post('/pengembalian/{id}/tolak',
            [App\Http\Controllers\Petugas\PengembalianController::class, 'tolak'])
            ->name('pengembalian.tolak');
        });


    /*
    |--------------------------------------------------------------------------
    | PEMOHON AREA
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:pemohon')
        ->prefix('pemohon')
        ->name('pemohon.')
        ->group(function () {

            Route::get('/dashboard', [PemohonDashboardController::class, 'index'])
                ->name('dashboard');

            Route::get('/fasilitas', [PeminjamanController::class, 'fasilitas'])
                ->name('fasilitas');

            Route::get('/fasilitas/{fasilitas}', [PeminjamanController::class, 'showFasilitas'])
                ->name('fasilitas.show');

            Route::resource('peminjaman', PeminjamanController::class);
            Route::get('/pembayaran', [PembayaranController::class, 'index'])
                ->name('pembayaran.index');
            
            Route::get('/pengembalian', function() {
            return view('pemohon.pengembalian.index');})
            ->name('pengembalian.index');

            Route::get('peminjaman/{peminjaman}/download',
            [App\Http\Controllers\Pemohon\PeminjamanController::class, 'download']
            )->name('peminjaman.download');

            Route::post('/pembayaran/store',
            [App\Http\Controllers\Pemohon\PembayaranController::class, 'store']
            )->name('pembayaran.store');

            Route::get('/pembayaran/{peminjaman}/download',
            [App\Http\Controllers\Pemohon\PembayaranController::class, 'download'])
            ->name('pembayaran.download');

            Route::get('/pembayaran/{peminjaman}/surat',
            [App\Http\Controllers\Pemohon\PembayaranController::class, 'surat'])
            ->name('pembayaran.surat');

            Route::get('/pengembalian', 
            [App\Http\Controllers\Pemohon\PengembalianController::class, 'index'])
            ->name('pengembalian.index');

            Route::post('/pengembalian/store',
            [App\Http\Controllers\Pemohon\PengembalianController::class, 'store'])
            ->name('pengembalian.store');

            Route::get('/riwayat',
            [App\Http\Controllers\Pemohon\RiwayatController::class, 'index'])
            ->name('riwayat.index');
        });

});

require __DIR__.'/auth.php';
