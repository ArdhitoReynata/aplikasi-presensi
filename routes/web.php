<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Karyawan\HomeController as KaryawanHomeController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PresensiController2;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str; // Add this line at the top with your use statements
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [AuthController::class, 'verify'])->name('auth.verify');

Route::group(['middleware' => 'auth:admin'], function () {

    Route::get('/admin/home', [HomeController::class, 'index'])->name('admin.home.index');

    Route::get('/presensi-data', [PresensiController::class, 'getPresensiHariIni'])->name('admin.home.getPresensiHariIni');
    Route::get('/presensi-minggu-ini', [PresensiController::class, 'getPresensiMingguIni'])->name('admin.home.getPresensiMingguIni');
    Route::get('/presensi-bulan-ini', [PresensiController::class, 'getPresensiBulanIni'])->name('admin.home.getPresensiBulanIni');
    Route::get('/presensi-tahun-ini', [PresensiController::class, 'getPresensiTahunIni'])->name('admin.home.getPresensiTahunIni');

    Route::get('/admin/kodeqr', function () {
        return view('layout.admin.kodeqr');
    });

    Route::get('/admin/karyawan/karyawan', function () {
        $users = DB::table('users')->get();
        return view('layout.admin.karyawan.karyawan', [
            'users' => $users
        ]);
    })->name('admin.karyawan.karyawan');

    Route::post('/presensi', [PresensiController::class, 'store'])->middleware('auth');

    Route::get('/admin/karyawan/tambahkaryawan', function () {
        return view('layout.admin.karyawan.tambahkaryawan');
    });

    Route::get('/admin/karyawan/datakaryawan', function () {
        return view('layout.admin.karyawan.datakaryawan');
    });

    Route::post('/admin/karyawan/tambahkaryawan', function () {
        $data = request()->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:40',
            'nik' => 'required|string|max:40',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'jk' => 'required|string|max:40',
            'divisi' => 'required|string|max:50',
            'bagian' => 'required|string|max:50',
        ]);

        $defaultPassword = 'mpskudtanimulyo';

        $data['password'] = bcrypt($defaultPassword);
        $data['role'] = 'karyawan';
        $data['created_at'] = now();
        $data['updated_at'] = now();

        $qrCode = QrCode::format('svg')->size(200)->generate($data['nip']); // Anda bisa ganti dengan data lain
        $data['qr_code_data'] = $qrCode; // Menyimpan QR code sebagai data    

        DB::table('users')->insert($data);
        return redirect()->route('admin.karyawan.karyawan')->with('success', 'Karyawan berhasil ditambahkan.');
    });

    Route::post('/admin/karyawan/hapus', function (HttpRequest $request) {
        $ids = $request->input('ids');

        DB::table('users')->whereIn('nip', $ids)->delete(); // Pastikan untuk mengganti 'nip' dengan nama kolom yang tepat jika perlu

        return response()->json(['message' => 'Karyawan berhasil dihapus.']);
    })->name('admin.karyawan.hapus');

    Route::get('/admin/lihatkaryawan', function () {
        return view('layout.admin.karyawan.lihatkaryawan');
    });

    Route::get('/admin/cuti', function () {
        return view('layout.admin.cuti');
    });

    Route::post('/presensi/store', [PresensiController::class, 'store']); // Untuk menyimpan presensi
    Route::get('/admin/laporan', [PresensiController::class, 'index'])->name('admin.laporan');
});

Route::group(['middleware' => 'auth:karyawan'], function () {
    Route::get('/karyawan/home', [KaryawanHomeController::class, 'index'])->name('karyawan.home.index');

    Route::get('/karyawan/kodeqr', function () {
        $user = Auth::user();
        return view('layout.karyawan.kodeqr', compact('user'));
    });

    Route::get('/karyawan/perizinan', [PresensiController::class, 'formPerizinan']);
    Route::get('/ambilData/{user_id}', [PresensiController::class, 'getFormPerizinanData']);

    Route::get('/karyawan/cuti', function () {
        return view('layout.karyawan.cuti');
    });

    Route::get('/karyawan/kehadiran', function () {
        return view('layout.karyawan.kehadiran');
    });

    Route::get('/karyawan/pengaturan', function () {
        $user = Auth::user();
        return view('layout.karyawan.pengaturan', compact('user'));
    });
    Route::put('/updatePresensi/{user_id}', [PresensiController::class, 'updatePresensi']);
    Route::post('/presensi', [PresensiController::class, 'store']);
    Route::get('/presensi', [PresensiController::class, 'index']);
    Route::get('/karyawan/kehadiran', [PresensiController2::class, 'index']);
    Route::get('/karyawan/kehadiran', [PresensiController2::class, 'showLaporan']);
    Route::get('/karyawan/home', [PresensiController2::class, 'showLaporan2']);
    Route::post('/karyawan/pengaturan', [UserController::class, 'updateProfileImage'])->name('profile.updateImage');
    Route::post('/karyawan/update-password', [UserController::class, 'updatePassword'])->name('profile.updatePassword');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
