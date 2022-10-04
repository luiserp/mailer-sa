<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/PrimaryButton.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination.vue";
import Table from "@/Components/Table.vue";
import SearchInput from "@/Components/SearchInput.vue";

import { onMounted, ref, watch } from "vue";

const props = defineProps({
  emails: {
    type: Object,
    default: () => ({}),
  },
});

onMounted(() => {
  console.log(props.emails);
});
</script>

<template>
  <Head title="Emails" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          Emails
        </h2>
        <Link :href="route('emails.create')">
          <BreezeButton>Send Email</BreezeButton></Link
        >
      </div>
    </template>

    <div class="py-8">
      <div class="mx-auto max-w-7xl sm:px-6">
        <div
          v-if="$page.props.flash.message"
          class="
            p-4
            mb-4
            text-sm text-green-700
            bg-green-100
            rounded-lg
            dark:bg-green-200 dark:text-green-800
          "
          role="alert"
        >
          <span class="font-medium">
            {{ $page.props.flash.message }}
          </span>
        </div>
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <div>
              <div class="mb-2 flex justify-between">
                <search-input resourceUrl="/emails"></search-input>
              </div>

              <div
                v-if="emails.data.length > 0"
                class="relative overflow-x-auto shadow-md sm:rounded-lg"
              >
                <Table
                  :data="emails"
                  resource="emails"
                  :actions="['show']"
                  :columns="[
                    { key: 'topic', name: 'Topic' },
                    { key: 'email', name: 'Sender' },
                    { key: 'addressee', name: 'Addressee' },
                    { key: 'status', name: 'Status' },
                  ]"
                />

                <Pagination :data="emails" />
              </div>
              <h1 v-else>Nothing to Show</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>