<template>
  <div class="qr-scanner flex justify-center items-center h-screen relative">
    <video ref="video" autoplay class="video-stream w-full h-screen object-cover overflow-y-hidden rounded-lg scale-x-[-1]"></video>
    <!-- Pesan feedback jika presensi berhasil atau gagal -->
    <div v-if="feedbackMessage" class="absolute top-0 p-4 transform -translate-x-1/2 w-full"
      :class="{'animate-slide-in': feedbackMessage, 'animate-slide-out': !feedbackMessage}">
      <div
        :class="{'bg-gradient-to-r from-btncolor to-btncolor2': successMessage, 'bg-gradient-to-r from-dangercolor2 to-dangercolor': !successMessage}"
        class="flex items-center text-white p-2 rounded-lg shadow-lg transform transition duration-300 ease-out">
        <!-- Icon sukses atau gagal -->
        <div class="flex items-center justify-center w-8 h-8 bg-white rounded-full mr-2">
          <img v-if="successMessage" src="../../../public/images/check-green.svg" alt="Success Icon" class="w-5 h-5">
          <img v-else src="../../../public/images/error-red.svg" alt="Error Icon" class="w-5 h-5">
        </div>

        <!-- Teks pesan -->
        <p class="flex-grow text-xs sm:text-sm md:text-base font-semibold">{{ feedbackMessage }}</p>

        <!-- Tombol close -->
        <button @click="feedbackMessage = ''" class="text-white focus:outline-none hover:text-gray-200">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Kotak area pemindaian QR -->
    <div class="absolute flex justify-center items-center pointer-events-none">
      <div class="rounded-xl w-24 h-24 sm:w-48 sm:h-48 md:w-96 md:h-96 bg-white opacity-30 m-2 md:m-4 lg:m-5"></div>
      <div
        class="absolute rounded-tl-xl top-0 left-0 border-t-2 border-l-2 md:border-t-4 md:border-l-4 border-white w-6 h-6 md:w-16 md:h-16">
      </div>
      <div
        class="absolute rounded-tr-xl top-0 right-0 border-t-2 border-r-2 md:border-t-4 md:border-r-4 border-white w-6 h-6 md:w-16 md:h-16">
      </div>
      <div
        class="absolute rounded-bl-xl bottom-0 left-0 border-b-2 border-l-2 md:border-b-4 md:border-l-4 border-white w-6 h-6 md:w-16 md:h-16">
      </div>
      <div
        class="absolute rounded-br-xl bottom-0 right-0 border-b-2 border-r-2 md:border-b-4 md:border-r-4 border-white w-6 h-6 md:w-16 md:h-16">
      </div>
    </div>
  </div>
</template>


<script>
import axios from 'axios';
import { BrowserMultiFormatReader } from '@zxing/library';

export default {
  data() {
    return {
      codeReader: null,
      qrCodeData: null,
      scanning: false,
      feedbackMessage: '',  // Menyimpan pesan feedback
      successMessage: false, // Untuk mengatur warna kotak feedback
      userName: '', // Menyimpan nama pengguna
    };
  },
  methods: {
    async startScanner() {
      this.scanning = true;
      this.codeReader = new BrowserMultiFormatReader();

      try {
        const videoInputDevices = await this.codeReader.listVideoInputDevices();
        const selectedDeviceId = videoInputDevices[0]?.deviceId;

        this.codeReader.decodeFromVideoDevice(
          selectedDeviceId,
          this.$refs.video,
          async (result, error) => {
            if (result) {
              this.qrCodeData = result.getText();
              console.log("QR Code Data:", this.qrCodeData);

              // Reset feedback message setiap kali QR baru terdeteksi
              if (this.successMessage) {
                this.feedbackMessage = '';
              }

              // Kirim data ke backend setelah berhasil memindai
              await this.sendQrDataToBackend(this.qrCodeData);
            }
          }
        );
      } catch (error) {
        console.error("Error starting scanner:", error);
        this.stopScanner();
      }
    },
    async sendQrDataToBackend(data) {
      try {
        const response = await axios.post('/presensi/store', {
          qr_code_data: data,
          status: 'Hadir',
        });

        // Menangani respons dari backend
        if (response.data.message === 'anda sudah melakukan presensi hari ini') {
          // Menampilkan pesan jika sudah presensi
          this.setFeedbackMessage(`Halo ${response.data.nama}, ${response.data.message}`, true);
        } else if (response.data.message === 'data presensi berhasil disimpan') {
          // Menampilkan pesan sukses jika presensi berhasil
          this.setFeedbackMessage(`Halo ${response.data.nama}, ${response.data.message}`, true);
        } else {
          // Pesan kesalahan umum jika ada
          this.setFeedbackMessage('Terjadi kesalahan, silakan coba lagi', false);
        }
      } catch (error) {
        console.error('Error sending QR data to backend:', error);
        // Menangani kesalahan jika koneksi gagal
        this.setFeedbackMessage('Terjadi kesalahan saat mengirim data', false);
      }
    },

    stopScanner() {
      if (this.codeReader) {
        this.codeReader.reset();
        this.scanning = false;
        this.qrCodeData = null;
      }
    },
    setFeedbackMessage(message, success) {
      this.feedbackMessage = message;
      this.successMessage = success;

      // Jika pesan gagal, hilangkan setelah beberapa detik
      if (!success) {
        setTimeout(() => {
          this.feedbackMessage = '';
        }, 3000); // Pesan gagal akan hilang setelah 3 detik
      }
    },
  },
  mounted() {
    this.startScanner();  // Otomatis memulai scanner saat komponen dimuat
  },
  beforeDestroy() {
    this.stopScanner();  // Menghentikan scanner saat komponen dihancurkan
  },
};
</script>
<style scoped>
@keyframes slideIn {
  from { opacity: 0; transform: translateY(-20px); }
  to { opacity: 1; transform: translateY(0); }
}

@keyframes slideOut {
  from { opacity: 1; transform: translateY(0); }
  to { opacity: 0; transform: translateY(-20px); }
}

.animate-slide-in {
  animation: slideIn 0.5s ease-out forwards;
}

.animate-slide-out {
  animation: slideOut 0.5s ease-in forwards;
}
</style>