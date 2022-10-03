<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/PrimaryButton.vue";
import { Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination.vue";
import { onMounted, ref, watch } from "vue";

const props = defineProps({
  users: {
    type: Object,
    default: () => ({}),
  },
});

let search = ref("");
watch(search, (value) => {
  Inertia.get(
    "/users",
    { search: value },
    {
      preserveState: true,
    }
  );
});

onMounted(() => {
  console.log(props.users);
});

const form = useForm();
function destroy(id) {
  if (confirm("Are you sure you want to Delete")) {
    form.delete(route("users.destroy", id));
  }
}
</script>

<template>
  <Head title="Users" />

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Users Index
      </h2>
    </template>

    <div class="py-12">
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
            <div class="mb-2 flex justify-between">
              <Link :href="route('users.create')">
                <BreezeButton>Add User</BreezeButton></Link
              >
              <div class="mb-2">
                <input
                  type="text"
                  v-model="search"
                  placeholder="Search..."
                  class="
                    bg-gray-50
                    border border-gray-300
                    text-gray-900 text-sm
                    rounded-lg
                    focus:ring-blue-500 focus:border-blue-500
                    block
                    w-60
                    p-2.5
                  "
                />
              </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
              <table
                class="
                  w-full
                  text-sm text-left text-gray-500
                  dark:text-gray-400
                "
              >
                <thead
                  class="
                    text-xs text-gray-700
                    uppercase
                    bg-gray-50
                    dark:bg-gray-700 dark:text-gray-400
                  "
                >
                  <tr>
                    <th scope="col" class="px-6 py-3">#</th>
                    <th scope="col" class="px-6 py-3">
                      <Link
                        :href="
                          route('users.index', {
                            order: 'name',
                            page: users.current_page,
                          })
                        "
                        preserve-scroll
                        >Name</Link
                      >
                    </th>
                    <th scope="col" class="px-6 py-3">
                      <Link
                        :href="
                          route('users.index', {
                            order: 'email',
                            page: users.current_page,
                          })
                        "
                        preserve-scroll
                        >Email</Link
                      >
                    </th>
                    <th scope="col" class="px-6 py-3">
                      <Link
                        :href="
                          route('users.index', {
                            order: 'phone_number',
                            page: users.current_page,
                          })
                        "
                        preserve-scroll
                        >Phone</Link
                      >
                    </th>
                    <th scope="col" class="px-6 py-3">
                      <Link
                        :href="
                          route('users.index', {
                            order: 'cedula',
                            page: users.current_page,
                          })
                        "
                        preserve-scroll
                        >Cedula</Link
                      >
                    </th>
                    <th scope="col" class="px-6 py-3">
                      <Link
                        :href="
                          route('users.index', {
                            order: 'birthday',
                            page: users.current_page,
                          })
                        "
                        preserve-scroll
                        >Birthday</Link
                      >
                    </th>
                    <th scope="col" class="px-6 py-3">
                      <Link
                        :href="
                          route('users.index', {
                            order: 'city_id',
                            page: users.current_page,
                          })
                        "
                        preserve-scroll
                        >City</Link
                      >
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="user in users.data"
                    :key="user.id"
                    class="
                      bg-white
                      border-b
                      dark:bg-gray-800 dark:border-gray-700
                    "
                  >
                    <th
                      scope="row"
                      class="
                        px-6
                        py-4
                        font-medium
                        text-gray-900
                        dark:text-white
                        whitespace-nowrap
                      "
                    >
                      {{ user.id }}
                    </th>
                    <th
                      scope="row"
                      class="
                        px-6
                        py-4
                        font-medium
                        text-gray-900
                        dark:text-white
                        whitespace-nowrap
                      "
                    >
                      {{ user.name }}
                    </th>
                    <td class="px-6 py-4">
                      {{ user.email }}
                    </td>
                    <td class="px-6 py-4">
                      {{
                        user.phone_number ? user.phone_number : "Not Provided"
                      }}
                    </td>
                    <td class="px-6 py-4">
                      {{ user.cedula }}
                    </td>
                    <td class="px-6 py-4">
                      {{ user.birthday }}
                    </td>
                    <td class="px-6 py-4">
                      {{ user.city.name }}
                    </td>

                    <td class="px-6 py-4">
                      <Link
                        :href="route('users.edit', user.id)"
                        class="px-4 py-2 text-white bg-blue-600 rounded-lg"
                        >Edit</Link
                      >
                    </td>
                    <td class="px-6 py-4">
                      <BreezeButton
                        class="bg-red-700"
                        @click="destroy(user.id)"
                      >
                        Delete
                      </BreezeButton>
                    </td>
                  </tr>
                </tbody>
              </table>

              <Pagination :data="users" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>