<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";

const props = defineProps({
  email: {
    type: Object,
    default: () => ({
      topic: "",
      addressee: "",
      content: "",
    }),
  },
});

const form = useForm({
  topic: props.email.topic,
  addressee: props.email.addressee,
  content: props.email.content,
});

const submit = () => {
  form.post(route("emails.store"));
};
</script>

<template>
  <form @submit.prevent="submit">
    <!-- Topic -->
    <div class="mb-6">
      <label
        for="Name"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >Topic</label
      >
      <input
        type="text"
        v-model="form.topic"
        name="title"
        class="
          bg-gray-50
          border border-gray-300
          text-gray-900 text-sm
          rounded-lg
          focus:ring-blue-500 focus:border-blue-500
          block
          w-full
          p-2.5
        "
        placeholder=""
      />
      <div v-if="form.errors.topic" class="text-sm text-red-600">
        {{ form.errors.topic }}
      </div>
    </div>
    <!-- Addressee -->
    <div class="mb-6">
      <label
        for="Email"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >Addressee</label
      >
      <input
        type="email"
        v-model="form.addressee"
        autocomplete="email"
        name="title"
        class="
          bg-gray-50
          border border-gray-300
          text-gray-900 text-sm
          rounded-lg
          focus:ring-blue-500 focus:border-blue-500
          block
          w-full
          p-2.5
        "
        placeholder=""
      />
      <div v-if="form.errors.addressee" class="text-sm text-red-600">
        {{ form.errors.addressee }}
      </div>
    </div>

    <!-- Content -->
    <div class="mb-6">
      <label
        for="Email"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >Content</label
      >
      <textarea
        type="text"
        v-model="form.content"
        name="content"
        rows="5"
        class="
          bg-gray-50
          border border-gray-300
          text-gray-900 text-sm
          rounded-lg
          focus:ring-blue-500 focus:border-blue-500
          block
          w-full
          p-2.5
        "
      ></textarea>

      <div v-if="form.errors.content" class="text-sm text-red-600">
        {{ form.errors.content }}
      </div>
    </div>

    <!-- Submit -->
    <button
      type="submit"
      class="
        text-white
        bg-blue-700
        focus:outline-none
        font-medium
        rounded-lg
        text-sm
        px-5
        py-2.5
      "
      :disabled="form.processing"
      :class="{ 'opacity-25': form.processing }"
    >
      Send
    </button>
  </form>
</template>