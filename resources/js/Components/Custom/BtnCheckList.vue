<script setup>
import { ref, computed } from 'vue';

var props = defineProps({
  name: {
    type: String,
    default: '',
  },
  dictionary: {
    type: Array,
    required: true,
  },
  selectedSet: {
    type: Array,
    default: [],
  },
});

var emit = defineEmits(['select']);

var selectedItems = ref(new Set(props.selectedSet));
var value = computed(() => [...selectedItems.value.values()]);

var mappedDictionary = computed(() => new Map (
    props.dictionary.map(({ id, name }) => ([
        id, 
        {
            name,
            checked: selectedItems.value.has(id),
        }
    ]))
));

function select(ev, selectedItem) {
  var mappedItem = mappedDictionary.value.get(selectedItem.id);
  // item.checked = !item.checked;

  (mappedItem.checked = !mappedItem.checked)
    ? selectedItems.value.add(selectedItem.id)
    : selectedItems.value.delete(selectedItem.id);

  emit('select', ev, value.value, {
    ...selectedItem,
    checked: mappedItem.checked,
  });
}
</script>

<template>
  <button type="button" class="btn-check" v-for="item in dictionary" :key="item.id"
      :class="{ 'checked': selectedItems.has(item.id) }"
      @click="select($event, item)">{{ item.name }}</button>

  <input type="hidden" v-if="name" :name="name" :value="value" 
      :disabled="selectedItems.size == 0" />
</template>
