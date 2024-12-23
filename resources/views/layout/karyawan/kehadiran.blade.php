<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-bgcolor shadow">
    <section id="app" class="bg-bgcolor flex">
        <navbar :user="{{ json_encode(Auth::user()) }}"></navbar>
        <sidebar2></sidebar2>
        <div class="ml-[68px] lg:ml-64 mt-16 w-full font-inter p-5">
            <div class="bg-white border border-strcolor rounded-md w-full content-center">
                <div class="grid grid-cols-2 col-span-1 p-3 gap-3">
                    <!-- Dropdown Pilih Bulan -->
                    <div class="flex items-center gap-2 w-full">
                        <div class="w-full">
                            <select id="month-filter" class="flex border border-strcolor items-center rounded-lg w-full h-[28px] md:h-[30px] lg:h-[32px] pl-2 pr-2 font-inter text-12 md:text-13 lg:text-14" onchange="filterByMonthAndYear()">
                                @php
                                $currentMonth = request('month') ?? date('m');
                                @endphp
                                <option value="01" {{ $currentMonth == '01' ? 'selected' : '' }}>Januari</option>
                                <option value="02" {{ $currentMonth == '02' ? 'selected' : '' }}>Februari</option>
                                <option value="03" {{ $currentMonth == '03' ? 'selected' : '' }}>Maret</option>
                                <option value="04" {{ $currentMonth == '04' ? 'selected' : '' }}>April</option>
                                <option value="05" {{ $currentMonth == '05' ? 'selected' : '' }}>Mei</option>
                                <option value="06" {{ $currentMonth == '06' ? 'selected' : '' }}>Juni</option>
                                <option value="07" {{ $currentMonth == '07' ? 'selected' : '' }}>Juli</option>
                                <option value="08" {{ $currentMonth == '08' ? 'selected' : '' }}>Agustus</option>
                                <option value="09" {{ $currentMonth == '09' ? 'selected' : '' }}>September</option>
                                <option value="10" {{ $currentMonth == '10' ? 'selected' : '' }}>Oktober</option>
                                <option value="11" {{ $currentMonth == '11' ? 'selected' : '' }}>November</option>
                                <option value="12" {{ $currentMonth == '12' ? 'selected' : '' }}>Desember</option>
                            </select>
                        </div>
                    </div>
                    <!-- Dropdown Pilih Tahun -->
                    <div class="flex items-center gap-2 w-full">
                        <div class="w-full">
                            <select id="year-filter" class="flex border border-strcolor items-center rounded-lg w-full h-[28px] md:h-[30px] lg:h-[32px] pl-2 pr-2 font-inter text-12 md:text-13 lg:text-14" onchange="filterByMonthAndYear()">
                                @php
                                $currentYear = request('year') ?? date('Y');
                                @endphp
                                <option value="{{ date('Y') }}" {{ request('year') == date('Y') || date('Y') == date('Y') ? 'selected' : '' }}>{{ date('Y') }}</option>
                                <option value="{{ date('Y', strtotime('-1 year')) }}" {{ request('year') == date('Y', strtotime('-1 year')) ? 'selected' : '' }}>{{ date('Y', strtotime('-1 year')) }}</option>
                                <!-- Tambahkan tahun lain jika diperlukan -->
                            </select>
                        </div>
                    </div>
                </div>


                <!-- Tabel Gabungan (1-31 Bulan) -->
                <div class="overflow-y-auto w-full">
                    <table class="w-full text-left">
                        <thead class="bg-bgtable text-left text-tbcolor1 text-12 md:text-13 lg:text-14">
                            <tr>
                                <th class="pl-4 py-2">Tanggal</th>
                                <th class="p-2">Status</th>
                                <th class="p-2">Keterangan</th>
                                <th class="p-2 text-center">Lampiran</th>
                            </tr>
                        </thead>
                        <tbody class="font-normal text-12 md:text-13 lg:text-14">
                            @php
                            $dates = [];
                            for ($day = 1; $day <= 31; $day++) {
                                $dates[]=sprintf('%04d-%02d-%02d', request('year') ?? now()->format('Y'), request('month') ?? now()->format('m'), $day);
                                }
                                @endphp
                                @foreach ($dates as $date)
                                @if (isset($presensiByDate[$date]))
                                @foreach ($presensiByDate[$date] as $presensi)
                                @php
                                $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeek; // 0: Minggu, 6: Sabtu
                                $isWeekend = $dayOfWeek === 0 || $dayOfWeek === 6;
                                @endphp
                                <tr class="hover-row hover:bg-bgcolor cursor-pointer {{ $isWeekend ? 'bg-dangercolortransparent text-tbcolor font-medium' : '' }}" data-keterangan="{{ $presensi->keterangan ?? '-' }}"
                                    data-short-keterangan="{{ \Illuminate\Support\Str::limit($presensi->keterangan ?? '-', 90, '...') }}"
                                    onclick="toggleDescription(this)">
                                    <td class="pl-4 py-2">{{ \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                    <td class="p-2">{{ $presensi->status ?? '-' }}</td>
                                    <td class="p-2 keterangan-cell max-w-[400px]">{{ \Illuminate\Support\Str::limit($presensi->keterangan ?? '-', 90, '...') }}</td>
                                    <td class="flex p-2 justify-center">
                                        @if(!is_null($presensi['image_path']))
                                        <button class="flex items-center justify-center rounded w-6 h-6 bg-btncolor2 p-0.5 hover:bg-btncolor transition duration-200 ease-in-out">
                                            <a href="{{ asset($presensi['image_path']) }}" target="_blank">
                                                <img src="/images/file-check.svg" alt="">
                                            </a>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                @php
                                $dayOfWeek = \Carbon\Carbon::parse($date)->dayOfWeek; // 0: Minggu, 6: Sabtu
                                $isWeekend = $dayOfWeek === 0 || $dayOfWeek === 6;
                                @endphp
                                <tr class="hover-row hover:bg-bgcolor cursor-pointer {{ $isWeekend ? 'bg-dangercolortransparent text-tbcolor font-medium' : '' }}">
                                    <td class="pl-4 py-2">{{ \Carbon\Carbon::parse($date)->locale('id')->translatedFormat('l, d F Y') }}</td>
                                    <td class="p-2">-</td>
                                    <td class="p-2 max-w-[400px]">-</td>
                                    <td class="flex p-2 justify-center"></td>
                                </tr>
                                @endif
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </section>

    <script>
        function filterByMonthAndYear() {
            const month = document.getElementById('month-filter').value;
            const year = document.getElementById('year-filter').value;
            const url = new URL(window.location.href);
            url.searchParams.set('month', month);
            url.searchParams.set('year', year);
            window.location.href = url.toString();
        }

        function toggleDescription(row) {
            // Ambil elemen kolom keterangan
            const keteranganCell = row.querySelector('.keterangan-cell');

            // Ambil data keterangan lengkap dan pendek
            const keteranganLengkap = row.getAttribute('data-keterangan');
            const keteranganPendek = row.getAttribute('data-short-keterangan');

            // Cek teks saat ini, lalu toggle
            if (keteranganCell.textContent === keteranganPendek) {
                keteranganCell.textContent = keteranganLengkap; // Tampilkan deskripsi lengkap
            } else {
                keteranganCell.textContent = keteranganPendek; // Tampilkan deskripsi pendek
            }
        }
    </script>
</body>

</html>