<script setup>
import UseIcon from './UseIcon.vue';

defineProps({
  type: {
    type: String,
    default: 'button',
  },
  primary: {
    type: Boolean,
  },
  icon: {
    type: String,
  },
  iconSize: {
    type: Number,
    default: 18,
  },
});

defineEmits(['click']);
</script>

<template>
    <button :type="type" class="py-2 px-3 
        text-sm font-medium
        inline-flex items-center gap-x-1
        rounded-md
        focus:relative
        text-white
        border border-transparent
        bg-blue-600
        hover:bg-blue-700
        focus:outline-none
        focus:bg-blue-700
        disabled:opacity-50
        disabled:pointer-events-none" @click="$emit('click')">

        <UseIcon v-if="icon" :name="icon" :size="iconSize" :wstroke="2" /> <slot />
    </button>
</template>
