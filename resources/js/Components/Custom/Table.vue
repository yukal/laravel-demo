<script setup>
import { Link } from '@inertiajs/vue3';

var props = defineProps({
    total: {
        type: Number,
        required: true,
    },
    heading: {
        type: Array,
        // required: true,
    },
});

var isLast = (el, idx) => (idx+1 == el.length);
</script>

<template>
    <table class="min-w-full divide-y divide-gray-200">
        <thead v-if="heading" class="bg-gray-50">
            <tr>
                <template v-for="label, n of heading" :key="n">
                    <th v-if="isLast(heading, n)" scope="col" class="px-6 py-3 text-end">
                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">{{ label }}</span>
                    </th>
                    <th v-else scope="col" class="px-6 py-3 text-start">
                        <span class="text-xs font-semibold uppercase tracking-wide text-gray-800">{{ label }}</span>
                    </th>
                </template>
            </tr>
        </thead>

        <tbody v-if="(total > 0)" class="divide-y divide-gray-200">
            <slot name="rows"></slot>
        </tbody>

        <tbody v-else>
            <tr>
                <td colspan="3">
                    <span class="block p-5 text-center">There are no data yet</span>
                </td>
            </tr>
        </tbody>
    </table>
</template>
