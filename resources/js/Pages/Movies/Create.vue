<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { inject } from 'vue';
import { createMovie, canSubmit } from '@/api';

import Header from '../Header.vue';
import Footer from '../Footer.vue';
import Breadcrumbs from '@/Components/Custom/Breadcrumbs.vue';
import NavBar from '@/Components/Custom/NavBar.vue';
import Card from '@/Components/Custom/Card.vue';
import BtnCheckList from '@/Components/Custom/BtnCheckList.vue';
import Btn from '@/Components/Custom/Btn.vue';
import BtnBack from '@/Components/Custom/BtnBack.vue';
import UseIcon from '@/Components/Custom/UseIcon.vue';

var route = inject('route');
var props = defineProps({
    genres: {
        type: Array,
        required: true,
    },
});

var form = useForm({
    name: null,
    genres: null,
    poster: undefined,
});

var selectPoster = ({ target }) => (
    form.poster = target.files.length 
        ? target.files[0] : undefined
);

var selectGenres = (ev, value, item) => (
    form.genres = value.length 
        ? value : null
);
</script>

<template>

    <Head title="Movie" />

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
                    { label: 'Movies', link: route('movies.index') },
                    { label: 'Create', link: '' },
                ]" />
            </template>
        </Header>

        <main class="flex-grow w-full">
            <section class="container mx-auto max-w-screen-sm">
                <Card>
                    <template #headerTitle>
                        <h2 class="text-xl font-semibold text-gray-800">Create Movie</h2>
                        <!-- <p class="text-sm text-gray-600 mt-1">Create new movie.</p> -->
                    </template>

                    <template #headerBody>
                        <BtnBack class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none" />
                    </template>

                    <template #content>
                        <form @submit.prevent="createMovie(form)" name="create-movie" class="flex flex-col justify-center gap-y-6 p-10">
                            <section :class="{ 'error': form.errors.name }">
                                <label for="form-input-create-movie" class="text-lg font-bold text-blue-700 mb-3">
                                    Name <span class="badge">required</span>
                                </label>

                                <div class="relative">
                                    <input type="text" required id="form-input-create-movie" v-model="form.name"
                                        aria-describedby="form-input-create-movie">
                                    <div v-if="form.errors.name"
                                        class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                        <UseIcon name="exclamation-circle-fill" size="16" color="#ef4444" />
                                    </div>
                                </div>

                                <p v-if="form.errors.name" class="text-sm text-red-600 mt-2">{{ form.errors.name }}.</p>
                            </section>

                            <!-- Poster Upload -->
                            <section :class="{ 'error': form.errors.poster }">
                                <label for="file-input" class="text-lg font-bold text-blue-700 mb-3">Poster</label>

                                <div class="relative">
                                    <input type="file" name="poster" id="file-input" @input="selectPoster($event)"
                                        class="block w-full border border-gray-300 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none
                                        file:bg-gray-50 file:border-0
                                        file:me-4
                                        file:py-3 file:px-4
                                        focus:outline-blue-500
                                    ">

                                    <div v-if="form.errors.poster"
                                        class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                        <UseIcon name="exclamation-circle-fill" size="16" color="#ef4444" />
                                    </div>
                                </div>

                                <p v-if="form.errors.poster" class="text-sm text-red-600 mt-2">{{ form.errors.poster }}.</p>
                            </section>

                            <!-- Genres -->
                            <section :class="{ 'error': form.errors.genres }" class="mt-3">
                                <label class="text-lg font-bold text-blue-700 mb-4">
                                    Genre <span class="badge">required</span>
                                </label>

                                <div class="inline-flex flex-wrap items-center gap-1">
                                    <BtnCheckList name="genres" :dictionary="genres" @select="selectGenres" />
                                </div>

                                <p v-if="form.errors.genres" class="text-sm text-red-600 mt-2">{{ form.errors.genres }}.</p>
                            </section>

                            <!-- Status: [puplished|hidden] -->

                            <!-- Progress -->
                            <section v-if="form.progress" class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden" role="progressbar" :aria-valuenow="form.progress.percentage" aria-valuemin="0" aria-valuemax="100">
                                {{ form.progress.percentage }}
                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition duration-500" 
                                    :style="`width: ${form.progress.percentage}%`"></div>
                            </section>
                            <!-- End Progress -->

                            <div class="flex gap-x-1 mt-4">
                                <Btn type="submit" icon="plus" :disabled="canSubmit(form)">Add</Btn>

                                <button type="button" onclick="history.back()"
                                    class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border-transparent focus:outline-none text-slate-600 hover:text-slate-800">
                                    <UseIcon name="x" size="14" :wstroke="2" /> Cancel
                                </button>
                            </div>
                        </form>
                    </template>
                </Card>
            </section>
        </main>

        <Footer />
    </div>
</template>
