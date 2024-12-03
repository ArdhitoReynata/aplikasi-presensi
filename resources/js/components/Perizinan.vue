<template>

  <body>
    <div class="flex justify-center items-center relative">

    </div>
    <div class="grid border bg-white border-strcolor rounded-md">
      <div class="grid grid-cols-6 gap-5 w-full place-items-center content-center p-5">
        <!-- Pesan feedback -->
        <div v-if="feedbackMessage" class="flex col-span-6 transform w-full"
          :class="{ 'animate-slide-in': feedbackMessage, 'animate-slide-out': !feedbackMessage }">
          <div
            :class="{ 'bg-gradient-to-r from-btncolor to-btncolor2': successMessage, 'bg-gradient-to-r from-dangercolor2 to-dangercolor': !successMessage }"
            class="flex w-full items-center text-white p-2 rounded-lg shadow-lg transform transition duration-300 ease-out">
            <!-- Ikon sukses atau gagal -->
            <div class="flex items-center justify-center w-5 h-5 bg-white rounded-full mr-2">
              <img v-if="successMessage" src="../../../public/images/check-green.svg" alt="Success Icon">
              <img v-else src="../../../public/images/error-red.svg" alt="Error Icon">
            </div>

            <!-- Teks pesan -->
            <p class="flex-grow font-inter text-xs sm:text-sm md:text-14 font-semibold">{{ feedbackMessage }}</p>

            <!-- Tombol close -->
            <button @click="feedbackMessage = ''" class="text-white focus:outline-none hover:text-gray-200">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
        <!-- Jenis Perizinan -->
        <div class="w-full col-span-6 font-inter font-medium text-12 md:text-13 lg:text-14">
          <p class="font-inter font-semibold text-12 md:text-13 lg:text-14">Jenis Perizinan</p>
          <select v-model="jenis_perizinan" class="border border-strcolor rounded-md w-full p-2 mt-1">
            <option value="Izin">Izin</option>
            <option value="Sakit">Sakit</option>
          </select>
        </div>

        <!-- Deskripsi Perizinan -->
        <div class="w-full col-span-6 font-inter font-medium text-12 md:text-13 lg:text-14">
          <p class="font-inter font-semibold text-12 md:text-13 lg:text-14">Deskripsi Perizinan</p>
          <textarea v-model="deskripsi" class="border border-strcolor rounded-md p-2 w-full pb-48 mt-1"
            placeholder="Deskripsi"></textarea>
        </div>

        <!-- Upload Bukti Pendukung -->
        <div class="w-full col-span-6 h-full font-inter text-12 md:text-13 lg:text-14">
          <p class="font-inter font-semibold text-12 md:text-13 lg:text-14">Upload Bukti Pendukung</p>

          <!-- Jika belum ada file yang dipilih, tampilkan box upload -->
          <div v-if="!file" class="flex items-center justify-center w-full mt-1">
            <label for="dropzone-file"
              class="flex flex-col items-center justify-center w-full h-[244px] md:h-[250px] lg:h-[256px] border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
              <div
                class="flex flex-col items-center justify-center p-5 text-tbcolor1 text-center text-10 md:text-11 lg:text-12">
                <img src="../../../public/images/upload.svg" alt="Upload Icon"
                  class="w-6 h-6 md:w-7 md:h-7 lg:w-8 lg:h-8 mb-2" />
                <p class="font-semibold">Letakkan File Anda Disini atau Jelajahi</p>
                <p class="text-blue-500 font-medium">Disarankan menggunakan format jpg, jpeg, png, pdf.</p>
              </div>
              <input id="dropzone-file" type="file" name="file" @change="handleFileUpload" class="hidden" />
            </label>
          </div>

          <div v-if="file" class="flex items-center justify-between w-full mt-1 text-black">
            <button class="hover-row hover:bg-bgcolor flex items-center justify-between w-full border border-gray-300 rounded-md p-1" @click="openFile">
              <div class="flex items-center gap-1">
                <div class="w-8 h-8 flex items-center justify-center rounded-md">
                  <img v-if="file.type.includes('pdf')" src="../../../public/images/pdf.png" alt="PDF Icon"
                    class="w-5 h-5">
                  <img v-else-if="file.type.includes('jpeg')" src="../../../public/images/jpeg.png" alt="JPEG Icon"
                    class="w-5 h-5">
                  <img v-else-if="file.type.includes('jpg')" src="../../../public/images/jpg.png" alt="JPG Icon"
                    class="w-5 h-5">
                  <img v-else-if="file.type.includes('png')" src="../../../public/images/png.png" alt="PNG Icon"
                    class="w-5 h-5">
                  <span v-else></span>
                </div>
                <p class="font-medium text-12 md:text-13 lg:text-14 truncate">{{ file.name }}</p>
              </div>
              <button @click="resetFile" class="transition-all transform duration-300 hover:scale-125">
                <img src="../../../public/images/error-red.svg" alt="Delete Icon" class="w-5 h-5">
              </button>
            </button>
          </div>
        </div>

        <!-- Tombol Submit -->
        <div class="w-full grid grid-cols-6 col-span-6 h-full font-inter font-medium text-12 md:text-13 lg:text-14">
          <button @click="submitIzin"
            class="col-end-7 md:col-end-7 col-span-2 md:col-span-1 bg-btncolor2 text-white w-full py-2 justify-center rounded-md hover:bg-btncolor transition-all duration-300 transform hover:scale-105">
            Buat
          </button>
        </div>
      </div>
    </div>
  </body>
