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
            <div class="grid grid-cols-1 gap-5 p-5">
                <div class="grid bg-white grid-cols-2 w-full rounded-md p-5 px-24 gap-24 border border-strcolor">
                    <div class="bg-bgtable">
                        <div class="flex w-full bg-gradient-to-r from-btncolor4 to-btncolor2 rounded-t-md p-3 text-white gap-2 text-14 font-semibold">
                            <img src="/images/logo.png" alt="" class="w-10 h-10">
                            <p>Mitra Produksi Sigaret <span class="flex">KUD Tani Mulyo Lamongan</span></p>
                        </div>
                        <div class=" text-center mt-10">
                            <p class="text-18 font-bold mb-3">{{ $user->divisi }}</p>
                            <img src="{{ asset($user->profile_image ? 'storage/' . $user->profile_image : 'images/default-profile.jpg') }}"
                                alt="Profile Image" class="mx-auto rounded-md w-[210px] h-[280px] object-cover">
                            <p class="text-18 font-bold mt-2">{{ $user->nama }}</p>
                            <p class="text-16">{{ $user->nip }}</p>
                        </div>
                        <div class="flex w-full bg-btncolor3 p-3 text-white gap-2 text-14 font-semibold mt-10">
                            <img src="/images/mail-white.svg" alt="" class="w-5 h-5">
                            <p class="text-14 font-semibold">{{ $user->email }}</p>
                        </div>
                        <div class="flex w-full bg-gradient-to-r from-btncolor4 to-btncolor2 rounded-b-md p-3 text-white gap-2 text-14 font-semibold">
                            <img src="/images/loc-white.svg" alt="" class="w-5 h-5">
                            <p class="text-14 font-semibold">{{ $user->alamat }}</p>
                        </div>
                    </div>
                    <div>
                        <div class="grid grid-rows-2 w-full h-full bg-gradient-to-r from-btncolor4 p-6 to-btncolor2 text-white gap-2 rounded-md">
                            <div class="flex flex-col gap-2">
                                <p class="text-18 font-bold text-center mb-2">Aturan</p>
                                <p class="text-12 font-semibold">1. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <p class="text-12 font-semibold">2. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                <p class="text-12 font-semibold">3. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                <p class="text-12 font-semibold">4. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                            <div class="flex flex-col items-center justify-center gap-2">
                                <img src="/images/logo.png" alt="" class="w-10 h-10">
                                <div class="flex items-center justify-center bg-white w-48 h-48 p-4 mt-2 rounded-md">
                                    {!! $user->qr_code_data !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<!-- <div>
    {!! $user->qr_code_data !!}
</div> -->