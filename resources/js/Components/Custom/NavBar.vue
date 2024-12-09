<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <template v-for="item, idx of props.items" :key="item.label">
        <Link v-if="item.active" :href="item.link" aria-current="page"
            class="font-medium text-blue-500 focus:outline-none">{{ item.label }}</Link>

        <Link v-else :href="item.link"
            class="font-medium text-gray-600 hover:text-gray-400 focus:outline-none focus:text-gray-400">{{ item.label }}</Link>
    </template>
</template>
