<template>
  <button @click.prevent="buttonHandler" v-html="getIcon()"></button>

  <ConfirmationModal :show="show">
    <template #title> Delete {{ moduleName }} </template>

    <template #content> Are you sure to delete this {{ moduleName }} </template>

    <template #footer>
      <Button @click.prevent="show = false">No</Button>
      <Button
        class="ml-2"
        @click.native="deleteItem"
        :disable="form.processing"
        :class="{ 'opacity-25': form.processing }"
        >Yes</Button
      >
    </template>
  </ConfirmationModal>
</template>
<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import Button from "@/Jetstream/Button.vue";
import ConfirmationModal from "@/Jetstream/ConfirmationModal.vue";
import { ref } from "@vue/reactivity";
import { Inertia } from "@inertiajs/inertia";
const props = defineProps({
  type: {
    required: true,
    type: String,
  },
  url: {
    required: true,
    type: String,
  },
  moduleName: {
    required: false,
    type: String,
  },
});

const show = ref(false);

const form = useForm({});

const buttonHandler = () => {
  props.type.toLowerCase() == "delete" ? (show.value = true) : Inertia.get(props.url);
};

const deleteItem = () => {
  form.delete(props.url);
};

const icons = {
  edit: {
    svg: `<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>`,
  },
  delete: {
    svg: `<svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>`,
  },
};

const getIcon = () => icons[props.type.toLowerCase()]?.svg;
</script>
