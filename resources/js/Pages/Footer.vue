<script setup>
import { Link } from '@inertiajs/vue3';
import UseIcon from '@/Components/Custom/UseIcon.vue';
</script>

<template>
    <footer class="footer">
        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 items-center gap-5">
            <Link href="/" class="brand" aria-label="Test">Test</Link>

            <ul class="menu">
                <li class="item">
                    <Link class="" href="#">About</Link>
                </li>
                <li class="item">
                    <Link class="" href="#">Services</Link>
                </li>
                <li class="item">
                    <Link :href="route('icons')" class="" href="#">Icons</Link>
                </li>
                <li class="item">
                    <Link class="" href="#">Blog</Link>
                </li>
            </ul>
            <!-- End Col -->

            <!-- Social Brands -->
            <div class="socials">
                <Link href="/">
                    <UseIcon name="google" size="14" />
                </Link>
                <Link href="/">
                    <UseIcon name="twitter" size="14" />
                </Link>
                <Link href="/">
                    <UseIcon name="github" size="14" />
                </Link>
                <Link href="/">
                    <UseIcon name="slack" size="14" />
                </Link>
            </div>
            <!-- End Social Brands -->
        </div>
        <!-- End Grid -->

        <div class="copyright">
            <p>Copyright &copy; 2024. All rights reserved.</p>
        </div>
    </footer>
</template>
