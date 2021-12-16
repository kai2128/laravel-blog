<template>
  <jet-form-section @submitted="updateHeroInformation">
    <template #title> Hero Information </template>

    <template #description> Update the Contact us section data. </template>

    <template #form>
      <!--  Photo -->
      <div class="col-span-6 sm:col-span-4">
        <AppImage ref="photoRef" :image-url="settings.data.contact_image" label="Photo" :error-message="form.errors.contact_image" v-model="form.contact_image"></AppImage>
      </div>

         <!-- Address -->
            <div class="col-span-6">
                <jet-label for="address" value="Address" />
                <jet-input id="address" type="text" class="mt-1 block w-full" v-model="form.address" autocomplete="address" />
                <jet-input-error :message="form.errors.address" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="col-span-6">
                <jet-label for="phone" value="Phone" />
                <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" autocomplete="phone" />
                <jet-input-error :message="form.errors.phone" class="mt-2" />
            </div>

               <!-- Email -->
            <div class="col-span-6">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="text" class="mt-1 block w-full" v-model="form.email" autocomplete="email" />
                <jet-input-error :message="form.errors.email" class="mt-2" />
            </div>

      <!-- description -->
      <div class="col-span-6">
        <jet-label for="google_map_url" value="Google map url" />
        <app-textarea
          id="google_map_url"
          type="text"
          class="mt-1 block w-full"
          v-model="form.google_map_url"
          autocomplete="name"
        ></app-textarea>
        <jet-input-error :message="form.errors.google_map_url" class="mt-2" />
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
  google_map_url: props.settings.data.google_map_url,
  address: props.settings.data.address,
  phone: props.settings.data.phone,
  email: props.settings.data.email,
  contact_image: null,
});

const photoRef = ref(null);

function updateHeroInformation() {
  form.post(route("settings.save-contact"), {
    preserveScroll: true,
    onSuccess: () => photoRef.value.clearPhotoFileInput(),
  });
}


</script>
