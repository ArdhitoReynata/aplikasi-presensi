import './bootstrap';
import { createApp } from 'vue';
import Vue3Datepicker from 'vue3-datepicker';

import Navbar from './components/Navbar.vue';
import Sidebar from './components/Sidebar.vue';
import Sidebar2 from './components/Sidebar2.vue';
import Grafik from './components/Grafik.vue';
import Grafik2 from './components/Grafik2.vue';
import Grafik3 from './components/Grafik3.vue';
import InputBox from './components/InputBox.vue';
import SelectBox from './components/SelectBox.vue';
import Perizinan from './components/Perizinan.vue';
import QrScanner from './components/QrScanner.vue';
import DatePicker2 from './components/DatePicker2.vue';
import GrafikBatang from './components/GrafikBatang.vue'

const app = createApp({});
app.component('vue3-datepicker', Vue3Datepicker)

app.component('navbar', Navbar); 
app.component('sidebar', Sidebar); 
app.component('sidebar2', Sidebar2); 
app.component('grafik', Grafik);
app.component('grafik2', Grafik2);
app.component('grafik3', Grafik3);
app.component('input-box', InputBox);
app.component('select-box', SelectBox);
app.component('perizinan', Perizinan);
app.component('kodeqr', QrScanner);
app.component('date2', DatePicker2);
app.component('grafik-batang', GrafikBatang)
app.mount("#app");