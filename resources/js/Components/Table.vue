<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import BreezeButton from "@/Components/PrimaryButton.vue";

const props = defineProps({
  data: {
    type: Object,
    default: () => ({}),
  },
  columns: {
    type: Array,
    default: (props) => Object.keys(props.data.data[0]),
  },
  actions: {
    type: Array,
    default: () => ['show', 'edit', 'delete']
  },
  resource: {
    type: String,
    required: true,
  },
});

const getContent = (row, name) => {
    let current = null
    name.split('|').forEach(key => {
        if (!current) current = row[key]
        else current = current[key]
    });
    return current
}
</script>

<template>
  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
    <thead
      class="
        text-xs text-gray-700
        uppercase
        bg-gray-50
        dark:bg-gray-700 dark:text-gray-400
      "
    >
      <tr>

        <th scope="col" class="px-6 py-3" v-for="col in columns" :key="col">
          <Link
            :href="
              route(`${resource}.index`, {
                order: col.order ? col.order : col.key,
                page: data.current_page,
              })
            "
            preserve-scroll
            >{{ col.name ? col.name : col.key }}</Link
          >
        </th>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="row in data.data"
        :key="row.id"
        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
      >
        <th
            v-for="col in columns" :key="col"
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
          {{ getContent(row, col.key) }}
        </th>
        <td class="px-6 py-4" v-if="actions.includes('show')">
          <Link
            :href="route(`${resource}.show`, row.id)"
            class="px-4 py-2 text-white bg-blue-600 rounded-lg"
            >Show</Link
          >
        </td>
        <td class="px-6 py-4" v-if="actions.includes('edit')">
          <Link
            :href="route(`${resource}.edit`, row.id)"
            class="px-4 py-2 text-white bg-blue-600 rounded-lg"
            >Edit</Link
          >
        </td>
        <td class="px-6 py-4" v-if="actions.includes('delete')">
          <BreezeButton class="bg-red-700" @click="destroy(row.id)">
            Delete
          </BreezeButton>
        </td>
      </tr>
    </tbody>
  </table>
</template>

