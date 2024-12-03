<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuti</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <section id="app" class="flex h-screen bg-bgcolor">
        <navbar :user="{{ json_encode(Auth::user()) }}"></navbar>
        <sidebar></sidebar>
        <!-- Sidebar -->
        <div class="flex left-0 bg-white lg:w-1/2 max-w-64 shadow-sm border-r border-strcolor p-5 min-h-full mt-14">
            <button @click="toggleDropdown" class="lg:hidden flex w-full">
                <span class="flex left-0 w-8 p-1 mb-2 border border-strcolor rounded-md">
                    <img src="../../../public/images/menu-black.svg" alt="">
                </span>
            </button>
        </div>
        <!-- Konten -->
        <!-- <div class="flex sm:flex gap-5 ml-5">
            <div class="col-4 bg-black">
                TESTESTSETSTETSETSTETSTETSESIDHFSUIDHFSDIUFHSDI
            </div>
            <div class="col-4 bg-blue-600">
                TESTESTSETSTETSETSTETSTETSESIDHFSUIDHFSDIUFHSDI
            </div>
            <div class="col-4 bg-red-700">
                TESTESTSETSTETSETSTETSTETSESIDHFSUIDHFSDIUFHSDI
            </div>
         </div> -->
        <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-5 p-5 mt-16 justify-center w-full h-24">
            <div class="bg-white flex flex-col border rounded-md border-strcolor p-5 w-full h-auto">
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
                        <p class="font-inter text-10 font-medium text-tbcolor1 ml-1">Hari ini</p>
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
                        <p class="font-inter text-10 font-medium text-tbcolor1 ml-1">Hari ini</p>
                    </div>
                </div>
                <div>
                    <grafik3></grafik3>
                </div>
            </div>

            <div class="bg-white flex flex-col border rounded-md border-strcolor p-5 w-full h-auto col-span-1 lg:col-span-2 xl:col-span-3">
                01
            </div>
        </div>
    </section>
</body>

</html>