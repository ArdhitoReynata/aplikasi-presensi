<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karyawan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-bgcolor">
    <section id="app" class="bg-bgcolor flex">
        <navbar :user="{{ json_encode(Auth::user()) }}"></navbar>
        <sidebar></sidebar>
        <div class="ml-[68px] lg:ml-64 mt-16 w-full font-inter">
            <div class="grid p-5 w-full">
                <div class="grid grid-cols-3 border bg-white border-strcolor rounded-md w-full content-center">
                    <div class="flex grid-cols col-span-2 md:col-span-1 w-full p-3">
                        <div class="flex border border-strcolor items-center rounded-lg w-full h-[28px] md:h-[30px] lg:h-[32px] p-2 mr-2">
                            <img class="flex items-center w-[14px] h-[14px] md:w-[15px] md:h-[15px] lg:w-[16px] lg:h-[16px]" src="{{ asset('images/search-grey.svg') }}" alt="search">
                            <input type="text" placeholder="Cari"
                                class="flex w-full font-inter text-12 md:text-13 lg:text-14 ml-1 outline-none" id="search-input" oninput="searchData(this.value)" />
                        </div>
                        <div class="flex flex-shrink-0 w-[28px] h-[28px] md:w-[30px] md:h-[30px] lg:w-[32px] lg:h-[32px] text-center items-center justify-center border border-strcolor rounded-lg">
                            <button>
                                <img class="w-4 h-4" src="{{ asset('images/filter-grey.svg') }}" alt="filter">
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 col-span-1 md:col-span-2 p-3">
                        <button class="flex justify-center items-center w-[28px] h-[28px] md:w-[30px] md:h-[30px] lg:w-[32px] lg:h-[32px] p-1 rounded-lg bg-dangercolor transition ease-in-out delay-150hover:-translate-y-1 hover:scale-105 hover:bg-dangercolor2 duration-300" onclick="deleteSelected()">
                            <img class="flex items-center justify-center w-5 h-5" src="{{ asset('images/trash-white.svg') }}" alt="images">
                        </button>
                        <button class="flex justify-center items-center w-[28px] h-[28px] md:w-[30px] md:h-[30px] lg:w-[32px] lg:h-[32px] p-1 rounded-lg bg-btncolor2 transition ease-in-out delay-150hover:-translate-y-1 hover:scale-105 hover:bg-btncolor duration-300" onclick="window.location.href='/admin/karyawan/tambahkaryawan'">
                            <img class="flex items-center justify-center w-full h-full" src="{{ asset('images/plus-white.svg') }}" alt="images">
                        </button>
                    </div>
                    <div class="overflow-y-auto w-full col-span-3">
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-left rtl:text-right">
                                <thead class="bg-bgtable text-left text-tbcolor1 text-12 md:text-13 lg:text-14 w-full items-center">
                                    <tr>
                                        <th scope="col">
                                            <label class="hidden pl-2 justify-center items-center cursor-pointer">
                                                <input type="checkbox" class="peer h-3.5 w-3.5 bg-white cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-tbcolor1 checked:bg-btncolor2 checked:border-btncolor2" />
                                                <span class="flex text-white opacity-0 peer-checked:opacity-100 transform -translate-x-3 -translate-y-0 pointer-events-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="0.5">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            </label>
                                        </th>
                                        <th scope="col" class="p-2">
                                            NIP
                                        </th>
                                        <th scope="col" class="p-2">
                                            NIK
                                        </th>
                                        <th scope="col" class="p-2">
                                            Nama
                                        </th>
                                        <th scope="col" class="p-2">
                                            Alamat
                                        </th>
                                        <th scope="col" class="p-2">
                                            Nomor Telepon
                                        </th>
                                        <th scope="col" class="p-2">
                                            Jenis Kelamin
                                        </th>
                                        <th scope="col" class="p-2">
                                            Divisi
                                        </th>
                                        <th scope="col" class="p-2">
                                            Bagian
                                        </th>
                                        <th scope="col" class="flex p-2 justify-center">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="font-normal text-12 md:text-13 lg:text-14" id="user-table-body">
                                    @foreach($users as $user)
                                    <tr onclick="toggleCheckbox(this)" class="hover-row hover:bg-bgcolor cursor-pointer h-full">
                                        <td>
                                            <label class="flex pl-2 justify-center items-center cursor-pointer">
                                                <input type="checkbox" class="peer h-3.5 w-3.5 bg-white cursor-pointer transition-all appearance-none rounded shadow hover:shadow-md border border-tbcolor1 checked:bg-btncolor2 checked:border-btncolor2" id="check" onclick="event.stopPropagation()" />
                                                <span class="flex text-white opacity-0 peer-checked:opacity-100 transform -translate-x-3 -translate-y-0 pointer-events-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-2.5 w-2.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="0.5">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            </label>
                                        </td>
                                        <td class="p-2">
                                            {{ $user->nip }}
                                        </td>
                                        <td class="p-2">
                                            {{ $user->nik }}
                                        </td>
                                        <td class="p-2">
                                            {{ $user->nama }}
                                        </td>
                                        <td class="p-2">
                                            {{ $user->alamat }}
                                        </td>
                                        <td class="p-2">
                                            {{ $user->telepon }}
                                        </td>
                                        <td class="p-2">
                                            {{ $user->jk }}
                                        </td>
                                        <td class="p-2">
                                            {{ $user->divisi}}
                                        </td>
                                        <td class="p-2">
                                            {{ $user->bagian }}
                                        </td>
                                        <td class="p-2 h-full place-items-center">
                                            <a href="{{ route('employee.show', ['nip' => $user->nip]) }}" class="flex items-center rounded w-6 h-6 bg-btncolor2 hover:bg-btncolor hover:scale-105 p-0.5">
                                                <img src="/images/point-white.svg" alt="">
                                            </a>
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
    <script>
        function toggleCheckbox(row) {
            // Get the checkbox within the clicked row
            const checkbox = row.querySelector('input[type="checkbox"]');
            // Toggle checkbox status
            checkbox.checked = !checkbox.checked;
        }

        function deleteSelected() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            const idsToDelete = Array.from(checkboxes).map(checkbox => {
                return checkbox.closest('tr').querySelector('td:nth-child(2)').innerText; // Asumsi NIP ada di kolom kedua
            });

            if (idsToDelete.length === 0) {
                alert('Silakan pilih setidaknya satu karyawan untuk dihapus.');
                return;
            }

            const karyawanCount = idsToDelete.length;
            const message = karyawanCount === 1 ?
                " 1 karyawan ini?" :
                ` ${karyawanCount} karyawan ini?`;

            // Set pesan konfirmasi di modal
            document.getElementById('confirmMessage').innerText = message;
            document.getElementById('deleteConfirmModal').classList.remove('hidden');

            // Tangani klik pada tombol konfirmasi
            document.getElementById('confirmButton').onclick = function() {
                // Kirim permintaan untuk menghapus data
                axios.post('/admin/karyawan/hapus', {
                        ids: idsToDelete
                    })
                    .then(response => {
                        alert(response.data.message); // Tampilkan pesan sukses
                        location.reload(); // Refresh halaman
                    })
                    .catch(error => {
                        console.error(error);
                        alert('Terjadi kesalahan saat menghapus karyawan.');
                    });

                // Tutup modal setelah mengkonfirmasi
                document.getElementById('deleteConfirmModal').classList.add('hidden');
            };

            // Tutup modal saat tombol batal diklik
            document.getElementById('cancelButton').onclick = function() {
                document.getElementById('deleteConfirmModal').classList.add('hidden');
            };
        }

        function searchData(query) {
            // Fungsi untuk pencarian dalam tabel
            const searchInput = document.getElementById('search-input');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = searchInput.value.toLowerCase();
                    const rows = document.querySelectorAll('#user-table-body tr');

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

<div id="deleteConfirmModal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity ease-out duration-300 font-inter" aria-hidden="true"></div>

    <!-- Modal -->
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <!-- Modal panel -->
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold text-gray-900" id="modal-title">Menghapus Akun</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">Apakah kamu yakin ingin menghapus data akun dari <span id="confirmMessage"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button id="confirmButton" type="button" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Hapus</button>
                    <button id="cancelButton" type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>

</html>