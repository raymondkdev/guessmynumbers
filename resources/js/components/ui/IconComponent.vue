<template>
    <span :class="`${clickable ? 'cursor-pointer' : ''}`">
       <i :class="`fa-${iconStyle} fa-${icon} fa-${size} mx-2 mt-1`"></i>
    </span>
</template>
<script>
export default {
    props: {
        icon: {
            type: String,
            required: true,
        },
        iconStyle: {
            type: String,
            default: 'solid',
        },
        size: {
            type: String,
            default: 'xl',
        },
        clickable: {
            type: Boolean,
            default: true,
        }
    }
}
</script>
