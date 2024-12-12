<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { destroyMovie } from '@/api';

import Header from '../Header.vue';
import Footer from '../Footer.vue';
import Breadcrumbs from '@/Components/Custom/Breadcrumbs.vue';
import NavBar from '@/Components/Custom/NavBar.vue';
import Card from '@/Components/Custom/Card.vue';
import Table from '@/Components/Custom/Table.vue';
// import Btn from '@/Components/Custom/Btn.vue';
import BtnBack from '@/Components/Custom/BtnBack.vue';
import UseIcon from '@/Components/Custom/UseIcon.vue';

var props = defineProps({
    genre: {
        type: Object,
        required: true,
    },
    movies: {
        type: Array,
        required: true,
    },
});
</script>

<template>

    <Head title="Genre" />

    <div class="flex-container">
        <Header>
            <template #navbar>
                <NavBar :items="[
                    { label: 'Home', link: '/' },
                    { label: 'Genres', link: route('genres.index'), active: true },
                    { label: 'Movies', link: route('movies.index') },
                ]" />
            </template>

            <template #breadcrumbs>
                <Breadcrumbs :items="[
                    { label: 'Home', link: '/' },
                    { label: 'Genres', link: route('genres.index') },
                    { label: genre.name, link: '' },
                ]" />
            </template>
        </Header>

        <main class="flex-grow w-full">
            <Card>
                <template #headerTitle>
                    <h2 class="text-xl font-semibold text-gray-800">Genre: {{ genre.name }}</h2>
                    <p class="text-sm text-gray-600 mt-1">ID: {{ genre.id }}</p>
                </template>

                <template #headerBody>
                    <BtnBack class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none" />
                    <Link :href="route('genres.create')" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <UseIcon name="plus" size="18" :wstroke="2" /> New</Link>
                </template>

                <template #content>
                    <Table :total="movies.length" :heading="['ID', 'Movie', 'Action']">
                        <template #rows>
                            <tr v-for="movie, n of movies" :key="movie.id" :id="`row-movie-${movie.id}`" class="bg-white hover:bg-gray-50">
                                <td class="size-px whitespace-nowrap">
                                    <span class="block px-6 py-2 font-mono text-blue-600 text-sm">{{ movie.id }}</span>
                                </td>

                                <td class="size-px whitespace-nowrap">
                                    <Link :href="route('movies.show', movie.id)"
                                        class="block px-6 py-2 text-blue-600">{{ movie.name }}</Link>
                                </td>

                                <td class="size-px whitespace-nowrap text-right">
                                    <div class="block px-6 text-slate-600">
                                        <Link :href="route('movies.edit', movie.id)" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border-transparent focus:outline-none text-slate-600 hover:text-black">
                                            <UseIcon name="pencil" size="16" :wstroke="1.6" /> Edit</Link>

                                        <button type="button" @click="destroyMovie(movie.id)"
                                            class="text-slate-600 hover:text-black py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border-transparent focus:outline-none pe-0">
                                            <UseIcon name="trash-2" size="16" :wstroke="1.6" /> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </Table>
                </template>

                <!-- <template #footer></template> -->
            </Card>
        </main>

        <Footer />
    </div>

</template>
