<template>
    <button :type="type"
        class="inline-flex items-center text-white font-bold bg-gradient-to-r from-primary via-secondary to-option1 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
        <CursorArrowRippleIcon class="h-6 w-6 text-white" />
        <slot />
    </button>
</template>

<script setup>
import { CursorArrowRippleIcon } from '@heroicons/vue/24/solid'

defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>
