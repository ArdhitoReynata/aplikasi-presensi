<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js' ])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body class="bg-bgcolor">
    <section id="app" class="bg-bgcolor flex">
        <navbar :user="{{ json_encode(Auth::user()) }}" ></navbar>
        <sidebar></sidebar>
        <div class="ml-[68px] lg:ml-64 mt-12 md:mt-14 lg:mt-16 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 p-5 justify-center">
                <div class="bg-white border rounded-md border-strcolor p-5 w-full h-auto">
                    <div class="flex flex-row">
                        <img src="/images/report-black.svg" alt="">
                        <div class="flex items-end">
                            <span class="font-inter text-sm font-semibold text-tbcolor ml-1.5">Presensi</span>
                            <p class="font-inter text-10 font-medium text-tbcolor1 ml-1">Hari ini</p>
                        </div>
                    </div>
                    <div>
                        <grafik></grafik>
                    </div>
                </div>
                <div class="bg-white flex flex-col border rounded-md border-strcolor p-5 w-full h-auto">
                    <div class="flex flex-row">
                        <img src="/images/report-black.svg" alt="">
                        <div class="flex items-end">
                            <span class="font-inter text-sm font-semibold text-tbcolor ml-1.5">Presensi</span>
                            <p class="font-inter text-10 font-medium text-tbcolor1 ml-1">Minggu ini</p>
                        </div>
                    </div>
                    <div>
                        <grafik2></grafik2>
                    </div>
                </div>
                <div class="bg-white flex flex-col border rounded-md border-strcolor p-5 w-full h-auto">
                    <div class="flex flex-row">
                        <img src="/images/report-black.svg" alt="">
                        <div class="flex items-end">
                            <span class="font-inter text-sm font-semibold text-tbcolor ml-1.5">Presensi</span>
                            <p class="font-inter text-10 font-medium text-tbcolor1 ml-1">Bulan ini</p>
                        </div>
                    </div>
                    <div>
                        <grafik3></grafik3>
                    </div>
                </div>
                <div class="bg-white flex flex-col border rounded-md border-strcolor p-5 w-full h-auto col-span-1 lg:col-span-2 xl:col-span-3">
                    <grafik-batang></grafik-batang>
                </div>
                <div class="bg-white flex flex-col border rounded-md border-strcolor p-5 w-full h-auto col-span-1 lg:col-span-2 xl:col-span-3">
                    01
                </div>
                <div class="bg-white flex flex-col border rounded-md border-strcolor p-5 w-full h-auto col-span-1 lg:col-span-2 xl:col-span-3">
                    01
                </div>
                <div class="bg-white flex flex-col border rounded-md border-strcolor p-5 w-full h-auto col-span-1 lg:col-span-2 xl:col-span-3">
                    01
                </div>
                <div class="bg-white flex flex-col border rounded-md border-strcolor p-5 w-full h-auto col-span-1 lg:col-span-2 xl:col-span-3">
                    01
                </div>
                <div class="bg-white flex flex-col border rounded-md border-strcolor p-5 w-full h-auto col-span-1 lg:col-span-2 xl:col-span-3">
                    01
                </div>
            </div>
        </div>
    </section>
</body>

</html>