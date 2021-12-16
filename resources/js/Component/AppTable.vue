<template>
  <table class="w-full">
    <thead class="text-left">
      <tr>
        <th v-for="(header, i) in headers" :key="i" :class="header.class">
          {{ header.label }}
        </th>
      </tr>
    </thead>
    <tbody>
      <slot></slot>

      <tr v-if="items.data.length === 0">
        <td :colspan="headers.length" class="p-4">No data available</td>
      </tr>
    </tbody>
  </table>
  <div v-if="items.data.length > 0" class="mt-4">
    <div class="flex item-center justify-between" v-if="items.data.length > 0">
      <SimplePagination
        :prev-url="items.links.prev"
        :next-url="items.links.next"
      ></SimplePagination>
    </div>
  </div>
</template>

<script setup>
import SimplePagination from "./SimplePagination.vue";

defineProps({
  headers: {
    type: Array,
    required: true,
  },
  items: {
    type: Object,
    required: true,
  },
});
</script>
