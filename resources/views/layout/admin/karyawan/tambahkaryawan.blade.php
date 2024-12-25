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
    <div class="ml-[68px] lg:ml-64 mt-16 w-full">
      <div class="flex flex-col p-5 gap-2">
        <div class="flex">
          <a href="./karyawan" class="w-8 h-8 rounded-md bg-white border border-strcolor hover:bg-slate-50 hover:scale-105">
            <img src="/images/back-black.svg" alt="" class="p-2">
          </a>
          <div class="flex flex-col">
            <p class="flex justify-start font-medium text-16 ml-2">Tambah Karyawan</p>
            <div class="flex flex-row items-center">
              <p class="text-12 font-semibold text-btncolor ml-2 mr-1">Tambah Karyawan</p>
            </div>
          </div>
        </div>
        <div class="flex h-full bg-white border rounded-md border-strcolor">
          <form method="POST">
            @csrf
            <div class="grid grid-cols-6 gap-5 w-full content-center p-5">
              <div class="w-full col-span-6 md:col-span-3 lg:col-span-2 font-inter font-medium text-12 md:text-13 lg:text-14">
                <p1 class="font-bold md:font-bold lg:font-semibold text-12 md:text-13 lg:text-14">Nama Lengkap</p1>
                <input-box type="text" placeholder="Masukkan Nama Lengkap" name="nama"></input-box>
              </div>
              <div class="w-full col-span-6 md:col-span-3 lg:col-span-2 font-inter font-medium text-12 md:text-13 lg:text-14">
                <p1 class="font-inter font-semibold text-12 md:text-13 lg:text-14">NIP (Nomor Identitas Pegawai)</p1>
                <input-box type="text" placeholder="Masukkan NIP" name="nip"></input-box>
              </div>
              <div class="w-full col-span-6 md:col-span-3 lg:col-span-2 font-inter font-medium text-12 md:text-13 lg:text-14">
                <p1 class="font-inter font-semibold text-12 md:text-13 lg:text-14">NIK (Nomor Induk Kependudukan)</p1>
                <input-box type="text" placeholder="Masukkan NIK" name="nik"></input-box>
              </div>
              <div class="w-full col-span-6 md:col-span-3 lg:col-span-3 font-inter font-medium text-12 md:text-13 lg:text-14">
                <p1 class="font-inter font-semibold text-12 md:text-13 lg:text-14">Email</p1>
                <input-box type="text" placeholder="Masukkan Email" name="email"></input-box>
              </div>
              <div class="w-full col-span-6 md:col-span-3 lg:col-span-3 font-inter font-medium text-12 md:text-13 lg:text-14">
                <p1 class="font-inter font-semibold text-12 md:text-13 lg:text-14">Nomor Telepon</p1>
                <input-box type="text" placeholder="Masukkan Nomor Telepon" name="telepon"></input-box>
              </div>
              <div class="w-full col-span-6 md:col-span-3 lg:col-span-6 font-inter font-medium text-12 md:text-13 lg:text-14">
                <p1 class="font-inter font-semibold text-12 md:text-13 lg:text-14">Alamat</p1>
                <input-box type="text" placeholder="Masukkan Alamat" name="alamat"></input-box>
              </div>
              <div class="w-full col-span-6 md:col-span-2 font-inter font-medium text-12 md:text-13 lg:text-14">
                <p1 class="font-inter font-semibold text-12 md:text-13 lg:text-14">Jenis Kelamin</p1>
                <select-box name="jk">
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select-box>
              </div>
              <div class="w-full col-span-3 md:col-span-2 font-inter font-medium text-12 md:text-13 lg:text-14">
                <p1 class="font-inter font-semibold text-12 md:text-13 lg:text-14">Divisi</p1>
                <select-box name="divisi">
                  <option value="IT Support">IT Support</option>
                  <option value="HRD">HRD</option>
                </select-box>
              </div>
              <div class="w-full col-span-3 md:col-span-2 font-inter font-medium text-12 md:text-13 lg:text-14">
                <p1 class="font-inter font-semibold text-12 md:text-13 lg:text-14">Bagian</p1>
                <select-box name="bagian">
                  <option value="Pengembangan Web">Pengembangan Web</option>
                  <option value="HRD">HRD</option>
                </select-box>
              </div>
              <div class="w-full col-span-6 h-full font-inter text-12 md:text-13 lg:text-14">
                <p1 class="font-inter font-semibold text-12 md:text-13 lg:text-14">Foto Profil (Opsional)</p1>
                <div class="flex items-center justify-center w-full mt-1">
                  <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center p-5">
                      <img src="/images/upload.svg" alt="" class="w-8 h-8 mb-2">
                      <p class="font-semibold text-tbcolor1 text-center">Letakkan File Anda Disini atau Jelajahi</p>
                      <p class="text-tbcolor1 text-center ">Disarankan menggunakan format jpg. jpeg. png.</p>
                    </div>
                    <input id="dropzone-file" type="file" class="hidden" />
                  </label>
                </div>
              </div>
              <div class="flex justify-end w-full col-span-6 h-full font-inter font-medium text-12 md:text-13 lg:text-14">
                <button type="submit" class="bg-btncolor2 text-white py-2 px-20 justify-center rounded-md hover:bg-btncolor transition-all duration-300 transform hover:scale-105 hover:text-white">
                  Buat
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>

</html>