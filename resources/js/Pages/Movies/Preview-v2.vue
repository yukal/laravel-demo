<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { inject } from 'vue';

import Header from '../Header.vue';
import Footer from '../Footer.vue';
import Pagination from '@/Components/Pagination.vue';
import Breadcrumbs from '@/Components/Custom/Breadcrumbs.vue';
import NavBar from '@/Components/Custom/NavBar.vue';
import BtnBack from '@/Components/Custom/BtnBack.vue';
import UseIcon from '@/Components/Custom/UseIcon.vue';

var route = inject('route');
var props = defineProps({
    movies: {
        type: Object,
        required: true,
    },
    statuses: {
        type: Object,
        required: true,
    },
    i: {
        type: Number,
        required: true,
    },
    success: String,
});
</script>

<template>

    <Head title="Preview" />

    <div class="flex flex-col flex-nowrap justify-between items-center gap-4 h-full px-4 sm:px-6 lg:px-8">
        <Header>
            <template #navbar>
                <NavBar :items="[
                    { label: 'Home', link: '/' },
                    { label: 'Genres', link: route('genres.index') },
                    { label: 'Movies', link: route('movies.index') },
                ]" />
            </template>

            <template #breadcrumbs>
                <Breadcrumbs :items="[
                    { label: 'Home', link: '/' },
                    { label: 'Preview', link: '' },
                ]" />
            </template>
        </Header>

        <main class="flex-grow w-full border-t border-b border-gray-200">
            <header class="max-w-[85rem] px-4 py-4 sm:px-6 mx-auto grid gap-3 md:flex md:justify-between md:items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Preview</h2>
                </div>

                <Pagination :pagination="movies" />

                <div class="inline-flex gap-x-2">
                    <BtnBack class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none" />

                    <Link :href="route('movies.create')" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <UseIcon name="plus" size="18" :wstroke="2" /> New</Link>
                </div>
            </header>

            <!-- Card Blog -->
            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:py-14 mx-auto">

                <!-- Grid -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-6">

                    <!-- Card -->
                    <Link v-for="(movie, n) of movies.data" :key="movies.data.id"
                            :href="route('movies.show', movie.id)"
                            class="group block rounded-md overflow-hidden focus:outline-none pb-4"
                        >
                        <div class="relative pt-[50%] sm:pt-[70%] overflow-hidden">
                            <img v-if="movie.poster" :src="`/storage/${movie.poster}`" :alt="movie.name" class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out">
                            <img v-else src="/storage/no-image-placeholder.svg" :alt="movie.name" class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out">
    
                            <span class="absolute top-0 end-0 rounded-es-md text-xs font-medium bg-gray-800 text-white py-1.5 px-3">Sponsored</span>
                        </div>
    
                        <div class="mt-4">
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600">{{ movie.name }}</h3>
                        </div>
                    </Link>
                    <!-- End Card -->
    
                </div>
                <!-- End Grid -->

            </div>
            <!-- End Card Blog -->

        </main>

        <Pagination :pagination="movies" />
        <Footer />
    </div>

</template>
