<template>
    <textarea
        refs="input"  
        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded shadow-sm w-full"
        rows="5"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    ></textarea>
</template>
<script>
export default defineComponent({
    methods: {
        focus() {
            this.$refs.input.focus();
        },  
    },
});
</script>

<script setup>
import { defineComponent } from "vue";

defineProps(["modelValue"]);
defineEmits(["update:modelValue"]);
</script>
