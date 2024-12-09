<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { inject } from 'vue';
import { updateMovie } from '@/api';

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
    movie: {
        type: Object,
        required: true,
    },
    genres: {
        type: Array,
        required: true,
    },
    statuses: {
        type: Array,
        required: true,
    },
});

var form = useForm({
    _method: 'PUT',

    name: props.movie.name,
    genres: props.movie.genresIDs,
    published: props.movie.published,
    poster: undefined,
});

function selectPoster(e) {
    form.poster = e.target.files.length 
        ? e.target.files[0] 
        : undefined;
}

function selectGenres(ev, selectedItems, item) {
    form.genres = selectedItems.length 
        ? selectedItems : props.movie.genresIDs
}
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
                    { label: 'Edit', link: '' },
                ]" />
            </template>
        </Header>

        <main class="flex-grow w-full">
            <section class="container mx-auto max-w-screen-sm">
                <Card>
                    <template #headerTitle>
                        <h2 class="text-xl font-semibold text-gray-800">Edit Movie <small>({{ movie.publishedText }})</small></h2>
                        <p class="text-sm text-gray-600 mt-1">ID: {{ movie.id }}</p>
                        <!-- <p class="text-sm text-gray-600 mt-1">Update movie.</p> -->
                    </template>

                    <template #headerBody>
                        <BtnBack class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none" />
                    </template>

                    <template #content>
                        <form @submit.prevent="updateMovie(form, movie.id)" 
                            class="flex flex-col justify-center gap-y-6 p-10">

                            <section :class="{ 'error': form.errors.name }">
                                <label for="form-input-name" class="text-lg font-bold text-blue-700 mb-3">
                                    Name <span class="badge">required</span>
                                </label>

                                <div class="relative">
                                    <input type="text" required id="form-input-name" aria-describedby="movie-name"
                                        v-model="form.name">

                                    <div v-if="form.errors.name"
                                        class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                        <UseIcon icon="exclamation-circle-fill" size="16" color="#ef4444" />
                                    </div>
                                </div>

                                <p v-if="form.errors.name" class="text-sm text-red-600 mt-2">{{ form.errors.name }}.</p>
                            </section>

                            <!-- Poster Upload -->
                            <section :class="{ 'error': form.errors.poster }">
                                <label for="form-input-poster" class="text-lg font-bold text-blue-700 mb-3">Poster</label>

                                <div class="relative">
                                    <input type="file" id="form-input-poster" @input="selectPoster($event)"
                                        class="block w-full border border-gray-300 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-3 file:px-4 focus:outline-blue-500">

                                    <div v-if="form.errors.poster"
                                        class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                        <UseIcon icon="exclamation-circle-fill" size="16" color="#ef4444" />
                                    </div>
                                </div>

                                <p v-if="form.errors.poster" class="text-sm text-red-600 mt-2">{{ form.errors.poster }}.</p>
                            </section>

                            <!-- Genres -->
                            <section :class="{ 'error': form.errors.genres }" class="mt-3">
                                <div class="relative">
                                    <label for="form-input-genres" class="text-lg font-bold text-blue-700 mb-4">
                                        Genre <span class="badge">required</span>
                                    </label>

                                    <div v-if="form.errors.genres"
                                        class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                        <UseIcon icon="exclamation-circle-fill" size="16" color="#ef4444" />
                                    </div>
                                </div>

                                <div class="inline-flex flex-wrap items-center gap-1">
                                    <BtnCheckList name="genres" :dictionary="genres" :selectedSet="movie.genresIDs"
                                        @select="selectGenres" />
                                </div>

                                <p v-if="form.errors.genres" class="text-sm text-red-600 mt-2">{{ form.errors.genres }}.</p>
                            </section>

                            <!-- Visibility: [puplished|hidden] -->
                            <section :class="{ 'error': form.errors.published }" class="mt-2">
                                <label for="form-input-published" class="text-lg font-bold text-blue-700 mb-5">Visibility</label>

                                <div class="grid space-y-3 relative">
                                    <div class="relative flex items-start">
                                        <div class="flex items-center h-5 mt-1">
                                            <input type="radio" name="published" id="form-radio-published"
                                                class="border-gray-200 rounded-full text-blue-600 focus:ring-blue-500"
                                                aria-describedby="form-radio-published-description"
                                                :checked="movie.published" :value="true"
                                                v-model="form.published">
                                        </div>

                                        <label for="form-radio-published" class="ms-3">
                                            <span class="block text-sm font-semibold text-gray-800">Published</span>
                                            <span id="form-radio-published-description" class="block text-sm text-gray-600">
                                                The attributes of this movie will be available for viewing by all users.
                                                You have to be sure if you filled all the properties properly before the publication.</span>
                                        </label>
                                    </div>

                                    <div class="relative flex items-start">
                                        <div class="flex items-center h-5 mt-1">
                                            <input type="radio" name="published" id="form-radio-hidden"
                                                class="border-gray-200 rounded-full text-blue-600 focus:ring-blue-500"
                                                aria-describedby="form-radio-hidden-description"
                                                :checked="!movie.published" :value="false"
                                                v-model="form.published">
                                        </div>

                                        <label for="form-radio-hidden" class="ms-3">
                                            <span class="block text-sm font-semibold text-gray-800">Hidden</span>
                                            <span id="form-radio-hidden-description" class="block text-sm text-gray-600">
                                                The attributes of this movie will be available for administrators only.
                                                You can carefully fill in the content first before publishing.</span>
                                        </label>
                                    </div>

                                    <div v-if="form.errors.published"
                                        class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                        <UseIcon icon="exclamation-circle-fill" size="16" color="#ef4444" />
                                    </div>
                                </div>

                                <p v-if="form.errors.published" class="text-sm text-red-600 mt-2">{{ form.errors.published }}.</p>
                            </section>

                            <!-- Progress -->
                            <section v-if="form.progress" class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden" role="progressbar" :aria-valuenow="form.progress.percentage" aria-valuemin="0" aria-valuemax="100">
                                {{ form.progress.percentage }}
                                <div class="flex flex-col justify-center rounded-full overflow-hidden bg-blue-600 text-xs text-white text-center whitespace-nowrap transition duration-500" 
                                    :style="`width: ${form.progress.percentage}%`"></div>
                            </section>
                            <!-- End Progress -->

                            <hr>

                            <div class="flex gap-x-1 mt-4">
                                <!-- <Btn type="submit" icon="plus" :disabled="canSubmit(form)">Update</Btn> -->
                                <Btn type="submit">Update</Btn>

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
