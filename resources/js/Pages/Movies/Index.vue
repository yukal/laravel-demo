<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { inject } from 'vue';
import { setMoviePublicity, destroyMovie } from '@/api';

import Header from '../Header.vue';
import Footer from '../Footer.vue';
import Pagination from '@/Components/Pagination.vue';
import Breadcrumbs from '@/Components/Custom/Breadcrumbs.vue';
import NavBar from '@/Components/Custom/NavBar.vue';
import Card from '@/Components/Custom/Card.vue';
import Table from '@/Components/Custom/Table.vue';
// import Btn from '@/Components/Custom/Btn.vue';
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

    <Head title="Movies" />

    <div class="flex flex-col flex-nowrap justify-between items-center gap-4 h-full px-4 sm:px-6 lg:px-8">
        <Header>
            <template #navbar>
                <NavBar :items="[
                    { label: 'Home', link: '/' },
                    { label: 'Genres', link: route('genres.index') },
                    { label: 'Movies', link: route('movies.index'), active: true },
                ]" />
            </template>

            <template #breadcrumbs>
                <Breadcrumbs :items="[
                    { label: 'Home', link: '/' },
                    { label: 'Movies', link: '' },
                ]" />
            </template>
        </Header>

        <main class="flex-grow w-full">
            <div v-if="success">{{ success }}</div>

            <Card>
                <template #headerTitle>
                    <h2 class="text-xl font-semibold text-gray-800">Movies</h2>
                    <p class="text-sm text-gray-600 mt-1">Create new, edit, publish, or remove.</p>
                </template>

                <template #headerBody>
                    <BtnBack class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none" />
                    <!-- <Link v-if="route().current('movies.unpublished')" :href="route('movies.index')" 
                        class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Unpublished</Link>
                    <Link v-else :href="route('movies.unpublished')" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">Unpublished</Link> -->
                    <Link :href="route('movies.create')" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <UseIcon name="plus" size="18" :wstroke="2" /> New</Link>
                </template>

                <template #content>
                    <Table :total="movies.total" :heading="['No', 'ID', 'Movie', 'Publicity', 'Action']">
                        <template #rows>
                            <tr v-for="(movie, n) of movies.data" :key="movies.data.id" class="bg-white hover:bg-gray-50">
                                <td class="size-px whitespace-nowrap">
                                    <span class="block px-6 py-2 font-mono text-slate-600 text-sm">{{ i+n+1 }}</span>
                                </td>

                                <td class="size-px whitespace-nowrap">
                                    <span class="block px-6 py-2 font-mono text-blue-600 text-sm">{{ movie.id }}</span>
                                </td>

                                <td class="size-px whitespace-nowrap">
                                    <Link :href="route('movies.show', movie.id)"
                                        class="block px-6 py-2 text-blue-600">{{ movie.name }}</Link>
                                </td>

                                <td class="size-px whitespace-nowrap">
                                    <div class="block px-6 text-slate-600 text-sm">
                                        <UseIcon v-if="movie.published" name="eye" size="16" :wstroke="1.6" color="#333" />
                                        <UseIcon v-else name="eye-closed" size="16" :wstroke="1.6" color="#333" />
                                    </div>
                                </td>

                                <td class="size-px whitespace-nowrap text-right">
                                    <div class="block px-6 text-slate-600">
                                        <button type="button" v-if="!movie.published" @click="setMoviePublicity(movie.id, true)"
                                            class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border-transparent focus:outline-none text-slate-600 hover:text-black">publish</button>

                                        <button type="button" v-else @click="setMoviePublicity(movie.id, false)"
                                            class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border-transparent focus:outline-none text-slate-600 hover:text-black">hide</button>

                                        <Link :href="route('movies.edit', movie.id)" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border-transparent focus:outline-none text-slate-600 hover:text-black">
                                            <UseIcon name="pencil" size="16" :wstroke="1.6" /> Edit</Link>

                                        <button type="button" @click="destroyMovie(movie.id)"
                                            class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border-transparent focus:outline-none text-slate-600 hover:text-black pe-0">
                                            <UseIcon name="trash-2" size="16" :wstroke="1.6" /> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </Table>
                </template>

                <template #footer>
                    <div>
                        <p class="text-sm text-gray-600">
                            <span class="font-semibold text-gray-800">{{ movies.total }}</span> results
                        </p>
                    </div>

                    <div>
                        <div class="inline-flex gap-x-2">
                            <Pagination :pagination="movies" />
                        </div>
                    </div>
                </template>
            </Card>
        </main>

        <Footer />
    </div>
</template>
