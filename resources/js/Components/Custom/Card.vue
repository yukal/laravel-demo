<script setup>
</script>

<template>
    <section class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <!-- Header -->
        <header class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
            <div>
                <slot name="headerTitle">
                    <h2 class="text-xl font-semibold text-gray-800">Header</h2>
                    <!-- <p class="text-sm text-gray-600">Create invoices, edit, download and more.</p> -->
                </slot>
            </div>

            <div>
                <div class="inline-flex gap-x-2">
                    <slot name="headerBody" />
                </div>
            </div>
        </header>
        <!-- End Header -->

        <main>
            <slot name="content"></slot>
        </main>

        <footer v-if="$slots.footer" class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200">
            <slot name="footer"></slot>
        </footer>
    </section>
</template>