</template>

<script>
import axios from 'axios';
import dayjs from 'dayjs';

export default {
  props: {
    user: Object
  },
  data() {
    return {
      tanggal_perizinan: dayjs().format('YYYY-MM-DD HH:mm:ss'),
      jenis_perizinan: '',
      deskripsi: '',
      file: null,
      qr_code_data: this.user?.nip || '', // QR Code data bisa diisi langsung
      feedbackMessage: '', // Pesan feedback
      successMessage: false, // Status pesan (sukses/gagal)
    };
  },
  
  methods: {
    handleFileUpload(event) {
      this.file = event.target.files[0];
      const allowedTypes = ['image/jpg', 'image/jpeg', 'image/png', 'application/pdf'];
      if (this.file && !allowedTypes.includes(this.file.type)) {
        this.setFeedbackMessage('Format file tidak valid!', false);
        this.file = null;
      }
    },
    resetFile() {
      this.file = null; // Reset file yang dipilih
    },
    openFile() {
      // Jika file adalah PDF
      if (this.file.type === "application/pdf") {
        const fileURL = URL.createObjectURL(this.file);
        window.open(fileURL, "_blank"); // Membuka PDF di tab baru
      }
      // Jika file adalah gambar (jpeg, jpg, png)
      else if (this.file.type.startsWith("image/")) {
        const fileURL = URL.createObjectURL(this.file);
        window.open(fileURL, "_blank"); // Membuka gambar di tab baru
      } else {
        alert("File tidak dapat dibuka secara langsung.");
      }
    },
    submitIzin() {
      window.scrollTo({
        top: 0,
        behavior: 'smooth', // Scroll dengan animasi
      });
      if (!this.jenis_perizinan || !this.deskripsi) {
        this.setFeedbackMessage('Semua data harus diisi!', false);
        return;
      }

      const formData = new FormData();
      formData.append('qr_code_data',  this.qr_code_data);
      formData.append('tanggal_perizinan', this.tanggal_perizinan);
      formData.append('status', this.jenis_perizinan);
      formData.append('keterangan', this.deskripsi);

      if (this.file) {
        formData.append('file', this.file);
      }

      axios.post('/presensi', formData)
        .then(response => {
          if (response.data.message === 'anda sudah melakukan presensi hari ini') {
            this.setFeedbackMessage(`Halo ${response.data.nama}, anda sudah melakukan perizinan hari ini!`, true);
          } else {
            this.setFeedbackMessage('Data berhasil disimpan!', true);
          }
        })
        .catch(error => {
          this.setFeedbackMessage('Gagal menyimpan data!', false);
        });
    },
    setFeedbackMessage(message, isSuccess) {
      this.feedbackMessage = message;
      this.successMessage = isSuccess;
      setTimeout(() => {
        this.feedbackMessage = '';
      }, 100000);
    },
  },
};
</script>