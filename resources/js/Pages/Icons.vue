<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

import Header from './Header.vue';
import Footer from './Footer.vue';
import Breadcrumbs from '@/Components/Custom/Breadcrumbs.vue';
import NavBar from '@/Components/Custom/NavBar.vue';
import Card from '@/Components/Custom/Card.vue';
import BtnCheckList from '@/Components/Custom/BtnCheckList.vue';
import Btn from '@/Components/Custom/Btn.vue';
import BtnBack from '@/Components/Custom/BtnBack.vue';
import UseIcon from '@/Components/Custom/UseIcon.vue';

var strokeIcons = ref([
    'laravel',
    'house',
    'arrow-big-left-dash',
    'arrow-big-left',
    'arrow-right',
    'chevron-left',
    'chevron-right',
    'x',
    'plus',
    'circle-plus',
    'circle-alert',
    'eye-closed',
    'eye',
    'eye-off',
    'trash-2',
    'trash-3',
    'pencil',
    'file-pen-line',
    'file-check',
    'file-check-2',
    'save',
]);

var flatIcons = ref([
    'people-circle',
    'grid',
    'at',
    'house-1',
    'house-2',
    'diploma-verified',
    'heart',
    'backward',
    'forward',
    'dot',
    'dot-lg',
    'exclamation-circle-fill',
    'movie',
    'newspaper',
]);

</script>

<template>

    <Head title="Icons" />

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
            <section class="flex flex-row flex-wrap gap-2 py-6">
                <UseIcon v-for="icon of strokeIcons" :name="icon" size="48" :wstroke="2" color="#333" />
            </section>
            <section class="flex flex-row flex-wrap gap-2 py-6">
                <UseIcon v-for="icon of flatIcons" :name="icon" size="48" color="#333" />
            </section>
        </main>

        <Footer />
    </div>

</template>
