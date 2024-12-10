<script setup>
import { Link } from '@inertiajs/vue3';
import UseIcon from '@/Components/Custom/UseIcon.vue';
</script>

<template>
    <footer class="mt-auto w-full py-10 px-4 mx-auto">
        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-5">
            <div>
                <a class="flex-none text-xl font-semibold text-black focus:outline-none" href="#" aria-label="Test">Test</a>
            </div>
            <!-- End Col -->

            <ul class="text-center">
                <li class="inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:content-['/'] before:text-gray-300">
                    <a class="inline-flex gap-x-2 text-sm text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800" href="#">
                    About
                    </a>
                </li>
                <li class="inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:content-['/'] before:text-gray-300">
                    <a class="inline-flex gap-x-2 text-sm text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800" href="#">
                    Services
                    </a>
                </li>
                <li class="inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:content-['/'] before:text-gray-300">
                    <Link :href="route('icons')" class="inline-flex gap-x-2 text-sm text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800" href="#">Icons</Link>
                </li>
                <li class="inline-block relative pe-8 last:pe-0 last-of-type:before:hidden before:absolute before:top-1/2 before:end-3 before:-translate-y-1/2 before:content-['/'] before:text-gray-300">
                    <a class="inline-flex gap-x-2 text-sm text-gray-500 hover:text-gray-800 focus:outline-none focus:text-gray-800" href="#">
                    Blog
                    </a>
                </li>
            </ul>
            <!-- End Col -->

            <!-- Social Brands -->
            <div class="md:text-end space-x-2">
                <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" href="#">
                    <UseIcon name="google" size="14" />
                </a>
                <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" href="#">
                    <UseIcon name="twitter" size="14" />
                </a>
                <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" href="#">
                    <UseIcon name="github" size="14" />
                </a>
                <a class="size-8 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-500 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" href="#">
                    <UseIcon name="slack" size="14" />
                </a>
            </div>
            <!-- End Social Brands -->
        </div>
        <!-- End Grid -->

        <div class="sm:flex sm:items-center sm:justify-center mt-5">
            <div class="flex justify-center text-teal-600 sm:justify-start"></div>
            <p class="mt-4 text-center text-sm text-gray-500 lg:mt-0 lg:text-right">
                Copyright &copy; 2024. All rights reserved.
            </p>
        </div>
    </footer>
</template>
