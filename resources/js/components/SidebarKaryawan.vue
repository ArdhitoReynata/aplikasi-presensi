<template>

    <body class="grid grid-rows-2 mt-14 lg:mt-16 border-r border-strcolor bg-white p-3 fixed h-screen w-[68px] lg:w-64">
        <div class="grid row-span-1 content-start gap-1">
            <div>
                <button onclick="window.location.href='/karyawan/home';" @click="setActiveButton('home')"
                    :class="['transition-all duration-300 transform', activeButton === 'home' ? 'bg-btncolor2 text-white' : 'hover:scale-105 hover:bg-btncolor2 hover:text-white']"
                    class="font-inter text-sm font-semibold rounded-lg py-1.5 mt-1 flex items-center w-full justify-content group">
                    <img :src="activeButton === 'home' ? '/images/home.svg' : '/images/home-black.svg'"
                        class="h-7 w-7 p-1 ml-2 group-hover:hidden" alt="Home">
                    <img :src="'/images/home.svg'" class="h-7 w-7 p-1 ml-2 group-hover:block hidden" alt="Home">
                    <span
                        class="hidden lg:block text-black ml-2 pr-3 font-inter text-sm font-medium group-hover:text-white"
                        :class="activeButton === 'home' ? 'text-white' : 'text-black'">Home</span>
                </button>
            </div>
            <div>
                <button onclick="window.location.href='/karyawan/kodeqr';" @click="setActiveButton('kodeqr')"
                    :class="['transition-all duration-300 transform', activeButton === 'kodeqr' ? 'bg-btncolor2 text-white' : 'hover:scale-105 hover:bg-btncolor2 hover:text-white']"
                    class="font-inter text-sm font-semibold rounded-lg py-1.5 flex items-center w-full justify-content group">
                    <img :src="activeButton === 'kodeqr' ? '/images/qr-white.svg' : '/images/qr-black.svg'"
                        class="h-7 w-7 p-1 ml-2 group-hover:hidden" alt="Kode QR">
                    <img :src="'/images/qr-white.svg'" class="h-7 w-7 p-1 ml-2 group-hover:block hidden" alt="Kode QR">
                    <span
                        class="hidden lg:block text-black ml-2 pr-3 font-inter text-sm font-medium group-hover:text-white"
                        :class="activeButton === 'kodeqr' ? 'text-white' : 'text-black'">Kode QR</span>
                </button>
            </div>
            <div>
                <button onclick="window.location.href='/karyawan/perizinan';" @click="setActiveButton('perizinan')"
                    :class="['transition-all duration-300 transform', activeButton === 'perizinan' ? 'bg-btncolor2 text-white' : 'hover:scale-105 hover:bg-btncolor2 hover:text-white']"
                    class="font-inter text-sm font-semibold rounded-lg py-1.5 flex items-center w-full justify-content group">
                    <img :src="activeButton === 'perizinan' ? '/images/document-white.svg' : '/images/document-black.svg'"
                        class="h-7 w-7 p-1 ml-2 group-hover:hidden" alt="Perizinan">
                    <img :src="'/images/document-white.svg'" class="h-7 w-7 p-1 ml-2 group-hover:block hidden"
                        alt="Perizinan">
                    <span
                        class="hidden lg:block text-black ml-2 pr-3 font-inter text-sm font-medium group-hover:text-white"
                        :class="activeButton === 'perizinan' ? 'text-white' : 'text-black'">Perizinan Kerja</span>
                </button>
            </div>
            <div>
                <button onclick="window.location.href='/karyawan/cuti';" @click="setActiveButton('cuti')"
                    :class="['transition-all duration-300 transform', activeButton === 'cuti' ? 'bg-btncolor2 text-white' : 'hover:scale-105 hover:bg-btncolor2 hover:text-white']"
                    class="font-inter text-sm font-semibold rounded-lg py-1.5 flex items-center w-full justify-content group">
                    <img :src="activeButton === 'cuti' ? '/images/work-white.svg' : '/images/work-black.svg'"
                        class="h-7 w-7 p-1 ml-2 group-hover:hidden" alt="Cuti">
                    <img :src="'/images/work-white.svg'" class="h-7 w-7 p-1 ml-2 group-hover:block hidden" alt="Cuti">
                    <span
                        class="hidden lg:block text-black ml-2 pr-3 font-inter text-sm font-medium group-hover:text-white"
                        :class="activeButton === 'cuti' ? 'text-white' : 'text-black'">Pengajuan Cuti</span>
                </button>
            </div>
            <div>
                <button onclick="window.location.href='/karyawan/kehadiran';" @click="setActiveButton('kehadiran')"
                    :class="['transition-all duration-300 transform', activeButton === 'kehadiran' ? 'bg-btncolor2 text-white' : 'hover:scale-105 hover:bg-btncolor2 hover:text-white']"
                    class="font-inter text-sm font-semibold rounded-lg py-1.5 flex items-center w-full justify-content group">
                    <img :src="activeButton === 'kehadiran' ? '/images/history-white.svg' : '/images/history-black.svg'"
                        class="h-7 w-7 p-1 ml-2 group-hover:hidden" alt="Kehadiran">
                    <img :src="'/images/history-white.svg'" class="h-7 w-7 p-1 ml-2 group-hover:block hidden"
                        alt="Kehadiran">
                    <span
                        class="hidden lg:block text-black ml-2 pr-3 font-inter text-sm font-medium group-hover:text-white"
                        :class="activeButton === 'kehadiran' ? 'text-white' : 'text-black'">Riwayat Kehadiran</span>
                </button>
            </div>
            <div>
                <button onclick="window.location.href='/karyawan/pengaturan';" @click="setActiveButton('pengaturan')"
                    :class="['transition-all duration-300 transform', activeButton === 'pengaturan' ? 'bg-btncolor2 text-white' : 'hover:scale-105 hover:bg-btncolor2 hover:text-white']"
                    class="font-inter text-sm font-semibold rounded-lg py-1.5 flex items-center w-full justify-content group">
                    <img :src="activeButton === 'pengaturan' ? '/images/profile-white.svg' : '/images/profile-black.svg'"
                        class="h-7 w-7 p-1 ml-2 group-hover:hidden" alt="Pengaturan">
                    <img :src="'/images/profile-white.svg'" class="h-7 w-7 p-1 ml-2 group-hover:block hidden"
                        alt="Pengaturan">
                    <span
                        class="hidden lg:block text-black ml-2 pr-3 font-inter text-sm font-medium group-hover:text-white"
                        :class="activeButton === 'pengaturan' ? 'text-white' : 'text-black'">Pengaturan Pengguna</span>
                </button>
            </div>
        </div>
        <div class="grid row-span-1 content-end mb-16">
            <a class="flex font-inter lg:text-sm text-xs font-medium bg-dangercolor text-white
             rounded-md hover:bg-dangercolor2 transition-all duration-300 transform hover:scale-105 hover:text-white py-2 items-center"
                href="/logout">
                <img :src="'/images/logout-white.svg'" alt="" class="h-4 w-4 mx-3">
                Keluar
            </a>
        </div>
    </body>
