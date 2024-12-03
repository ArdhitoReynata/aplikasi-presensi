<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-bgcolor">
  <section id="app" class="bg-bgcolor flex">
    <navbar :user="{{ json_encode(Auth::user()) }}"></navbar>
    <sidebar></sidebar>
    <div class="ml-[68px] lg:ml-64 mt-16 w-full font-inter">
      <div class="grid p-5 w-full">
        <div class="grid grid-cols-3 border bg-white border-strcolor rounded-md w-full content-center">
          <div class="flex grid-cols col-span-1 md:col-span-1 w-full p-3">
            <div class="flex border border-strcolor items-center rounded-lg w-full h-[28px] md:h-[30px] lg:h-[32px] p-2 mr-2">
              <img class="flex items-center w-[14px] h-[14px] md:w-[15px] md:h-[15px] lg:w-[16px] lg:h-[16px]" src="{{ asset('images/search-grey.svg') }}" alt="search">
              <input type="text" placeholder="Cari"
                class="flex w-full font-inter text-12 md:text-13 lg:text-14 ml-1 outline-none" id="search-input" oninput="searchData(this.value)" />
            </div>
            <div id="status-filter-container" class="relative inline-block">
              <button id="filter-button" onclick="toggleDropdown()" class="flex items-center justify-center w-[28px] h-[28px] md:w-[30px] md:h-[30px] lg:w-[32px] lg:h-[32px] border border-strcolor rounded-lg">
                <img id="filter-icon" src="{{ asset('images/filter-grey.svg') }}" class="w-4 h-4" alt="filter icon">
              </button>
              <div id="status-dropdown" class="hidden absolute mt-2 border border-strcolor rounded-lg bg-white shadow-md w-36 z-10">
                <ul class="text-14">
                  <li><button onclick="selectStatus('')" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Semua Status</button></li>
                  <li><button onclick="selectStatus('Hadir')" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Hadir</button></li>
                  <li><button onclick="selectStatus('Izin')" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Izin</button></li>
                  <li><button onclick="selectStatus('Sakit')" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Sakit</button></li>
                  <li><button onclick="selectStatus('Tidak Hadir')" class="block w-full text-left px-4 py-2 hover:bg-gray-100">Tidak Hadir</button></li>
                </ul>
              </div>
            </div>
          </div>
          <div></div>
          <div class="flex items-center gap-2 col-span-1 md:col-span-1 w-full">
            <div class="w-full mr-3">
              <input type="text" id="date-filter" class="flex border border-strcolor items-center rounded-lg w-full h-[28px] md:h-[30px] lg:h-[32px] pl-2 pr-2 font-inter text-12 md:text-13 lg:text-14" placeholder="Pilih Tanggal" />
            </div>
          </div>
          <div class="overflow-y-auto w-full col-span-3">
            <div class="relative overflow-x-auto">
              <table class="w-full text-left rtl:text-right ">
                <thead class="bg-bgtable text-left text-tbcolor1 text-12 md:text-13 lg:text-14 w-full items-center">
                  <tr>
                    <th scope="col" class="px-4 py-2">NIP</th>
                    <th scope="col" class="p-2">Nama</th>
                    <th scope="col" class="p-2">Status</th>
                    <th scope="col" class="p-2">Waktu</th>
                    <th scope="col" class="p-2">Keterangan</th>
                    <th scope="col" class="p-2">Nomor Telepon</th>
                    <th scope="col" class="p-2">Divisi</th>
                    <th scope="col" class="p-2">Bagian</th>
                    <th scope="col" class="flex p-2 justify-center">Lampiran</th>
                  </tr>
                </thead>
                <tbody class="font-normal text-12 md:text-13 lg:text-14" id="presensi-table-body">
                  @foreach($userPresensi as $presensi)
                  <tr onclick="toggleCheckbox(this)" class="hover-row hover:bg-bgcolor cursor-pointer h-full {{ $presensi['status']  == 'Tidak Hadir' ? 'bg-red-50' : '' }}" data-status="{{ $presensi['status']}}">
                    <td class="px-4 py-2">{{ $presensi['user']->nip }}</td>
                    <td class="p-2">{{ $presensi['user']->nama }}</td>
                    <td class="p-2 {{ $presensi['status'] == 'Tidak Hadir' ? 'text-dangercolor  font-semibold' : '' }}">{{ $presensi['status'] }}</td>
                    <td class="p-2 formatted-date" data-timestamp="{{ $presensi['timestamp'] ? \Carbon\Carbon::parse($presensi['timestamp'])->toIso8601String() : '' }}">
                      {{ $presensi['timestamp'] ? \Carbon\Carbon::parse($presensi['timestamp'])->format('H.i.s') : '-' }}
                    </td>
                    <td class="p-2">
                      @if(!is_null($presensi['keterangan']))
                      {{ $presensi['keterangan'] }}
                      @else
                      @php
                      $presensiTime = $presensi['timestamp'] ? \Carbon\Carbon::parse($presensi['timestamp']) : null;
                      $standardTime = \Carbon\Carbon::parse('08:00:00');
                      $lateTime = null;

                      // Hanya hitung terlambat jika ada timestamp
                      if ($presensiTime) {
                      if ($presensiTime->isToday() && $presensiTime->greaterThan($standardTime)) {
                      // Hitung perbedaan jika presensi hari ini lebih dari jam 8 pagi
                      $diff = $presensiTime->diff($standardTime);
                      $lateTime = $diff->format('%h Jam %i Menit');
                      } elseif ($presensiTime->isPast()) {
                      // Hitung perbedaan jika presensi di hari sebelumnya
                      $standardTimeOnPresensiDate = \Carbon\Carbon::parse($presensiTime->toDateString() . ' 08:00:00');
                      if ($presensiTime->greaterThan($standardTimeOnPresensiDate)) {
                      $diff = $presensiTime->diff($standardTimeOnPresensiDate);
                      $lateTime = $diff->format('%h Jam %i Menit');
                      }
                      }
                      }
                      @endphp

                      {{-- Tampilkan informasi jika terlambat --}}
                      @if($lateTime)
                      Terlambat {{ $lateTime }}
                      @else
                      {{-- Tampilkan waktu presensi jika tidak ada keterlambatan --}}
                      {{ $presensi['timestamp'] ? \Carbon\Carbon::parse($presensi['timestamp'])->format('H:i:s') : '-' }}
                      @endif
                      @endif
                    </td>
                    <td class="p-2">{{ $presensi['user']->telepon }}</td>
                    <td class="p-2">{{ $presensi['user']->divisi }}</td>
                    <td class="p-2">{{ $presensi['user']->bagian }}</td>
                    <td class="p-2 h-full place-items-center">
                      @if(!is_null($presensi['keterangan']))
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
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/l10n/id.js"></script>
  <script>
    // Fungsi untuk toggle dropdown filter status
    function toggleDropdown() {
      const dropdown = document.getElementById('status-dropdown');
      dropdown.classList.toggle('hidden');
    }

    // Fungsi untuk memilih status
    function selectStatus(status) {
      filterByStatus(status);

      // Update button background and icon based on filter state
      const filterButton = document.getElementById('filter-button');
      const filterIcon = document.getElementById('filter-icon');
      if (status === '') {
        filterButton.classList.remove('bg-btncolor');
        filterIcon.src = "{{ asset('images/filter-grey.svg') }}"; // Default icon
      } else {
        filterButton.classList.add('bg-btncolor');
        filterIcon.src = "{{ asset('images/filter-white.svg') }}"; // Active icon
      }
      // Sembunyikan dropdown setelah memilih item
      toggleDropdown();
    }

    // Fungsi untuk menyaring berdasarkan status
    function filterByStatus(selectedStatus) {
      const rows = document.querySelectorAll('#presensi-table-body tr');

      rows.forEach(row => {
        const status = row.getAttribute('data-status');

        if (selectedStatus === "" || status === selectedStatus) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }

    document.addEventListener('DOMContentLoaded', function() {
      // Cek apakah ada tanggal yang disimpan di session storage
      const savedDate = sessionStorage.getItem('selectedDate');
      const inputElement = document.getElementById("date-filter");

      if (savedDate) {
        inputElement.value = savedDate; // Tampilkan tanggal yang disimpan
        inputElement.style.color = "black"; // Ubah warna font menjadi hitam
      }

      flatpickr("#date-filter", {
        locale: "id", // Menggunakan locale Indonesia
        dateFormat: "Y-m-d", // Format tanggal untuk nilai input
        altInput: true, // Menampilkan format alternatif
        altFormat: "l, d F Y", // Format alternatif untuk menampilkan tanggal
        onChange: function(selectedDates, dateStr, instance) {
          // Simpan tanggal yang dipilih di session storage
          sessionStorage.setItem('selectedDate', dateStr);
          inputElement.value = dateStr; // Mengatur nilai input
          inputElement.style.color = "black"; // Mengubah warna font menjadi hitam
          filterByDate(dateStr);
        }
      });
    });

    function filterByDate(selectedDate) {
      const currentUrl = new URL(window.location.href);
      currentUrl.searchParams.set('date', selectedDate);
      window.location.href = currentUrl.toString();
    }

    function searchData(query) {
      // Fungsi untuk pencarian dalam tabel
      const searchInput = document.getElementById('search-input');
      if (searchInput) {
        searchInput.addEventListener('input', function() {
          const searchTerm = searchInput.value.toLowerCase();
          const rows = document.querySelectorAll('#presensi-table-body tr');

          rows.forEach(row => {
            const columns = row.getElementsByTagName('td');
            const rowText = Array.from(columns)
              .map(column => column.textContent.toLowerCase())
              .join(" ");

            row.style.display = rowText.includes(searchTerm) ? '' : 'none';
          });
        });
      }
    }
  </script>
</body>

</html>