<template>
  <app-layout title="Articles">
    <template #header>
      <Breadcrumbs :items="breadcrumbs"></Breadcrumbs>
    </template>

    <Container>
      <Button @click="$inertia.visit(route('articles.create'))" class="mb-4"
        >Add New</Button
      >
      <Card>
        <AppTable :headers="headers" :items="articles">
          <tr v-for="article in articles.data" :key="article.id">
            <td>{{ article.title }}</td>
            <td>{{ article.category.name }}</td>
            <td>{{ article.created_at_for_human }}</td>
            <td>
              <div class="flex items-center space-x-2 justify-end">
                <AppButton
                  type="Edit"
                  :url="route('articles.edit', { article: article.id })"
                ></AppButton>
                <AppButton
                  type="Delete"
                  :url="route('articles.destroy', { article: article.id })"
                  module-name="articles"
                ></AppButton>
              </div>
            </td>
          </tr>
        </AppTable>
      </Card>
    </Container>
  </app-layout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import AppButton from "../../Component/AppButton.vue";
import AppTable from "../../Component/AppTable.vue";
import Button from "@/Jetstream/Button.vue";
import Container from "../../Component/Container.vue";
import Card from "../../Component/Card.vue";
import Breadcrumbs from "../../Component/Breadcrumbs.vue";

defineProps(["articles"]);

const breadcrumbs = [
  {
    label: "Articles",
  },
];

const headers = [
  {
    label: "Title",
  },
  {
    label: "Category Name",
  },
  {
    label: "Created Date",
  },
  {
    label: "Action",
    class: "text-right",
  },
];
</script>
