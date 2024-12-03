<template>
  <input :type="type" :placeholder="placeholder" :value="value" @input="$emit('input', $event.target.value)" required
    class="border border-strcolor rounded-md w-full h-8 md:h-9 lg:h-10 p-2 mt-1"
    @focus="scrollToInput" />
</template>

<script>
export default {
  props: ['type', 'placeholder', 'value'], // Terima props type, placeholder, dan value (untuk v-model)
  methods: {
    scrollToInput() {
      // Fungsi saat fokus pada input jika diperlukan
    },
  },
};
</script>
