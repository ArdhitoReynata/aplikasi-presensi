import './bootstrap';
import { createApp } from 'vue';
import Vue3Datepicker from 'vue3-datepicker';

import Navbar from './components/Navbar.vue';
import SidebarAdmin from './components/SidebarAdmin.vue';
import SidebarKaryawan from './components/SidebarKaryawan.vue';
import GrafikHari from './components/GrafikHari.vue';
import GrafikMinggu from './components/GrafikMinggu.vue';
import GrafikBulan from './components/GrafikBulan.vue';
import InputBox from './components/InputBox.vue';
import SelectBox from './components/SelectBox.vue';
import Perizinan from './components/Perizinan.vue';
import QrScanner from './components/QrScanner.vue';
import DatePicker2 from './components/DatePicker2.vue';
import GrafikBatang from './components/GrafikBatang.vue';

const app = createApp({});
app.component('vue3-datepicker', Vue3Datepicker)

app.component('navbar', Navbar); 
app.component('sidebar', SidebarAdmin); 
app.component('sidebar2', SidebarKaryawan); 
app.component('grafik', GrafikHari);
app.component('grafik2', GrafikMinggu);
app.component('grafik3', GrafikBulan);
app.component('input-box', InputBox);
app.component('select-box', SelectBox);
app.component('perizinan', Perizinan);
app.component('kodeqr', QrScanner);
app.component('date2', DatePicker2);
app.component('grafik-batang', GrafikBatang)
app.mount("#app");