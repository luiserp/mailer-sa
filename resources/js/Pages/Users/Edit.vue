<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import BreezeButton from "@/Components/PrimaryButton.vue";
import Form from '@/Components/Users/form.vue'


const props = defineProps({
  user: {
    type: Object,
    default: () => ({}),
  },
});

</script>

<template>
  <Head title="User Create" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        User Edit
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            
            <Form :user="user" />

          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>