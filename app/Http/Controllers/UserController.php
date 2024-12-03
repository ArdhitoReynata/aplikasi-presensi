<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    public function currentUser(): JsonResponse
    {
        $user = Auth::user(); // Ambil pengguna yang sedang login

        if ($user) {
            // Kembalikan nama dan nip pengguna
            return response()->json([
                'nama' => $user->nama,
                'nip' => $user->nip,
            ]);
        }

        // Jika tidak ada pengguna yang login
        return response()->json([
            'nama' => '',
            'nip' => '',
        ]);
    }
    public function updateProfileImage(Request $request)
    {
        // Validasi file
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user(); // Ambil user yang sedang login

        // Jika ada file yang diunggah
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/profile_images', $imageName);

            // Update nama file gambar di database
            $user->profile_image = $path;
            $user->save();

            // Mengembalikan response JSON
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required', // Password lama harus diisi
            'new_password' => 'required|min:8|confirmed', // Password baru harus ada, minimal 8 karakter, dan terkonfirmasi
        ]);

        // Ambil user yang sedang login
        $user = Auth::user();

        // Verifikasi password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai']);
        }

        // Update password baru
        $user->password = Hash::make($request->new_password); // Encrypt password baru
        $user->save();

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Password berhasil diperbarui');
    }
}
