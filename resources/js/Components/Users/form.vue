<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";

const props = defineProps({
  user: {
    type: Object,
    default: () => ({
      name: "",
      email: "",
      password: "",
      password_confirmation: "",
      phone_number: "",
      cedula: "",
      birthday: "",
      city_id: "",
      city: {
        id: "",
        state: {
          id: "",
          country: {
            id: "",
          },
        },
      },
    }),
  },
});

const editing = props.user.id != null;

const countries = ref([]);
const states = ref([]);
const cities = ref([]);

const selected_country = ref(props.user.city.state.country.id);
const selected_state = ref(props.user.city.state.id);

const form = useForm({
  name: props.user.name,
  email: props.user.email,
  password: "",
  password_confirmation: "",
  phone_number: props.user.phone_number,
  cedula: props.user.cedula,
  birthday: props.user.birthday,
  city_id: props.user.city_id,
});

const submit = () => {
  console.log(form);
  if (editing) form.put(route("users.update", props.user.id));
  else form.post(route("users.store"));
};

const getCountries = async (refresh = true) => {
  if (refresh) {
    selected_country.value = "";
    selected_state.value = "";
    form.city_id = "";
  }
  const res = await fetch("/api/countries");
  const json = await res.json();
  countries.value = json.data;
};

const getStates = async (refresh = true) => {
  if (refresh) {
    selected_state.value = "";
    form.city_id = "";
  }
  const res = await fetch(`/api/countries/${selected_country.value}/states`);
  const json = await res.json();
  states.value = json.data;
};

const getCities = async (refresh = true) => {
  if (refresh) {
    form.city_id = "";
  }
  const res = await fetch(`/api/state/${selected_state.value}/cities`);
  const json = await res.json();
  cities.value = json.data;
};

onMounted(async () => {
    // console.log(props.user, selected_country.value, selected_state.value);
  getCountries(false);
  if (props.user.city.state.country.id != "") {
    getStates(false);
    getCities(false);
  }
});
</script>

<template>
  <form @submit.prevent="submit">
    <!-- Name -->
    <div class="mb-6">
      <label
        for="Name"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >Name</label
      >
      <input
        type="text"
        v-model="form.name"
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
      <div v-if="form.errors.name" class="text-sm text-red-600">
        {{ form.errors.name }}
      </div>
    </div>
    <!-- Email -->
    <div class="mb-6">
      <label
        for="Email"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >Email</label
      >
      <input
        type="email"
        v-model="form.email"
        name="title"
        :disabled="editing"
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
      <div v-if="form.errors.email" class="text-sm text-red-600">
        {{ form.errors.email }}
      </div>
    </div>
    <!-- Password -->
    <div class="mb-6" v-if="!editing">
      <label
        for="Password"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >Password</label
      >
      <input
        type="password"
        v-model="form.password"
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
      <div v-if="form.errors.password" class="text-sm text-red-600">
        {{ form.errors.password }}
      </div>
    </div>
    <!-- Repit Password -->
    <div class="mb-6" v-if="!editing">
      <label
        for="password_confirmation"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >Repit Password</label
      >
      <input
        type="password"
        id="password_confirmation"
        v-model="form.password_confirmation"
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
      <div
        v-if="form.errors.password_confirmation"
        class="text-sm text-red-600"
      >
        {{ form.errors.password_confirmation }}
      </div>
    </div>

    <!-- Phone -->
    <div class="mb-6">
      <label
        for="Phone"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >Phone Number</label
      >
      <input
        type="tel"
        v-model="form.phone_number"
        name="phone"
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
      <div v-if="form.errors.phone" class="text-sm text-red-600">
        {{ form.errors.phone }}
      </div>
    </div>

    <!-- Cedula -->
    <div class="mb-6">
      <label
        for="Cedula"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >Cedula</label
      >
      <input
        type="text"
        v-model="form.cedula"
        name="title"
        :disabled="editing"
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
      <div v-if="form.errors.cedula" class="text-sm text-red-600">
        {{ form.errors.cedula }}
      </div>
    </div>

    <!-- Birthday -->
    <div class="mb-6">
      <label
        for="Birthday"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >Birthday</label
      >
      <input
        type="date"
        v-model="form.birthday"
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
      <div v-if="form.errors.birthday" class="text-sm text-red-600">
        {{ form.errors.birthday }}
      </div>
    </div>

    <!-- Country -->
    <div class="mb-6">
      <label
        for="Country"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >Country</label
      >

      <select
        @change="getStates()"
        v-model="selected_country"
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
      >
        <option class="text-base" disabled value="">Please select one</option>
        <option
          v-for="country in countries"
          :value="country.id"
          :key="country.id"
        >
          {{ country.name }}
        </option>
      </select>
    </div>

    <!-- State -->
    <div class="mb-6">
      <label
        for="State"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >State</label
      >

      <select
        @change="getCities()"
        v-model="selected_state"
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
      >
        <option class="text-base" disabled value="">Please select one</option>
        <option v-for="state in states" :value="state.id" :key="state.id">
          {{ state.name }}
        </option>
      </select>
    </div>

    <!-- City -->
    <div class="mb-6">
      <label
        for="City"
        class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300"
        >City</label
      >

      <select
        v-model="form.city_id"
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
      >
        <option class="text-base" disabled value="">Please select one</option>
        <option v-for="city in cities" :value="city.id" :key="city.id">
          {{ city.name }}
        </option>
      </select>
      <div v-if="form.errors.city_id" class="text-sm text-red-600">
        {{ form.errors.city_id }}
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
      Submit
    </button>
  </form>
</template>