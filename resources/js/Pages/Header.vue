<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import UseIcon from '@/Components/Custom/UseIcon.vue';

var showingNavigationDropdown = ref(false);
</script>

<template>
    <header class="w-full mx-auto pt-8">
        <nav class="w-full mx-auto sm:flex sm:items-center sm:justify-between">
            <div class="flex items-center justify-between">
                <Link href="/" class="flex-none text-xl font-semibold focus:outline-none focus:opacity-80" aria-label="TestTask">TestTask</Link>

                <div class="sm:hidden">
                    <button
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-800 transition duration-150 ease-in-out border border-gray-200 hover:bg-white hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none dark:text-gray-500 dark:hover:bg-gray-900 dark:hover:text-gray-400 dark:focus:bg-gray-900 dark:focus:text-gray-400"
                    >
                        <UseIcon name="hamburger" size="24" :wstroke="2" class="h-6 w-6"
                            :class="{
                                hidden: showingNavigationDropdown,
                                'inline-flex': !showingNavigationDropdown,
                            }" />

                        <UseIcon name="x" size="24" :wstroke="2" class="h-6 w-6"
                            :class="{
                                hidden: !showingNavigationDropdown,
                                'inline-flex': showingNavigationDropdown,
                            }" />

                        <span class="sr-only">Toggle navigation</span>
                    </button>
                </div>
            </div>

            <div class="sm:hidden hs-collapse overflow-hidden transition-all duration-300 basis-full grow sm:block" aria-labelledby="hs-navbar-example-collapse"
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }">
                <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:justify-end sm:mt-0 sm:ps-5">
                    <slot name="navbar"></slot>
                </div>
            </div>
        </nav>

        <slot name="breadcrumbs"></slot>
    </header>
</template>
