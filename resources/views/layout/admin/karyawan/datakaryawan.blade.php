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
      <div class="flex flex-col p-5 gap-2">
        <div class="flex">
          <a href="../karyawan" class="w-8 h-8 rounded-md bg-white border border-strcolor hover:bg-slate-50 hover:scale-105">
            <img src="/images/back-black.svg" alt="" class="p-2">
          </a>
          <div class="flex flex-col">
            <p class="flex justify-start font-medium text-16 ml-2">Data Karyawan</p>
            <div class="flex flex-row justify-center">
              <p class="text-12 font-semibold text-btncolor ml-2 mr-1">Informasi Karyawan</p>
              <img src="/images/arrow-black.svg" alt="" class="w-4">
            </div>
          </div>
        </div>
        <div class="flex h-full">
          <div class="grid grid-cols-6 border bg-white border-strcolor rounded-md w-full content-center gap-5">
            <div class="grid col-span-2 py-5 items-end justify-items-end">
              <img id="profileImage"
                src="{{ asset($employee->profile_image ? 'storage/' . $employee->profile_image : 'images/default-profile.jpg') }}"
                alt="Profile Image"
                class="rounded-md w-[354px] h-[472px] object-cover mx-5">
              <input type="file" id="profileImageInput" name="profile_image" accept="image/*" class="hidden" onchange="previewImageAndUpload(event)">
            </div>
            <div class="grid col-span-4 grid-rows-auto font-bold py-5 pr-5 gap-5">
              <div class="grid grid-cols-4 row-span-3 border border-strcolor rounded-md p-4 text-14">
                <div class="col-span-4 text-18">
                  <p>Data Personal</p>
                </div>
                <div class="col-span-2">
                  <p>Nama :</p>
                  <p class="font-medium">{{ $employee->nama }}</p>
                </div>
                <div class="col-span-2">
                  <p>NIK :</p>
                  <p class="font-medium">{{ $employee->nik }}</p>
                </div>
                <div class="col-span-2">
                  <p>Nomor Telepon :</p>
                  <p class="font-medium">{{ $employee->telepon }}</p>
                </div>
                <div class="col-span-2">
                  <p>Email :</p>
                  <p class="font-medium">{{ $employee->email }}</p>
                </div>
                <div class="col-span-2">
                  <p>Alamat :</p>
                  <p class="font-medium">{{ $employee->alamat }}</p>
                </div>
                <div class="col-span-2">
                  <p>Jenis Kelamin :</p>
                  <p class="font-medium">{{ $employee->jk }}</p>
                </div>
              </div>
              <div class="grid grid-cols-4 row-span-3 border border-strcolor rounded-md p-4 text-14">
                <p class="col-span-4 text-18">Data Perusahaan</p>
                <div class="col-span-2">
                  <p>NIP :</p>
                  <p class="font-medium" id="employeeNip">{{ $employee->nip }}</p>
                </div>
                <div class="col-span-2">
                  <p>Role di Aplikasi :</p>
                  <p class="font-medium">{{ $employee->role }}</p>
                </div>
                <div class="col-span-2">
                  <p>Divisi :</p>
                  <p class="font-medium">{{ $employee->divisi }}</p>
                </div>
                <div class="col-span-2">
                  <p>Bagian :</p>
                  <p class="font-medium">{{ $employee->bagian }}</p>
                </div>
              </div>
              <div class="grid grid-cols-2 row-span-1 h-full gap-5">
                <!-- Tombol untuk membuka modal -->
                <button
                  class="font-medium bg-dangercolor text-white w-full h-auto rounded-md hover:bg-dangercolor2 transition-all duration-300 transform hover:scale-100 text-15"
                  onclick="deleteSelected()">
                  Hapus Akun
                </button>
                <button class="font-medium bg-btncolor2 text-white w-full h-auto rounded-md hover:bg-btncolor transition-all duration-300 transform hover:scale-100 text-15"
                  onclick="location.href='{{ route('admin.karyawan.edit', $employee->nip) }}'">
                  Edit Akun
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>
<script>
  function previewImageAndUpload(event) {
    const input = event.target; // Input file element
    const file = input.files[0]; // File yang dipilih

    if (file) {
      const reader = new FileReader(); // FileReader untuk membaca file

      reader.onload = function(e) {
        // Set src dari elemen <img> dengan data URL dari file
        const profileImage = document.getElementById('profileImage');
        profileImage.src = e.target.result;
      };

      reader.readAsDataURL(file); // Membaca file sebagai URL
    }
  }

  function deleteSelected() {
    // Ambil NIP dari elemen dengan ID "employeeNip"
    const nip = document.getElementById('employeeNip').innerText;

    // Tampilkan modal konfirmasi
    const message = `akun dengan NIP ${nip}?`;
    document.getElementById('confirmMessage').innerText = message;
    document.getElementById('deleteConfirmModal').classList.remove('hidden');

    // Tangani klik pada tombol konfirmasi
    document.getElementById('confirmButton').onclick = function() {
      // Kirim permintaan untuk menghapus data
      axios.post('/admin/karyawan/hapus', {
          ids: [nip], // Masukkan NIP ke dalam array
        })
        .then(response => {
          alert(response.data.message); // Tampilkan pesan sukses
          location.href = "../karyawan"; // Redirect ke halaman daftar karyawan
        })
        .catch(error => {
          console.error(error);
          alert('Terjadi kesalahan saat menghapus akun.');
        });

      // Tutup modal setelah mengkonfirmasi
      document.getElementById('deleteConfirmModal').classList.add('hidden');
    };

    // Tutup modal saat tombol batal diklik
    document.getElementById('cancelButton').onclick = function() {
      document.getElementById('deleteConfirmModal').classList.add('hidden');
    };
  }
</script>
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