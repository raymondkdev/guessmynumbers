<template>
    <button
        class="w-24 h-10 text-center bg-gray-200 rounded-full cursor-pointer md:w-36 md:h-20 md:text-3xl hover:brightness-90"
    >
        {{ number }}
    </button>
</template>
<script>
export default {
    name: 'NumberPadNumber',
    props: {
        number: {
            type: Number,
            required: true,
        },
    },
}
</script>