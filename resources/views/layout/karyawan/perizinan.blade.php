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
        <div class="ml-[68px] lg:ml-64 mt-16 w-full">
            <div class="grid grid-cols-5 p-5 gap-5">
                <perizinan :user="{{ json_encode(Auth::user()) }}" class="grid col-span-3 content-start"></perizinan>
                <div class="grid col-span-2 font-inter font-medium text-10 md:text-11 lg:text-12">
                    <div class="h-full">
                        <div class="bg-white border border-strcolor rounded-md p-5">
                            <h1 class="flex items-center font-semibold text-12 md:text-13 lg:text-14">Kehadiran Bulan ini</h1>
                            <p class="font-inter font-normal text-19 md:text-20 lg:text-21 mt-2">
                                {{ $totalHari }}
                                <span> Hari</span>
                            </p>
                            <div class="place-content-center mt-1">
                                <div class="w-full bg-gray-200 rounded-md dark:bg-gray-700 h-4 flex overflow-hidden font-normal text-7 md:text-8 lg:text-9">
                                    <div
                                        class="relative group w-[<?php echo round($hadirPersen, 2); ?>%] bg-btncolor text-white text-center leading-none rounded-l-md flex items-center justify-center transition-all duration-300 ease-in-out hover:px-8 hover:cursor-pointer"
                                        style="width: <?php echo round($hadirPersen, 2); ?>%;"
                                        data-percent="{{ round($hadirPersen, 2) }}%">
                                        @if(round($hadirPersen, 2) >= max(round($hadirPersen, 2), round($izinPersen, 2), round($tidakHadirPersen, 2)))
                                        {{ round($hadirPersen, 2) }}%
                                        @endif
                                        <span class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            {{ round($hadirPersen, 2) }}%
                                        </span>
                                    </div>
                                    <div
                                        class="relative group w-[<?php echo round($izinPersen, 2); ?>%] bg-warningcolor text-white text-center leading-none flex items-center justify-center transition-all duration-300 ease-in-out hover:px-8 hover:cursor-pointer"
                                        style="width: <?php echo round($izinPersen, 2); ?>%;"
                                        data-percent="{{ round($izinPersen, 2) }}%">
                                        @if(round($izinPersen, 2) >= max(round($hadirPersen, 2), round($izinPersen, 2), round($tidakHadirPersen, 2)))
                                        {{ round($izinPersen, 2) }}%
                                        @endif
                                        <span class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            {{ round($izinPersen, 2) }}%
                                        </span>
                                    </div>
                                    <div
                                        class="relative group w-[<?php echo round($tidakHadirPersen, 2); ?>%] bg-dangercolor text-white text-center leading-none rounded-r-md flex items-center justify-center transition-all duration-300 ease-in-out hover:px-8 hover:cursor-pointer"
                                        style="width: <?php echo round($tidakHadirPersen, 2); ?>%;"
                                        data-percent="{{ round($tidakHadirPersen, 2) }}%">
                                        @if(round($tidakHadirPersen, 2) >= max(round($hadirPersen, 2), round($izinPersen, 2), round($tidakHadirPersen, 2)))
                                        {{ round($tidakHadirPersen, 2) }}%
                                        @endif
                                        <span class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                            {{ round($tidakHadirPersen, 2) }}%
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-rows-3 text-13 mt-2">
                                <div class="flex justify-between border-b py-3">
                                    <div class="flex items-center">
                                        <div class="rounded-sm w-3 h-3 bg-btncolor mr-2"></div>
                                        <p>Hadir</p>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center h-6 w-10 bg-btncolortransparent rounded-md border border-btncolor text-12">
                                            <p class="text-btncolor">{{ $hadir }} x</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between border-b">
                                    <div class="flex items-center justify-start">
                                        <div class="rounded-sm w-3 h-3 bg-warningcolor mr-2"></div>
                                        <p>Izin / Sakit</p>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center h-6 w-10 bg-warningcolortransparent rounded-md border border-warningcolor2 text-12">
                                            <p class="text-warningcolor2">{{ $izinSakit->count() }} x</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex justify-between">
                                    <div class="flex items-center justify-start">
                                        <div class="rounded-sm w-3 h-3 bg-dangercolor mr-2"></div>
                                        <p>Tidak Hadir</p>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="flex items-center justify-center h-6 w-10 bg-dangercolortransparent rounded-md border border-dangercolor2 text-12">
                                            <p class="text-dangercolor2">{{ $tidakHadir }} x</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="w-full h-8 bg-btncolor rounded-md mt-2">
                                <a class="flex items-center justify-center w-full h-full text-white" href="kehadiran">Selengkapnya</a>
                            </button>
                        </div>
                        <div class="mt-5 bg-white border border-strcolor rounded-md">
                            <div>
                                <h1 class="font-semibold text-12 md:text-13 lg:text-14 p-5">Riwayat Perizinan Bulan ini</h1>
                                <table class="w-full text-left rtl:text-right">
                                    <tbody>
                                        @foreach ($izinSakit as $item)
                                        <tr>
                                            <div class="flex justify-between border-t px-5 py-3">
                                                <div>
                                                    <div class="flex">
                                                        <div class="flex items-center justify-center w-10 bg-warningcolor border rounded-sm">
                                                            <p class="text-11">
                                                                @if($item->status == 'Izin')
                                                                Izin
                                                                @elseif($item->status == 'Sakit')
                                                                Sakit
                                                                @else
                                                                Tidak Diketahui
                                                                @endif
                                                            </p>
                                                        </div>
                                                        <p id="live-time-{{ $item->id }}" class="ml-1 text-btncolor4 font-medium text-12" data-timestamp="{{ $item->timestamp }}">
                                                            {{ \Carbon\Carbon::parse($item->timestamp)->locale('id')->diffForHumans() }}
                                                        </p>
                                                    </div>

                                                    <div class="flex mt-2">
                                                        <div class="">
                                                            <div class="flex items-center">
                                                                <img class="w-[12px] h-[12px] mr-1" src="/images/calendar-black.svg" alt="">
                                                                <p>{{ \Carbon\Carbon::parse($item->timestamp)->locale('id')->translatedFormat('l, d F Y') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="px-2">
                                                            <div class="flex items-center">
                                                                <img class="w-[12px] h-[12px] mr-1" src="/images/clock-black.svg" alt="">
                                                                <p>{{ \Carbon\Carbon::parse($item->timestamp)->format('H:i') }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    // Fungsi untuk format waktu dalam bentuk "diffForHumans" menggunakan JavaScript
    function updateLiveTime() {
        // Ambil semua elemen dengan id yang diinginkan (ID elemen yang unik untuk setiap item)
        const times = document.querySelectorAll('[id^="live-time-"]');

        // Untuk setiap elemen waktu, perbarui tampilannya
        times.forEach(time => {
            const timestamp = time.getAttribute('data-timestamp'); // Mengambil timestamp yang disimpan dalam atribut data
            if (timestamp) {
                const currentTime = new Date();
                const timeDiff = Math.floor((currentTime - new Date(timestamp)) / 1000); // Selisih waktu dalam detik

                let timeString = '';
                // Hitung waktu yang lalu (dalam detik, menit, jam, dsb)
                if (timeDiff < 60) {
                    timeString = `${timeDiff} detik yang lalu`;
                } else if (timeDiff < 3600) {
                    timeString = `${Math.floor(timeDiff / 60)} menit yang lalu`;
                } else if (timeDiff < 86400) {
                    timeString = `${Math.floor(timeDiff / 3600)} jam yang lalu`;
                } else if (timeDiff < 2592000) {
                    timeString = `${Math.floor(timeDiff / 86400)} hari yang lalu`;
                } else {
                    timeString = `${Math.floor(timeDiff / 2592000)} bulan yang lalu`;
                }

                // Perbarui teks di elemen dengan id yang sesuai
                time.textContent = timeString;
            }
        });
    }

    // Update waktu setiap detik
    setInterval(updateLiveTime, 1000);

    // Panggil fungsi untuk pertama kali agar waktu tampil saat halaman pertama kali dimuat
    updateLiveTime();
</script>

</html>