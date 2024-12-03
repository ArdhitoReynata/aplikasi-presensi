<template>

    <body>
        <!-- Navbar -->
        <nav
            class="grid grid-cols-2 bg-white shadow-sm border-b border-strcolor transition-all duration-300 lg:h-16 md:h-15 h-14 w-full z-50 p-2 lg:px-5 md:px-4 px-3 fixed">
            <div class="flex items-center transition-all duration-300">
                <img :src="user.profile_image ? '/storage/' + user.profile_image : '/images/default-profile.jpg'"
                    alt="Logo"
                    class="h-9 w-9 md:h-10 md:w-10 lg:h-11 lg:w-11 mr-2 rounded-full object-cover border border-grey-900" />
                <p class="font-inter font-medium text-12 md:text-13 lg:text-14">Selamat Datang,
                    <span class="flex font-inter w-full font-semibold text-12 md:text-13 lg:text-14">{{ user.nama
                        }}</span>
                </p>
            </div>
            <div class="flex items-center justify-end transition-all duration-300">
                <button @click="toggleDropdown"
                    class="relative mr-2 p-2 rounded-md border border-strcolor bg-white transform transition-all duration-300 hover:scale-105 hover:bg-btncolor2 group">
                    <img src="../../../public/images/notify-black.svg" alt=""
                        class="w-4 h-4 lg:w-5 lg:h-5 transition-all duration-300 group-hover:hidden" />
                    <img src="../../../public/images/notify-white.svg" alt=""
                        class="w-4 h-4 lg:w-5 lg:h-5 transition-all duration-300 group-hover:block hidden" />
                    <span
                        class="absolute w-1 h-1 left-6 bottom-6 lg:left-7 lg:bottom-7 rounded-full bg-btncolor opacity-full"></span>
                    <span
                        class="absolute animate-ping w-1 h-1 left-6 bottom-6 lg:left-7 lg:bottom-7 rounded-full bg-btncolor opacity-full"></span>
                    <div v-if="dropdownOpen"
                        class="absolute w-auto right-0 mt-5 bg-white border border-strcolor rounded-md shadow-lg">
                        <div class="flex">
                            <div class="py-1 " role="none">
                                <p class="flex border-b border-strcolor px-40 py-3 font-inter text-sm font-semibold">
                                    Notifikasi</p>
                                <a href="#"
                                    class="block px-2 py-2 border-b border-b-strcolor border-l-4 border-l-btncolor"
                                    role="menuitem" tabindex="-1" id="menu-item-0">
                                    <div class="flex justify-between">
                                        <div class="flex items-center">
                                            <img class="mr-1.5" src="../../../public/images/work-black.svg" alt="">
                                            <p class="font-inter text-xs font-semibold">Pengajuan Cuti</p>
                                        </div>
                                        <div class="flex items-center">
                                            <p class="font-inter text-11 font-regular text-tbcolor1">16 September
                                                2024</p>
                                        </div>
                                    </div>
                                    <div class="font-inter text-justify text-10 font-semibold mt-0.5">
                                        <p>Permohonan cuti Anda telah Disetujui. Nikmati waktu istirahat Anda, dan
                                            jangan
                                            ragu untuk menghubungi HR jika ada pertanyaan lebih lanjut.</p>
                                    </div>
                                </a>
                                <a href="#" class="bg-bgcolor block px-2 py-2 border-b border-strcolor " role="menuitem"
                                    tabindex="-1" id="menu-item-0">
                                    <div class=" text-tbcolor1 flex justify-between">
                                        <div class="flex items-center">
                                            <img class="mr-1.5" src="../../../public/images/work-grey.svg" alt="">
                                            <p class=" font-inter text-xs font-semibold">Pengajuan Cuti</p>
                                        </div>
                                        <div class="flex items-center">
                                            <p class="font-inter text-11 font-regular">16 September 2024</p>
                                        </div>
                                    </div>
                                    <div class="font-inter text-justify text-10 font-semibold mt-0.5  text-tbcolor1">
                                        <p>Permohonan cuti Anda telah Disetujui. Nikmati waktu istirahat Anda, dan
                                            jangan
                                            ragu untuk menghubungi HR jika ada pertanyaan lebih lanjut.</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </button>
                <a class="font-inter lg:text-sm text-xs font-medium bg-btncolor text-white p-10 py-2 rounded-md hover:bg-btncolor2 transition-all duration-300 transform hover:scale-105 hover:text-white"
                    href="/logout">Keluar
                </a>
            </div>
        </nav>
    </body>
</template>

<script>
export default {
    props: {
        user: Object
    },
}
</script>

<style scoped>
.transition-all {
    transition: all 0.2s ease-in-out;
}

.hover\:scale-105:hover {
    transform: scale(1.02);
}

/* Gaya untuk tombol notifikasi */
.group-hover\:text-white:hover {
    color: white;
}

.group-hover\:block:hover {
    display: block;
}

.group-hover\:hidden:hover {
    display: none;
}

/* Tambahkan kelas warna tombol baru jika diperlukan */
.hover\:bg-btncolor2:hover {
    background-color: #2d6a4f;
    /* Ganti dengan warna yang diinginkan */
}
</style>
