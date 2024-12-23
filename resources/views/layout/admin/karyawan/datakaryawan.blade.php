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
          <div class="flex gap-2">
            <a href="" class="w-8 h-8 rounded-md bg-white border border-strcolor">
              <img src="/images/back-black.svg" alt="" class="p-2">
            </a>
            <p class="flex items-center font-medium text-16">Data Karyawan</p>
          </div>
        </div>
        <div class="flex h-full">
          <div class="grid grid-cols-6 border bg-white border-strcolor rounded-md w-full content-center gap-5">
            <div class="grid col-span-2 py-5 items-end justify-items-end">
              <button class="font-semibold bg-opacity-50 bg-btncolor text-white h-auto rounded-full hover:bg-btncolor transition-all duration-300 transform hover:scale-105 text-15 absolute mx-7 mb-2 p-4" onclick="triggerFileInput()">
                <img src="/images/pen-white.svg" alt="Edit Profile Picture">
              </button>
              <img id="profileImage"
                src=""
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
                  <p class="font-medium">Ardhito Reynata</p>
                </div>
                <div class="col-span-2">
                  <p>NIK :</p>
                  <p class="font-medium">3578031111030002</p>
                </div>
                <div class="col-span-2">
                  <p>Nomor Telepon :</p>
                  <p class="font-medium">082139962799</p>
                </div>
                <div class="col-span-2">
                  <p>Email :</p>
                  <p class="font-medium">ditoardhito83@gmail.com</p>
                </div>
                <div class="col-span-2">
                  <p>Alamat :</p>
                  <p class="font-medium">Rungkut Asri Barat 12 No. 4</p>
                </div>
                <div class="col-span-2">
                  <p>Jenis Kelamin :</p>
                  <p class="font-medium">Laki-laki</p>
                </div>
              </div>
              <div class="grid grid-cols-4 row-span-3 border border-strcolor rounded-md p-4 text-14">
                <p class="col-span-4 text-18">Data Perusahaan</p>
                <div class="col-span-2">
                  <p>NIP :</p>
                  <p class="font-medium">710001</p>
                </div>
                <div class="col-span-2">
                  <p>Role di Aplikasi :</p>
                  <p class="font-medium">Karyawan</p>
                </div>
                <div class="col-span-2">
                  <p>Divisi :</p>
                  <p class="font-medium">IT Support</p>
                </div>
                <div class="col-span-2">
                  <p>Bagian :</p>
                  <p class="font-medium">Pengembangan Web</p>
                </div>
              </div>
              <div class="grid row-span-1 h-full gap-5">
                <!-- Tombol untuk membuka modal -->
                <button
                  class="font-medium bg-dangercolor text-white w-full h-auto rounded-md hover:bg-dangercolor2 transition-all duration-300 transform hover:scale-100 text-15"
                  onclick="openPasswordModal()">
                  Hapus Akun
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>