<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // hapus data
        // User::truncate();

        $userData = [
            [
                'nip' => 'Admin',
                'nik' => '1234567891011',
                'alamat' => 'Jl. Lamongan-Babat',
                'telepon' => '0812345678910',
                'nama' => 'Admin',
                'email' => 'admin@gmail.com',
                'jk' => 'Perempuan',
                'role' => 'admin',
                'divisi' => 'Admin',
                'bagian' => 'Admin',
                'checked' => '0',
                'password' => bcrypt('admin')
            ],
            [
                'nip' => '710001',
                'nik' => '3578031111030002',
                'alamat' => 'Rungkut Asri Barat 12 No. 4',
                'telepon' => '082139962799',
                'nama' => 'Ardhito Reynata',
                'email' => 'ditoardhito83@gmail.com',
                'jk' => 'Laki-Laki',
                'role' => 'karyawan',
                'divisi' => 'IT Support',
                'bagian' => 'Pengembangan Web',
                'checked' => '0',
                'password' => bcrypt('dito1234')
            ],
            [
                'nip' => '510001',
                'nik' => '3578031212970001',
                'alamat' => 'Jl. Lamongan Utara',
                'telepon' => '0813467891029',
                'nama' => 'Handri Hermawan',
                'email' => 'handrihermawan@gmail.com',
                'jk' => 'Laki-Laki',
                'role' => 'karyawan',
                'divisi' => 'SDM',
                'bagian' => 'HRD',
                'checked' => '0',
                'password' => bcrypt('handri123')
            ],
            [
                'nip' => '670003',
                'nik' => '3578031211956001',
                'alamat' => 'Jl. Unesa Lidah Wetan 1',
                'telepon' => '081345894067',
                'nama' => 'Muhammad Satria Ramadhan',
                'email' => 'satriaramadhan@gmail.com',
                'jk' => 'Laki-Laki',
                'role' => 'karyawan',
                'divisi' => 'IT Support',
                'bagian' => 'Pengembangan Web',
                'checked' => '0',
                'password' => bcrypt('satria123')
            ],
            [
                'nip' => '340201',
                'nik' => '3578034416759101',
                'alamat' => 'Jl. Kali Jagir 1',
                'telepon' => '081425690027',
                'nama' => 'Kandhi Surya Atmaja',
                'email' => 'kandhisuryaatmaja@gmail.com',
                'jk' => 'Laki-Laki',
                'role' => 'karyawan',
                'divisi' => 'IT Support',
                'bagian' => 'Pengembangan Web',
                'checked' => '0',
                'password' => bcrypt('kandhi')
            ],
            [
                'nip' => '647803',
                'nik' => '3578031321266701',
                'alamat' => 'Jl. Pandugo Raya Indah',
                'telepon' => '081215794967',
                'nama' => 'Muhammad Akhtar Ariq',
                'email' => 'akhtarariq@gmail.com',
                'jk' => 'Laki-Laki',
                'role' => 'karyawan',
                'divisi' => 'IT Support',
                'bagian' => 'Pengembangan Web',
                'checked' => '0',
                'password' => bcrypt('ariq11')
            ],
        ];

        foreach ($userData as $key => $val) {
            $qrCodeData = QrCode::size(200)->generate($val['nip']); // Generate QR code based on 'nip'

            $val['qr_code_data'] = $qrCodeData;

            User::create($val);
        }
    }
}

// command : php artisan db:seed DummyUsersSeeder