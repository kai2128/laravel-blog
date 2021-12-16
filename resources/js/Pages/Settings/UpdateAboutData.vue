<template>
  <jet-form-section @submitted="updateAboutInformation">
    <template #title>About Us Information </template>

    <template #description> Update the about us data. </template>

    <template #form>
      <!--  Photo -->
      <div class="col-span-6 sm:col-span-4">
        <AppImage
          ref="photoRef"
          :image-url="settings.data.about_image"
          label="Photo"
          :error-message="form.errors.about_image"
          v-model="form.about_image"
        ></AppImage>
      </div>

      <!-- description -->
      <div class="col-span-6">
        <jet-label for="description" value="Description" />
        <CKEditor v-model="form.about_description"></CKEditor>
        <jet-input-error :message="form.errors.about_description" class="mt-2" />
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
import JetButton from "@/Jetstream/Button.vue";
import JetFormSection from "@/Jetstream/FormSection.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetActionMessage from "@/Jetstream/ActionMessage.vue";
import route from "../../../../vendor/tightenco/ziggy/src/js";
import { useForm } from "@inertiajs/inertia-vue3";
import AppImage from "../../Component/AppImage.vue";
import { reactive, ref } from "vue";
import CKEditor from "../../Component/CKEditor.vue";

const props = defineProps(["user", "settings"]);

const form = useForm({
  about_description: props.settings.data.about_description,
  about_image: null,
});

const photoRef = ref(null);

function updateAboutInformation() {
  form.post(route("settings.save-about"), {
    errorBag: "updateProfileInformation",
    preserveScroll: true,
    onSuccess: () => photoRef.value.clearPhotoFileInput(),
  });
}
</script>
