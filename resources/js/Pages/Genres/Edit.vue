<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import { inject } from 'vue';
import { updateGenre, canSubmit } from '@/api';

import Header from '../Header.vue';
import Footer from '../Footer.vue';
import Breadcrumbs from '@/Components/Custom/Breadcrumbs.vue';
import NavBar from '@/Components/Custom/NavBar.vue';
import Card from '@/Components/Custom/Card.vue';
import Btn from '@/Components/Custom/Btn.vue';
import BtnBack from '@/Components/Custom/BtnBack.vue';
import UseIcon from '@/Components/Custom/UseIcon.vue';

var route = inject('route');
var props = defineProps({
    genre: {
        type: Object,
        required: true,
    },
});

var form = useForm({
    name: props.genre.name,
});
</script>

<template>

    <Head title="Genre" />

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
                    { label: 'Genres', link: route('genres.index') },
                    { label: 'Edit', link: '' },
                ]" />
            </template>
        </Header>

        <main class="flex-grow w-full">
            <section class="container mx-auto max-w-screen-sm">
                <Card>

                    <template #headerTitle>
                        <h2 class="text-xl font-semibold text-gray-800">Edit Genre</h2>
                        <p class="text-sm text-gray-700 mt-1">ID: {{ genre.id }}</p>
                    </template>

                    <template #headerBody>
                        <BtnBack class="py-2 px-3 inline-flex items-center gap-x-1 text-sm font-medium rounded-md border border-transparent text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none" />
                    </template>

                    <template #content>
                        <form name="update-genre" class="p-10"
                            @submit.prevent="updateGenre(form, genre.id)">

                            <section :class="{'error': form.errors.name}">
                                <label for="form-input-update-genre" class="mb-2">
                                    New name <span class="badge">required</span>
                                </label>

                                <div class="relative">
                                    <input type="text" required id="form-input-update-genre" 
                                        v-model="form.name"
                                        aria-describedby="form-input-update-genre">

                                    <div v-if="form.errors.name" class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                        <UseIcon name="exclamation-circle-fill" size="16" color="#ef4444" />
                                    </div>
                                </div>
                            </section>

                            <p v-if="form.errors.name" class="text-sm text-red-600 mt-2">{{ form.errors.name }}.</p>

                            <div class="flex gap-x-1 mt-4">
                                <Btn type="submit" icon="save" :disabled="canSubmit(form)">Update</Btn>

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
