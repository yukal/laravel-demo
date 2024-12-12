<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import UseIcon from '@/Components/Custom/UseIcon.vue';

var showingNavigationDropdown = ref(false);
</script>

<template>
    <header class="header">
        <nav class="navigation">
            <div class="brand-wrap">
                <Link href="/" class="brand" aria-label="TestTask">TestTask</Link>

                <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                    class="btn-toggle-menu"
                >
                    <UseIcon name="hamburger" size="24" :wstroke="2"
                        :class="{
                            hidden: showingNavigationDropdown,
                            'inline-flex': !showingNavigationDropdown,
                        }" />

                    <UseIcon name="x" size="24" :wstroke="2"
                        :class="{
                            hidden: !showingNavigationDropdown,
                            'inline-flex': showingNavigationDropdown,
                        }" />

                    <span class="sr-only">Toggle navigation</span>
                </button>
            </div>

            <div aria-labelledby="navbar-collapse"
                :class="{
                    block: showingNavigationDropdown,
                    hidden: !showingNavigationDropdown,
                }">
                <div class="menu">
                    <slot name="navbar"></slot>
                </div>
            </div>
        </nav>

        <slot name="breadcrumbs"></slot>
    </header>
</template>
