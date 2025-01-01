<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PresensiController2 extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('month', now()->format('Y-m')); // Default bulan ini
        $startOfMonth = Carbon::parse($selectedMonth)->startOfMonth();
        $endOfMonth = Carbon::parse($selectedMonth)->endOfMonth();

        $userId = Auth::id();

        // Ambil data presensi untuk user yang login
        $userPresensi = Presensi::with('user')
            ->where('user_id', $userId)
            ->get();

        // Ambil presensi berdasarkan bulan untuk user yang login
        $presensiPerBulan = User::with(['presensi' => function ($query) use ($startOfMonth, $endOfMonth) {
            $query->whereBetween('timestamp', [$startOfMonth, $endOfMonth]);
        }])
            ->where('id', $userId) // Filter hanya untuk pengguna yang login
            ->get();

        return view('layout.karyawan.kehadiran', [
            'userPresensi' => $userPresensi,
            'presensiPerBulan' => $presensiPerBulan,
            'selectedMonth' => $selectedMonth,
        ]);
    }

    public function showLaporan(Request $request)
    {
        $month = $request->input('month', date('m')); // Default to current month if not selected
        $year = $request->input('year', date('Y'));   // Default to current year if not selected

        $userId = Auth::id();
        // Menentukan tanggal untuk dua bagian bulan (1-15 dan 16-30)
        $datesFirstHalf = [];
        for ($day = 1; $day <= 15; $day++) {
            $datesFirstHalf[] = sprintf('%04d-%02d-%02d', $year, $month, $day);
        }

        $datesSecondHalf = [];
        for ($day = 16; $day <= 30; $day++) {
            $datesSecondHalf[] = sprintf('%04d-%02d-%02d', $year, $month, $day);
        }

        $presensiByDate = Presensi::where('user_id', $userId) // Filter berdasarkan user login
            ->whereYear('timestamp', $year)
            ->whereMonth('timestamp', $month)
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->timestamp)->format('Y-m-d'); // Group berdasarkan tanggal
            });

        return view('layout.karyawan.kehadiran', compact('presensiByDate', 'month', 'year'));
    }
}


