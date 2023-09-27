<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', App\Http\Livewire\Jurnal::class)->name('home')->middleware('auth');

// Example
Route::group(['middleware' => ['auth', 'role:admin|pokja|guru'], 'prefix' => 'example'], function () {
    Route::get('crud', App\Http\Livewire\Example\CRUDLivewire::class)->name('example.crud');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get('jurnal', App\Http\Livewire\Jurnal::class)->name('jurnal');
    Route::get('dudi', App\Http\Livewire\Dudi::class)->name('dudi');
    Route::get('siswa', App\Http\Livewire\Siswa::class)->name('siswa');
    Route::get('siswa-pkl', App\Http\Livewire\Siswapkl::class)->name('siswa-pkl');
    Route::get('siswa-pkl/tambah', App\Http\Livewire\Addsiswapkl::class)->name('siswa-pkl.tambah');
    Route::get('users', App\Http\Livewire\Setting\User::class)->name('users');
    //Route::post('import-user', [UserController::class, 'import'])->name('import-user');
    Route::get('ta', App\Http\Livewire\Setting\TahunAjaran::class)->name('ta');
    Route::get('jurusan', App\Http\Livewire\Setting\Jurusan::class)->name('jurusan');
    Route::get('kelas', App\Http\Livewire\Setting\Kelas::class)->name('kelas');
    Route::get('jenis-kegiatan', App\Http\Livewire\Setting\JenisKegiatan::class)->name('jenis-kegiatan');
});
