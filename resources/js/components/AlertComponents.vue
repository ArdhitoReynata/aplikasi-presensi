<template>
    <div class=" font-inter font-medium fixed top-0 left-0 right-0 text-white py-2 px-4 rounded-b z-50" :class="{
        'bg-btncolor2': type === 'success',
        'bg-dangercolor': type === 'error'
    }">
        {{ message }}
    </div>
</template>

<script>
export default {
    props: {
        type: {
            type: String,
            required: true,
        },
        message: {
            type: String,
            required: true,
        },
    },
}
</script>