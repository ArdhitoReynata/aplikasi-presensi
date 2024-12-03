<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-bgcolor">
    <div id="app" class="flex">
        <navbar :user="{{ json_encode(Auth::user()) }}"></navbar>
        <sidebar2></sidebar2>
        <div class="ml-[68px] lg:ml-64 mt-16 w-full font-inter">
            <div class="grid grid-cols-4 gap-5 p-5">
                <div class="grid border col-span-4 md:col-span-2 lg:col-span-1 border-strcolor bg-white rounded-lg p-2">
                    <div class="flex items-center">
                        <img class="flex items-center w-4" src="/images/qr-black.svg" alt="Tes">
                        <p class="font-semibold text-14 ml-1.5">Scan Kode QR</p>
                    </div>
                    <div class="flex mb-1 mt-0.5">
                        <p class="font-reguler text-12 text-justify">Silahkan pindai Kode QR yang tersedia untuk mencatat kehadiran Anda. Pastikan Anda berada di area yang telah ditentukan untuk melakukan proses ini.</p>
                    </div>
                    <div class="flex justify-end">
                        <a href="" class="flex bg-btncolor2 h-full rounded-md w-full text-white font-semibold text-12 justify-center items-center py-1.5">Selengkapnya</a>
                    </div>
                </div>
                <div class="grid border col-span-4 md:col-span-2 lg:col-span-1 border-strcolor bg-white rounded-lg p-2">
                    <div class="flex items-center">
                        <img class="w-4" src="/images/document-black.svg" alt="Tes">
                        <p class="font-semibold text-14 ml-1.5">Perizinan Kerja</p>
                    </div>
                    <div class="flex mb-1 mt-0.5">
                        <p class="font-reguler text-12 text-justify">Silahkan isi perizinan kerja jika Anda berhalangan hadir, baik untuk urusan pribadi, atau sakit. Pastikan Anda mengisi data secara lengkap dan akurat.</p>
                    </div>
                    <div class="flex justify-end">
                        <a href="" class="flex bg-btncolor2 h-full rounded-md w-full text-white font-semibold text-12 justify-center items-center py-1.5">Selengkapnya</a>
                    </div>
                </div>
                <div class="grid border col-span-4 md:col-span-2 lg:col-span-1 border-strcolor bg-white rounded-lg p-2">
                    <div class="flex items-center">
                        <img class="w-4" src="/images/work-black.svg" alt="Tes">
                        <p class="font-semibold text-14 ml-1.5">Pengajuan Cuti</p>
                    </div>
                    <div class="flex mb-1 mt-0.5">
                        <p class="font-reguler text-12 text-justify">Silahkan ajukan cuti tahunan, cuti sakit, atau cuti lainnya sesuai dengan kebijakan perusahaan jika Anda. Pastikan Anda mengajukan cuti dengan waktu yang cukup.</p>
                    </div>
                    <div class="flex justify-end">
                        <a href="" class="flex bg-btncolor2 h-full rounded-md w-full text-white font-semibold text-12 justify-center items-center py-1.5">Selengkapnya</a>
                    </div>
                </div>
                <div class="grid border col-span-4 md:col-span-2 lg:col-span-1 border-strcolor bg-white rounded-lg p-2">
                    <div class="flex items-center">
                        <img class="w-4" src="/images/profile-black.svg" alt="Tes">
                        <p class="font-semibold text-14 ml-1.5">Kelola Data Pribadi Anda</p>
                    </div>
                    <div class="flex mb-1 mt-0.5">
                        <p class="font-reguler text-12 text-justify">Anda dapat memperbarui data pribadi Anda, seperti nama, alamat, nomor telepon, dan data pribadi lainnya. Misalnya, jika Anda pindah tempat tinggal dan lain-lain.</p>
                    </div>
                    <div class="flex justify-end">
                        <a href="" class="flex bg-btncolor2 h-full rounded-md w-full text-white font-semibold text-12 justify-center items-center py-1.5">Selengkapnya</a>
                    </div>
                </div>
                <div class="grid col-span-4 border border-strcolor bg-white w-full rounded-lg">
                    <div class="flex items-center p-3">
                        <img class="w-4" src="/images/history-black.svg" alt="Tes">
                        <p class="font-semibold text-14 ml-1.5">Riwayat Kehadiran <span class="font-medium text-12 text-tbcolor1">Tahun 2024</span></p>
                    </div>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-bgtable text-left text-tbcolor1 text-12 md:text-13 lg:text-14">
                                <tr>
                                    <th class="px-4 py-2">Tanggal</th>
                                    <th class="p-2">Status</th>
                                    <th class="p-2">Keterangan</th>
                                    <th class="p-2 text-center">Lampiran</th>
                                </tr>
                            </thead>
                            <tbody class="font-normal text-12 md:text-13 lg:text-14">
                                @php
                                $datesFirstHalf = [];
                                for ($day = 1; $day <= 10; $day++) {
                                    $datesFirstHalf[]=sprintf('%04d-%02d-%02d', request('year') ?? 2024, request('month') ?? 11, $day);
                                    }
                                    @endphp
                                    @foreach ($datesFirstHalf as $date)
                                    @if (isset($presensiByDate[$date]))
                                    @foreach ($presensiByDate[$date] as $presensi)
                                    <tr class="hover-row hover:bg-bgcolor cursor-pointer" data-keterangan="{{ $presensi->keterangan ?? '-' }}"
                                    data-short-keterangan="{{ \Illuminate\Support\Str::limit($presensi->keterangan ?? '-', 35, '...') }}"
                                    onclick="toggleDescription(this)">
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($date)->format('j F Y') }}</td>
                                    <td class="p-2">{{ $presensi->status ?? '-' }}</td>
                                    <td class="p-2 keterangan-cell max-w-[260px]">{{ \Illuminate\Support\Str::limit($presensi->keterangan ?? '-', 35, '...') }}</td>
                                    <td class="flex p-2 justify-center">
                                        @if(!is_null($presensi['image_path']))
                                        <button class="flex items-center justify-center rounded w-6 h-6 bg-btncolor2 p-0.5 hover:bg-btncolor transition duration-200 ease-in-out">
                                            <a href="{{ asset($presensi['image_path']) }}" target="_blank">
                                                <img src="/images/file-check.svg" alt="">
                                            </a>
                                        </button>
                                        @else
                                        <button class="flex items-center justify-center rounded w-6 h-6 bg-dangercolor p-0.5">
                                            <a>
                                                <img src="/images/file-wrong.svg" alt="">
                                            </a>
                                        </button>
                                        @endif
                                    </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="hover-row hover:bg-bgcolor cursor-pointer">
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($date)->format('j F Y') }}</td>
                                        <td class="p-2">-</td>
                                        <td class="p-2">-</td>
                                        <td class="flex p-2 justify-center">-</td>
                                    </tr>
                                    @endif
                                    @endforeach
                            </tbody>
                        </table>
                        <div class="flex justify-end">
                            <button type="submit" class="flex place-items-end bg-btncolor2 text-white font-semibold text-12 w-fill px-20 py-1.5 rounded-md hover:bg-btncolor transition-all duration-300 transform hover:scale-100 hover:text-white m-2">
                                Selengkapnya
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>