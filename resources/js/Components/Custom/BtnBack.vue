<script setup>
import UseIcon from './UseIcon.vue';
</script>

<template>
    <button type="button" class="btn-back" onclick="history.back()">
        <UseIcon name="chevron-left" size="18" :wstroke="2" /> Back
    </button>
</template>
