<template>
  <div class="w-full flex item-center justify-between">
    <Button
      :disabled="!prevUrl"
      @click="$inertia.visit(prevUrl)"
      :class="{ 'opacity-50 cursor-default': !prevUrl }"
    >
      Previous</Button
    >
    <Button
      :disabled="!nextUrl"
      @click="$inertia.visit(nextUrl)"
      :class="{ 'opacity-50 cursor-default': !nextUrl }"
      >Next</Button
    >
  </div>
</template>
<script setup>
import Button from "@/Jetstream/Button.vue";
defineProps(["prevUrl", "nextUrl"]);
</script>
