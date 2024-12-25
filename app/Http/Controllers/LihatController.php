<?php

namespace App\Http\Controllers;

use App\Models\User;

class LihatController extends Controller
{
  public function show($nip)
  {
    $employee = User::where('nip', $nip)->firstOrFail();
    return view('layout.admin.karyawan.datakaryawan', compact('employee'));
  }
}
