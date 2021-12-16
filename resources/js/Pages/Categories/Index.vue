<template>
  <app-layout title="Categories">
    <template #header>
      <Breadcrumbs :items="breadcrumbs"></Breadcrumbs>
    </template>

    <Container>
      <Button @click="$inertia.visit(route('categories.create'))" class="mb-4"
        >Add New</Button
      >
      <Card>
        <AppTable :headers="headers" :items="categories">
          <tr v-for="category in categories.data" :key="category.id">
            <td>{{ category.name }}</td>
            <td>{{ category.created_at_for_human }}</td>
            <td>
              <div class="flex items-center space-x-2 justify-end">
                <AppButton
                  type="Edit"
                  :url="route('categories.edit', { category: category.id })"
                ></AppButton>
                <AppButton
                  type="Delete"
                  :url="route('categories.destroy', { category: category.id })"
                  module-name="categories"
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

defineProps(["categories"]);

const breadcrumbs = [
  {
    label: "Categories",
  },
];

const headers = [
  {
    label: "Name",
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
