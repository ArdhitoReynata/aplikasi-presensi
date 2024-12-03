<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="grid grid-rows-auto">
        <nav class="bg-white shadow-sm border-b border-strcolor transition-all duration-300">
            <div class="w-full">
                <div class="flex h-16 items-center">
                    <div class="flex transition-all duration-300">
                        <img src="images/logo.png" alt="Logo" class="h-10 w-10 mr-3 ml-mrnav">
                        <span class="font-inter text-sm font-medium w-tbnav">MPS KUD Tani Mulyo Lamongan</span>
                    </div>
                </div>
            </div>
        </nav>
        <div class="grid lg:grid-cols-6 grid-rows-auto w-full h-screen transition-all duration-500 ease-in-out">
            <!-- Bagian Kiri/Atas -->
            <div class="flex lg:items-start items-center bg-btncolor lg:p-6 md:p-5 p-4 lg:col-span-2 lg:row-span-6 text-white font-inter h-auto">
                <div>
                    <p class="font-bold lg:text-5xl text-3xl mb-1">Masuk.</p>
                    <p class="font-medium text-sm">Silahkan Masuk menggunakan Akun yang sudah Anda Buat.</p>
                </div>
            </div>

            <!-- Bagian Kanan/Bawah -->
            <div class="lg:col-span-4 lg:row-span-6 row-span-6 w-full flex items-center justify-center xl:p-48 lg:p-32 md:p-24 sn:p-12 p-8 font-inter font-semibold md:text-14 text-12 transition-all duration-500 ease-in-out">
                <form action="{{route('auth.verify')}}" method="post" class="w-full">
                    @csrf
                    <p class="md:mb-2 mb-1">Nomor Identitas Pegawai</p>
                    <input type="text" placeholder="NIP" name="nip" required
                        class="border border-strcolor rounded-lg w-full md:h-10 h-9 p-2 mb-5" @focus="scrollToInput" />

                    <p class="md:mb-2 mb-1">Kata Sandi</p>
                    <input type="password" placeholder="******" name="password" required
                        class="border border-strcolor rounded-lg w-full md:h-10 h-9 p-2" @focus="scrollToInput" />

                    @error('login_error')    
                    <div v-if="isPasswordError" class="flex text-red-500 md:text-14 text-12 border border-red-500 bg-red-100 rounded-lg w-full md:h-10 h-9 items-center mt-1.5 p-2">
                        <span class="w-full justify-start">{{ $message }}</span>
                        <div class="flex justify-end">
                            <img src="/images/danger-red.svg" alt="">
                        </div>
                    </div>
                    @enderror

                    <button type="submit"
                        class="bg-btncolor text-white font-inter md:text-14 text-12 font-semibold rounded-lg w-full md:h-10 h-9 mt-4">Masuk</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>