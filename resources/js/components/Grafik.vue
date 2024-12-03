<template>
  <div class="grid grid-cols-10 gap-1 md:gap-2 lg:gap-2 xl:gap-3 mt-5 h-fill">
    <!-- Grafik pie chart -->
    <div class="col-span-3 flex justify-center items-center">
      <canvas id="myChart" class="w-full h-auto"></canvas>
    </div>

    <!-- Label kehadiran dengan warna -->
    <div class="col-span-3 flex flex-col items-start justify-center">
      <div class="flex flex-row items-center justify-center mb-4">
        <div class="w-2 h-2 bg-btncolor rounded-sm mr-1"></div>
        <a class="font-inter text-9 xs:text-10 md:text-10 lg:text-11 xl:text-12 font-bold text-tbcolor">Hadir</a>
      </div>
      <div class="flex flex-row items-center justify-center mb-4">
        <div class="w-2 h-2 bg-btncolor2 rounded-sm mr-1"></div>
        <a class="font-inter text-9 xs:text-10 md:text-10 lg:text-11 xl:text-12 font-bold text-tbcolor">Izin/Sakit</a>
      </div>
      <div class="flex flex-row items-center justify-center">
        <div class="w-2 h-2 bg-btncolor3 rounded-sm mr-1"></div>
        <a class="font-inter text-9 xs:text-10 md:text-10 lg:text-11 xl:text-12 font-bold text-tbcolor">Tidak Hadir</a>
      </div>
    </div>

    <!-- Garis vertikal dan data jumlah karyawan -->
    <div class="col-span-4 flex flex-row items-center">
      <div class="border border-tbcolor rounded-sm h-[80px] md:h-[80px] lg:h-[80px] xl:h-[90px]"></div>
      <!-- Garis vertikal -->
      <div class="flex flex-col justify-center ml-4">
        <div class="flex flex-row items-center mb-4">
          <a class="font-inter text-9 xs:text-10 md:text-10 lg:text-11 xl:text-12 font-regular text-tbcolor1">{{ hadir
            }} Karyawan</a>
        </div>
        <div class="flex flex-row items-center mb-4">
          <a class="font-inter text-9 xs:text-10 md:text-10 lg:text-11 xl:text-12 font-regular text-tbcolor1">{{
            izinAbsen }} Karyawan</a>
        </div>
        <div class="flex flex-row items-center">
          <a class="font-inter text-9 xs:text-10 md:text-10 lg:text-11 xl:text-12 font-regular text-tbcolor1">{{
            tidakHadir }} Karyawan</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Chart } from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels'; // Tambahkan plugin datalabels
import axios from 'axios';

Chart.register(ChartDataLabels); // Daftarkan plugin ke Chart.js

export default {
  data() {
    return {
      hadir: 0,
      izinAbsen: 0,
      tidakHadir: 0,
      totalKaryawan: 0,
      attendanceData: [],
    };
  },
  mounted() {
    this.fetchPresensiData();
  },

  methods: {
    async fetchPresensiData() {
      try {
        const response = await axios.get('/presensi-data');
        const data = response.data;

        if (data && data.length === 3) {
          this.attendanceData = {
            labels: data.map(item => item.status), // Status: Hadir, Izin/Sakit, Tidak Hadir
            datasets: [
              {
                data: data.map(item => item.count), // Jumlah
                backgroundColor: ['#2D6A4F', '#40916C', '#52B788'], // Warna
                borderColor: 'white',
                borderWidth: 0.5,
              },
            ],
          };

          this.hadir = data[0].count;
          this.izinAbsen = data[1].count;
          this.tidakHadir = data[2].count;

          this.renderChart();
        } else {
          console.error('Data tidak sesuai');
        }
      } catch (error) {
        console.error('Error fetching presensi data:', error);
      }
    },
    renderChart() {
      const ctx = document.getElementById('myChart').getContext('2d');
      if (ctx) {
        new Chart(ctx, {
          type: 'pie',
          data: this.attendanceData,
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false, // Sembunyikan legenda
              },
              datalabels: {
                color: '#ffffff', // Warna teks persentase
                font: {
                  family: 'inter', // Jenis font
                  weight: 'medium', // Tebal font (normal/bold)
                },
                formatter: (value, context) => {
                  const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                  const percentage = ((value / total) * 100).toFixed(0); // Hitung persentase
                  return `${percentage}%`; // Tampilkan persentase
                },
              },
            },
          },
        });
      } else {
        console.error('Chart canvas tidak ditemukan');
      }
    }
  },
};
</script>