</template>

<script>
export default {
    data() {
        return {
            dropdownOpen: false,
            isLargeScreen: window.innerWidth >= 1024,
            activeButton: '',
        };
    },
    methods: {
        toggleDropdown() {
            this.dropdownOpen = !this.dropdownOpen;
        },
        setActiveButton(button) {
            this.activeButton = button;
            localStorage.setItem('activeButton', button);
        },
        handleResize() {
            this.isLargeScreen = window.innerWidth >= 1024;
            if (this.isLargeScreen) {
                this.dropdownOpen = false;
            }
        },
        setActiveButtonBasedOnUrl() {
            const path = window.location.pathname;
            if (path.includes('/karyawan/home')) {
                this.activeButton = 'home';
            } else if (path.includes('/karyawan/kodeqr')) {
                this.activeButton = 'kodeqr';
            } else if (path.includes('/karyawan/perizinan')) {
                this.activeButton = 'perizinan';
            } else if (path.includes('/karyawan/cuti')) {
                this.activeButton = 'cuti';
            } else if (path.includes('/karyawan/kehadiran')) {
                this.activeButton = 'kehadiran';
            } else if (path.includes('/karyawan/pengaturan')) {
                this.activeButton = 'pengaturan';
            }
        }
    },
    mounted() {
        window.addEventListener('resize', this.handleResize);

        // Atur active button berdasarkan URL saat ini
        this.setActiveButtonBasedOnUrl();

        // Cek nilai dari localStorage jika tidak ada active button yang cocok dengan URL
        if (!this.activeButton) {
            const savedButton = localStorage.getItem('activeButton');
            if (savedButton) {
                this.activeButton = savedButton;
            }
        }
    },
    beforeDestroy() {
        window.removeEventListener('resize', this.handleResize);
    },
};
</script>

<style scoped>
.transition-all1 {
    transition: all 0.5s ease-in-out;
}

.transition-all {
    transition: all 0.2s ease-in-out;
}

.hover\:scale-105:hover {
    transform: scale(1.02);
}

.hover\:bg-btncolor2:hover {
    background-color: #2D6A4F;
}
</style>