<script setup>
// const DEFAULT_SIZE = 16;

defineProps({
  name: String,
  color: {
    type: String,
    default: 'currentColor',
  },
  size: {
    // type: Number,
    default: 16,
  },
  w: {
    // type: Number,
    default: 0,
  },
  h: {
    default: 0,
  },
  wFract: {
    // type: Number,
    default: 0,
  },
  hFract: {
    // type: Number,
    default: 0,
  },
  wstroke: {
    type: Number,
    default: 0,
  },
  class: {
    type: String,
    default: '',
  },
});
</script>

<template>
    <template v-if="wstroke > 0">
        <svg :class="class" fill="none" :stroke="color" :stroke-width="wstroke" stroke-linecap="round" stroke-linejoin="round" :width="size" :height="size * hFract" v-if="hFract > 0">
            <use :href="`#svg-icon-${name}`"></use>
        </svg>

        <svg :class="class" fill="none" :stroke="color" :stroke-width="wstroke" stroke-linecap="round" stroke-linejoin="round" :width="size * wFract" :height="size" v-else-if="wFract > 0">
            <use :href="`#svg-icon-${name}`"></use>
        </svg>

        <svg :class="class" fill="none" :stroke="color" :stroke-width="wstroke" stroke-linecap="round" stroke-linejoin="round" :width="w" :height="h" v-else-if="w > 0 && h > 0">
            <use :href="`#svg-icon-${name}`"></use>
        </svg>

        <svg :class="class" fill="none" :stroke="color" :stroke-width="wstroke" stroke-linecap="round" stroke-linejoin="round" :width="size" :height="size" v-else>
            <use :href="`#svg-icon-${name}`"></use>
        </svg>
    </template>

    <template v-else>
        <svg :class="class" :fill="color" :width="size" :height="size * hFract" v-if="hFract > 0">
            <use :href="`#svg-icon-${name}`"></use>
        </svg>

        <svg :class="class" :fill="color" :width="size * wFract" :height="size" v-else-if="wFract > 0">
            <use :href="`#svg-icon-${name}`"></use>
        </svg>

        <svg :class="class" :fill="color" :width="w" :height="h" v-else-if="w > 0 && h > 0">
            <use :href="`#svg-icon-${name}`"></use>
        </svg>

        <svg :class="class" :fill="color" :width="size" :height="size" v-else>
            <use :href="`#svg-icon-${name}`"></use>
        </svg>
    </template>
</template>
