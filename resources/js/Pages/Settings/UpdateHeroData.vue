<template>
  <jet-form-section @submitted="updateHeroInformation">
    <template #title> Hero Information </template>

    <template #description> Update the hero section data. </template>

    <template #form>
      <!--  Photo -->
      <div class="col-span-6 sm:col-span-4">
        <AppImage ref="photoRef" :image-url="settings.data.hero_image" label="Photo" :error-message="form.errors.hero_image" v-model="form.hero_image"></AppImage>
      </div>

      <!-- description -->
      <div class="col-span-6">
        <jet-label for="description" value="Description" />
        <app-textarea
          id="description"
          type="text"
          class="mt-1 block w-full"
          v-model="form.hero_description"
          autocomplete="name"
        ></app-textarea>
        <jet-input-error :message="form.errors.hero_description" class="mt-2" />
      </div>
    </template>

    <template #actions>
      <jet-action-message :on="form.recentlySuccessful" class="mr-3">
        Saved.
      </jet-action-message>

      <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Save
      </jet-button>
    </template>
  </jet-form-section>
</template>
<script setup>
import { defineComponent, ref } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import route from "../../../../vendor/tightenco/ziggy/src/js";
import AppTextarea from "../../Component/AppTextarea.vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import AppImage from "../../Component/AppImage.vue";

const props = defineProps(["user", "settings"]);

const form = useForm({
  hero_description: props.settings.data.hero_description,
  hero_image: null,
});

const photoRef = ref(null);

function updateHeroInformation() {
  form.post(route("settings.save-hero"), {
    preserveScroll: true,
    onSuccess: () => photoRef.value.clearPhotoFileInput(),
  });
}

</script>
