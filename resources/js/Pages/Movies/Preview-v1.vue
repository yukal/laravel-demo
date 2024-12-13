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

    <div class="flex-container">
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

                <div class="inline-flex gap-x-2">
                    <BtnBack />

                    <Link :href="route('movies.create')" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <UseIcon name="plus" size="18" :wstroke="2" /> New</Link>
                </div>
            </header>

            <!-- Card Blog -->
            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:py-14 mx-auto">

                <!-- Grid -->
                <div class="grid lg:grid-cols-2 lg:gap-y-16 gap-10">

                    <!-- Card -->
                    <Link v-for="(movie, n) of movies.data" :key="movies.data.id"
                        :href="route('movies.show', movie.id)"
                        class="group block rounded-xl overflow-hidden focus:outline-none"
                    >
                        <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-5">
                            <div class="shrink-0 relative rounded-xl overflow-hidden w-full sm:w-56 h-44">
                                <img v-if="movie.poster" :src="`/storage/${movie.poster}`" :alt="movie.name" class="group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover rounded-xl">
                                <img v-else src="/storage/no-image-placeholder.svg" :alt="movie.name" class="group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover rounded-xl">
                            </div>
                            <div class="grow">
                            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600">{{ movie.name }}</h3>
                            <p class="mt-3 text-gray-600">
                                Produce professional, reliable streams easily leveraging Preline's innovative broadcast studio
                            </p>
                            <p class="mt-4 inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 group-hover:underline group-focus:underline font-medium">
                                Read more
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                            </p>
                            </div>
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
