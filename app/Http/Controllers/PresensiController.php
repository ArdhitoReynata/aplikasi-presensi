<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function store(Request $request)
    {
        // Ambil data QR Code yang dikirimkan
        $qrCodeData = $request->input('qr_code_data');

        // Validasi data yang diterima
        $request->validate([
            'qr_code_data' => 'required|string',
            'status' => 'required|string',
        ]);

        // Mencari user berdasarkan qr_code_data yang berisi NIP
        $user = User::where('nip', $qrCodeData)->first();

        // Jika user tidak ditemukan
        if (!$user) {
            return response()->json(['message' => 'User dengan NIP tersebut tidak ditemukan'], 404);
        }

        // Cek apakah user sudah presensi hari ini
        $existingPresensi = Presensi::where('qr_code_data', $qrCodeData)
            ->whereDate('created_at', now()->toDateString()) // Cek berdasarkan hari
            ->first();

        if ($existingPresensi) {
            // Mengirimkan nama user yang ditemukan dari QR Code
            return response()->json([
                'message' => 'anda sudah melakukan presensi hari ini',
                'nama' => $user->nama // Ganti dengan nama yang ditemukan di QR Code
            ], 200);
        }

        $filePath = null;

        // Simpan file jika ada
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName);
            $filePath = Storage::url($filePath); // Menghasilkan URL untuk frontend
        }

        // Simpan presensi baru
        $presensi = new Presensi();
        $presensi->user_id = $user->id;
        $presensi->timestamp = $request->input('tanggal_perizinan') ?? now()->toDateTimeString(); // Gunakan nilai dari request jika ada
        $presensi->status = $request->status;
        $presensi->qr_code_data = $qrCodeData;
        $presensi->keterangan = $request->input('keterangan');
        $presensi->image_path = $filePath;
        $presensi->save();

        // Mengirimkan pesan sukses beserta nama user
        return response()->json([
            'message' => 'data presensi berhasil disimpan',
            'nama' => $user->nama // Ganti dengan nama yang ditemukan di QR Code
        ], 200);
    }

    public function index(Request $request)
    {
        $selectedDate = $request->input('date', Carbon::today()->format('Y-m-d'));

        $presensiData = Presensi::with('user')
            ->whereDate('timestamp', $selectedDate)
            ->get();

        $presensiMap = $presensiData->keyBy('user_id');

        $userPresensi = User::all()->map(function ($user) use ($presensiMap) {
            $presensi = $presensiMap->get($user->id);

            return [
                'user' => $user,
                'status' => $presensi ? $presensi->status : 'Tidak Hadir',
                'timestamp' => $presensi ? $presensi->timestamp : null,
                'keterangan' => $presensi ? $presensi->keterangan : null,
                'image_path' => $presensi ? $presensi->image_path : null,
            ];
        });

        $uniqueDates = Presensi::selectRaw('DATE(timestamp) as date')
            ->distinct()
            ->pluck('date')
            ->toArray();

        return view('layout.admin.laporan', [
            'userPresensi' => $userPresensi,
            'uniqueDates' => $uniqueDates,
            'selectedDate' => $selectedDate,
        ]);
    }
    public function getTidakHadir()
    {
        $data = Presensi::where('status', 'Tidak Hadir')->get();

        // Jika data kosong, kembalikan array kosong
        return response()->json($data);
    }

    public function getPresensiHariIni(Request $request)
    {
        // Default date jika tidak ada tanggal yang dipilih
        $selectedDate = $request->input('date', Carbon::today()->format('Y-m-d'));

        // Hitung jumlah total pengguna
        $totalUsers = User::count();

        // Hitung jumlah presensi berdasarkan status pada tanggal tertentu
        $hadirCount = Presensi::whereDate('timestamp', $selectedDate)
            ->where('status', 'Hadir')
            ->count();

        $izinSakitCount = Presensi::whereDate('timestamp', $selectedDate)
            ->whereIn('status', ['Izin', 'Sakit'])
            ->count();

        // Hitung jumlah pengguna yang Tidak Hadir
        $tidakHadirCount = $totalUsers - ($hadirCount + $izinSakitCount);

        // Format data sesuai dengan kebutuhan frontend
        $presensiData = [
            ['status' => 'Hadir', 'count' => $hadirCount],
            ['status' => 'Izin/Sakit', 'count' => $izinSakitCount],
            ['status' => 'Tidak Hadir', 'count' => $tidakHadirCount],
        ];

        return response()->json($presensiData);
    }

    public function getPresensiMingguIni()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $totalUsers = User::count();

        $hadirCount = Presensi::whereBetween('timestamp', [$startOfWeek, $endOfWeek])
            ->where('status', 'Hadir')
            ->count();

        $izinSakitCount = Presensi::whereBetween('timestamp', [$startOfWeek, $endOfWeek])
            ->whereIn('status', ['Izin', 'Sakit'])
            ->count();

        $totalUsers2 = $totalUsers * 7;

        $tidakHadirCount = $totalUsers2 - ($hadirCount + $izinSakitCount);

        $presensiData = [
            ['status' => 'Hadir', 'count' => $hadirCount],
            ['status' => 'Izin/Sakit', 'count' => $izinSakitCount],
            ['status' => 'Tidak Hadir', 'count' => $tidakHadirCount],
        ];

        return response()->json($presensiData);
    }
    public function getPresensiBulanIni()
    {
        // Tentukan tanggal awal dan akhir bulan ini
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Hitung jumlah total pengguna
        $totalUsers = User::count();

        // Hitung jumlah presensi berdasarkan status dalam bulan ini
        $hadirCount = Presensi::whereBetween('timestamp', [$startOfMonth, $endOfMonth])
            ->where('status', 'Hadir')
            ->count();

        $izinSakitCount = Presensi::whereBetween('timestamp', [$startOfMonth, $endOfMonth])
            ->whereIn('status', ['Izin', 'Sakit'])
            ->count();

        // Hitung total kemungkinan kehadiran dalam bulan ini
        $totalDaysInMonth = Carbon::now()->daysInMonth;
        $totalUsersInMonth = $totalUsers * $totalDaysInMonth;

        // Hitung jumlah pengguna yang Tidak Hadir
        $tidakHadirCount = $totalUsersInMonth - ($hadirCount + $izinSakitCount);

        // Format data untuk frontend
        $presensiData = [
            ['status' => 'Hadir', 'count' => $hadirCount],
            ['status' => 'Izin/Sakit', 'count' => $izinSakitCount],
            ['status' => 'Tidak Hadir', 'count' => $tidakHadirCount],
        ];

        return response()->json($presensiData);
    }
    public function getPresensiTahun($year)
    {
        $presensiData = Presensi::selectRaw('MONTH(timestamp) as month, 
                                        SUM(CASE WHEN status = "Hadir" THEN 1 ELSE 0 END) as hadir,
                                        SUM(CASE WHEN status IN ("Izin", "Sakit") THEN 1 ELSE 0 END) as izinAbsen,
                                        COUNT(*) - SUM(CASE WHEN status IN ("Hadir", "Izin", "Sakit") THEN 1 ELSE 0 END) as tidakHadir')
            ->whereYear('timestamp', $year)
            ->groupByRaw('MONTH(timestamp)')
            ->orderByRaw('MONTH(timestamp)')
            ->get();

        return response()->json($presensiData);
    }
}
