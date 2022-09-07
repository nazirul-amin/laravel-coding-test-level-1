<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
        <div class="relative flex justify-center min-h-screen bg-gray-100 items-top sm:items-center sm:pt-0">
            <slot />
        </div>
    </div>
</template>
