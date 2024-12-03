<template>
  <div>
    <Datepicker 
      v-model="tanggal_perizinan"
      :value="formattedSelectedDate"
      id="date-filter"
      class="flex border border-strcolor items-center rounded-lg w-full h-[28px]"
      @input="onDateSelected"
    />
  </div>
</template>

<script>
import Datepicker from 'vue3-datepicker';
import dayjs from 'dayjs';
import 'dayjs/locale/id';

dayjs.locale('id');

export default {
  components: { Datepicker },
  data() {
    return {
      selectedDate: null,
    };
  },
  computed: {
    formattedSelectedDate() {
      return this.selectedDate
        ? dayjs(this.selectedDate).format('DD MMMM YYYY')
        : 'Pilih Tanggal';
    },
  },
  methods: {
    onDateSelected() {
      // Emit event dengan tanggal yang dipilih dalam format 'DD/MM/YYYY'
      this.$emit('selected-date', dayjs(this.selectedDate).format('DD/MM/YYYY'));
    },
  },
};
</script>
