<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Form from "@/Components/Emails/form.vue";

const props = defineProps({
  email: {
    type: Object,
    default: () => ({}),
  },
});
</script>

<template>
  <Head title="Email Show" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Email Details
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <h3 class="text-lg py-2"><strong>Topic:</strong> {{ email.topic }}</h3>
            <p class="p-2"><strong>Addressee:</strong> {{ email.addressee }}</p>
            <p class="p-2"><strong>Status:</strong> {{ email.status }}</p>
            <p class="p-2"><strong>Content:</strong> {{ email.content }}</p>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>