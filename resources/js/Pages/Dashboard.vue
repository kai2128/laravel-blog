<template>
  <app-layout title="Dashboard">
    <template #header>
      <Breadcrumbs :items="breadcrumbs"></Breadcrumbs>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          The welcome page
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Breadcrumbs from "@/Component/Breadcrumbs.vue";

const breadcrumbs = [
  {
    label: "Dashboard",
  },
];
</script>
