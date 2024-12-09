<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { inject } from 'vue';
import { destroyGenre } from '@/api';

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
    genres: {
        type: Object,
        required: true,
    },
    i: {
        type: Number,
        required: true,
    },
});
</script>

<template>

    <Head title="Genres" />

    <div class="flex flex-col flex-nowrap justify-between items-center gap-4 h-full px-4 sm:px-6 lg:px-8">
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
                    { label: 'Genres', link: '' },
                ]" />
            </template>
        </Header>

        <main class="flex-grow w-full">
            <Card>
                <template #headerTitle>
                    <h2 class="text-xl font-semibold text-gray-800">Genres</h2>
                    <p class="text-sm text-gray-600 mt-1">Create new, edit, or remove.</p>
                </template>

                <template #headerBody>
                    <BtnBack class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none" />
                    <Link :href="route('genres.create')" class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <UseIcon name="plus" size="18" :wstroke="2" /> New</Link>
                </template>

                <template #content>
                    <Table :total="genres.total" :heading="['No', 'ID', 'Genre', 'Action']">
                        <template #rows>
                            <tr v-for="genre, n of genres.data" :key="genres.data.id" class="bg-white hover:bg-gray-50">
                                <td class="size-px whitespace-nowrap">
                                    <span class="block px-6 py-2 font-mono text-slate-600 text-sm">{{ i+n+1 }}</span>
                                </td>

                                <td class="size-px whitespace-nowrap">
                                    <span class="block px-6 py-2 font-mono text-blue-600 text-sm">{{ genre.id }}</span>
                                </td>

                                <td class="size-px whitespace-nowrap">
                                    <Link :href="route('genres.show', genre.id)"
                                        class="block px-6 py-2 text-blue-600">{{ genre.name }}</Link>
                                </td>

                                <td class="size-px whitespace-nowrap text-right">
                                    <div class="block px-6 text-slate-600">
                                        <Link :href="route('genres.edit', genre.id)" class="text-slate-600 hover:text-black py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border-transparent focus:outline-none">
                                            <UseIcon name="pencil" size="16" :wstroke="1.6" /> Edit</Link>

                                        <button type="button" @click="destroyGenre(genre.id)"
                                            class="text-slate-600 hover:text-black py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border-transparent focus:outline-none pe-0">
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
                            <span class="font-semibold text-gray-800">{{ genres.total }}</span> results
                        </p>
                    </div>

                    <div>
                        <div class="inline-flex gap-x-2">
                            <Pagination :pagination="genres" />
                        </div>
                    </div>
                </template>
            </Card>
        </main>

        <Footer />
    </div>
</template>
