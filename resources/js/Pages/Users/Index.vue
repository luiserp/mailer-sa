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

const props = defineProps({
  users: {
    type: Object,
    default: () => ({}),
  },
  canUsers: {
    type: Boolean,
    default: false,
  },
});

</script>

<template>
  <Head title="Users" />

  <BreezeAuthenticatedLayout :canUsers="canUsers">
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Users Index
      </h2>
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
                <Link :href="route('users.create')">
                  <BreezeButton>Add User</BreezeButton></Link
                >

                <search-input resourceUrl="/users"></search-input>
              </div>

              <div
                class="relative overflow-x-auto shadow-md sm:rounded-lg"
                v-if="users.data.length > 0"
              >
                <Table
                  :data="users"
                  resource="users"
                  :actions="['edit', 'delete']"
                  :columns="[
                    { key: 'name', name: 'Name' },
                    { key: 'email', name: 'Email' },
                    { key: 'phone_number', name: 'Phone Number' },
                    { key: 'cedula', name: 'Cedula' },
                    { key: 'city|name', name: 'City', order: 'city_id' },
                  ]"
                />

                <Pagination :data="users" />
              </div>
              <h1 v-else>Nothing to Show</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>