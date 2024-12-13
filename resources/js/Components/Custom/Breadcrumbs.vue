<script setup>
import { Link } from '@inertiajs/vue3';

import UseIcon from '@/Components/Custom/UseIcon.vue';

var props = defineProps({
    items: {
        type: Array,
        required: true,
    },
});

var hasLink = (item) => (item.hasOwnProperty('link') && item.link !== '');
var isLast = (idx) => (idx+1 == props.items.length);
</script>

<template>
    <ol class="flex items-center whitespace-nowrap mt-5 text-sm">
        <template v-for="item, idx of props.items" :key="item.label">

            <template v-if="!isLast(idx)">
                <li class="inline-flex items-center">
                    <Link v-if="hasLink(item)" :href="item.link" class="text-gray-500 hover:text-blue-500 focus:outline-none focus:text-blue-600">{{ item.label }}</Link>
                    <a v-else>{{ item.label }}</a>
                </li>
                <li class="inline-flex items-center mx-1">
                    <UseIcon name="chevron-right" size="17" :wstroke="2" color="#9ca3af" />
                </li>
            </template>

            <template v-else>
                <li class="inline-flex items-center">
                    <span class="flex items-center text-gray-500">{{ item.label }}</span>
                </li>
            </template>

        </template>
    </ol>
</template>
