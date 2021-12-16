<template>
  <app-layout>
    <template #header>
      <Breadcrumbs :items="breadcrumbs"></Breadcrumbs>
    </template>

    <Container>
      <Card>
        <form class="space-y-4" @submit.prevent="submitHandler">
          <AppImage
            label="Image"
            ref="photoRef"
            :image-url="imageUrl"
            v-model="form.image"
            :error-message="form.errors.image"
          ></AppImage>

          <div>
            <jet-label for="category" value="Category" />
            <select
              name="category"
              id="category"
              class="block w-full form-input"
              v-model="form.category_id"
            >
              <option value>Select</option>
              <option
                v-for="(category, index) in categories.data"
                :key="category.id"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
            <jet-input-error :message="form.errors.category_id" class="mt-2" />
          </div>

          <div>
            <jet-label for="title" value="Title" />
            <jet-input
              id="title"
              type="text"
              class="mt-1 block w-full"
              v-model="form.title"
              autocomplete="title"
            />
            <jet-input-error :message="form.errors.title" class="mt-2" />
          </div>

          <div>
            <jet-label for="slug" value="Slug" />
            <jet-input
              id="slug"
              type="text"
              class="mt-1 block w-full"
              v-model="form.slug"
            />
            <jet-input-error :message="form.errors.slug" class="mt-2" />
          </div>

          <div class="col-span-6">
            <jet-label for="description" value="Description" />
            <CKEditor v-model="form.description"></CKEditor>
            <jet-input-error :message="form.errors.description" class="mt-2" />
          </div>

          <div>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3"
              >Saved.</jet-action-message
            >
            <jet-button
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
              >{{ edit ? "Update" : "Save" }}</jet-button
            >
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

import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { watch } from "@vue/runtime-core";
import { strSlug } from "@/helper.js";
import Container from "../../Component/Container.vue";
import Card from "../../Component/Card.vue";
import Breadcrumbs from "../../Component/Breadcrumbs.vue";
import AppImage from "../../Component/AppImage.vue";
import CKEditor from "../../Component/CKEditor.vue";

const props = defineProps({
  edit: Boolean,
  article: Object,
  categories: {
    type: Object,
    default: () => [],
  },
});

const photoRef = ref(null);
const form = useForm({
  category_id: "",
  slug: "",
  title: "",
  description: "",
  image: null,
  _method: "post",
});

const imageUrl = props.article.data.image_url;

if (props.edit) {
  form.title = props.article.data.title;
  form.description = props.article.data.description;
  form.slug = props.article.data.slug;
  form.category_id = props.article.data.category_id;
  form._method = "put";
}

const submitHandler = () => {
  props.edit
    ? form.post(route("articles.update", { id: props.article.data.id }))
    : form.post(route("articles.store"));
};

const breadcrumbs = [
  {
    label: "Articles",
    url: route("articles.index"),
  },
  {
    label: props.edit ? "Edit Article" : "Add Article",
  },
];

watch(
  () => form.title,
  (newTitle) => {
    form.slug = strSlug(newTitle);
  }
);
</script>
