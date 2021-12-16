<template>
    <app-layout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Settings</h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <UpdateHeroData :settings="settings"></UpdateHeroData>
            </div>
        </div>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <UpdateAboutData :settings="settings"></UpdateAboutData>
            </div>
        </div>

         <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <UpdateContactData :settings="settings"></UpdateContactData>
            </div>
        </div>
    </app-layout>
</template>





<script setup>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import UpdateHeroData from './UpdateHeroData.vue';
import UpdateAboutData from './UpdateAboutData.vue';
import UpdateContactData from './UpdateContactData.vue';

defineProps(['sessions', 'settings']);
</script>
