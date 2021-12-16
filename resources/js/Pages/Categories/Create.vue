<template>
  <app-layout>
    <template #header>
      <Breadcrumbs :items="breadcrumbs"></Breadcrumbs>
    </template>

    <Container>
      <Card>
        <form class="space-y-4" @submit.prevent="submitHandler">
          <!-- Name -->
          <div>
            <jet-label for="name" value="Name" />
            <jet-input
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
              autocomplete="name"
            />
            <jet-input-error :message="form.errors.name" class="mt-2" />
          </div>

          <!-- Name -->
          <div>
            <jet-label for="slug" value="Slug" />
            <jet-input
              id="slug"
              type="text"
              class="mt-1 block w-full"
              v-model="form.slug"
              autocomplete="name"
            />
            <jet-input-error :message="form.errors.slug" class="mt-2" />
          </div>

          <div>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3"
              >Saved.</jet-action-message
            >
            <jet-button
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              {{ edit ? "Update" : "Save" }}
            </jet-button>
          </div>
        </form>
      </Card>
    </Container>
  </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";

import { useForm } from "@inertiajs/inertia-vue3";
import { watch } from "@vue/runtime-core";
import { strSlug } from "@/helper.js";
import Container from "../../Component/Container.vue";
import Card from "../../Component/Card.vue";
import Breadcrumbs from "../../Component/Breadcrumbs.vue";
import route from "../../../../vendor/tightenco/ziggy/src/js";

const props = defineProps({
  edit: Boolean,
  category: Object,
});

const form = useForm({
  name: "",
  slug: "",
});

if (props.edit) {
  form.name = props.category.data.name;
  form.slug = props.category.data.slug;
}

const submitHandler = () => {
  props.edit
    ? form.put(route("categories.update", { id: props.category.data.id }))
    : form.post(route("categories.store"));
};

const breadcrumbs = [
  {
    label: "Categories",
    url: route("categories.index"),
  },
  {
    label: props.edit ? "Edit Category" : "Add Category",
  },
];

watch(
  () => form.name,
  (newName) => {
    form.slug = strSlug(newName);
  }
);
</script>
