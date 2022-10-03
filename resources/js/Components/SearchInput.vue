
<script setup>
import { onMounted, ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  resourceUrl: {
    type: String,
    required: true,
  },
});

let search = ref("");
watch(search, (value) => {
  Inertia.get(
    props.resourceUrl,
    { search: value },
    {
      preserveState: true,
    }
  );
});

</script>

<template>
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
</template>

