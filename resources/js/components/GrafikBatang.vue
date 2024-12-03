<template>
  <div class="grid grid-cols-10 gap-1 md:gap-2 lg:gap-2 xl:gap-3 mt-5 h-fill">
    <!-- Grafik bar chart -->
    <div class="col-span-10 flex justify-center items-center">
      <canvas id="myChartBar" class="w-full h-auto"></canvas>
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
          <a class="font-inter text-9 xs:text-10 md:text-10 lg:text-11 xl:text-12 font-regular text-tbcolor1">0
            Karyawan</a>
        </div>
        <div class="flex flex-row items-center mb-4">
          <a class="font-inter text-9 xs:text-10 md:text-10 lg:text-11 xl:text-12 font-regular text-tbcolor1">0
            Karyawan</a>
        </div>
        <div class="flex flex-row items-center">
          <a class="font-inter text-9 xs:text-10 md:text-10 lg:text-11 xl:text-12 font-regular text-tbcolor1">0
            Karyawan</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Chart } from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels'; // Tambahkan plugin datalabels

Chart.register(ChartDataLabels); // Daftarkan plugin ke Chart.js

export default {
  data() {
    return {
      hadir: 0,       // Jumlah karyawan yang hadir
      izinAbsen: 0,   // Jumlah karyawan yang izin/sakit
      tidakHadir: 0,   // Jumlah karyawan yang tidak hadir
      attendanceData: {
        labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        datasets: [
          {
            label: 'Hadir',
            data: [800, 720, 780, 723, 623, 722, 724, 812, 810, 813, 826, 785], // Data jumlah kehadiran per bulan
            backgroundColor: "#2D6A4F",
            borderColor: "white",
            borderWidth: 1,
          },
          {
            label: 'Izin/Sakit',
            data: [13, 22, 44, 53, 65, 36, 34, 46, 33, 47, 45, 44], // Data jumlah izin/sakit per bulan
            backgroundColor: "#40916C",
            borderColor: "white",
            borderWidth: 1,
          },
          {
            label: 'Tidak Hadir',
            data: [12, 35, 23, 45, 25, 26, 17, 28, 29, 30, 18, 21], // Data jumlah tidak hadir per bulan
            backgroundColor: "#52B788",
            borderColor: "white",
            borderWidth: 1,
          }
        ],
      },
    };
  },

  mounted() {
    this.renderBarChart();
  },

  methods: {
    renderBarChart() {
      const ctx = document.getElementById("myChartBar").getContext("2d");
      if (ctx) {
        new Chart(ctx, {
          type: "bar",
          data: this.attendanceData,
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false, // Sembunyikan legenda
              },
              datalabels: {
                color: "#ffffff", // Warna teks
                font: {
                  family: "inter", // Jenis font
                  weight: "medium", // Tebal font (normal/bold)
                },
                anchor: "end",
                align: "top",
                formatter: (value, context) => {
                  const total = context.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                  if (total === 0) return "0%";
                  const percentage = ((value / total) * 100).toFixed(0); // Hitung persentase
                  return `${percentage}%`; // Tampilkan persentase
                },
              },
            },
            scales: {
              x: {
                beginAtZero: true,
                grid: {
                  display: false,
                },
                title: {
                  display: true,
                  text: "Bulan",
                },
              },
              y: {
                beginAtZero: true,
                ticks: {
                  stepSize: 10,
                },
                title: {
                  display: true,
                  text: "Jumlah Karyawan",
                },
              },
            },
          },
        });
      } else {
        console.error("Chart canvas tidak ditemukan");
      }
    },
  },
};
</script>
