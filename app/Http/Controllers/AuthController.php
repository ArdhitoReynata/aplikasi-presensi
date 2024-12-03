<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAuthVerifyRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('layout.masuk');
    }

    public function verify(UserAuthVerifyRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (Auth::guard('admin')->attempt(['nip' => $data['nip'], 'password' => $data['password'], 'role' => 'admin'])) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/home');
        } else if (Auth::guard('karyawan')->attempt(['nip' => $data['nip'], 'password' => $data['password'], 'role' => 'karyawan'])) {
            $request->session()->regenerate();
            return redirect()->intended('/karyawan/home');
        } else {
            return back()->withErrors(['login_error' => 'NIP atau Password salah. Silakan coba lagi!']);
        }
    }

    public function logout(): RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else if (Auth::guard('karyawan')->check()) {
            Auth::guard('karyawan')->logout();
        }
        return redirect(route('login'));
    }

    public function currentUser()
    {
        return response()->json([
            'nama' => Auth::user()->nama,
        ]);
    }
}
