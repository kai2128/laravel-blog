<template>
  <!--  Photo File Input -->
  <input type="file" class="hidden" ref="photoRef" @change="updatePhotoPreview" />

  <jet-label for="photo" :value="label" />

  <!-- Current Profile Photo -->
  <div class="mt-2" v-show="!photoPreview">
    <img :src="imageUrl" class="rounded-full h-20 w-20 object-cover" />
  </div>

  <!-- New Profile Photo Preview -->
  <div class="mt-2" v-show="photoPreview">
    <span
      class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
      :style="'background-image: url(\'' + photoPreview + '\');'"
    >
    </span>
  </div>

  <jet-secondary-button class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
    Select A New Photo
  </jet-secondary-button>

  <jet-input-error :message="errorMessage" class="mt-2" />
</template>
<script setup>
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetLabel from "@/Jetstream/Label.vue";
import { defineComponent, ref } from "vue";

const props = defineProps(["imageUrl", "label", "errorMessage", "modelValue"]);
const emit = defineEmits(["update:modelValue", "clear"]);

const photoPreview = ref(null);
const photoRef = ref(null);

function selectNewPhoto() {
  photoRef.value.click();
}

function updatePhotoPreview() {
  const photo = photoRef.value.files[0];

  if (!photo) return;

  const reader = new FileReader();

  reader.onload = (e) => {
    photoPreview.value = e.target.result;
  };

  reader.readAsDataURL(photo);
  emit("update:modelValue", photo);
}
</script>
<script>
export default {
  methods: {
    clearPhotoFileInput() {
      if (photoRef.value?.value) {
        photoRef.value.value = null;
      }
    },
  },
};
</script>
