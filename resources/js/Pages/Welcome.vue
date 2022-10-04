<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
  canLogin: Boolean,
  canRegister: {
    type: Boolean,
    default: false
  },
});
</script>

<template>
  <Head title="Welcome" />

  <div
    class="
      relative
      flex
      items-top
      justify-center
      min-h-screen
      bg-gray-100
      dark:bg-gray-900
      items-center pt-0
    "
  >
    <div v-if="canLogin" class="fixed top-0 right-0 px-6 py-4 block">
      <Link
        v-if="$page.props.auth.user"
        :href="route('emails.index')"
        class="text-base text-gray-700 dark:text-gray-500 underline"
        >Emails</Link
      >

      <template v-else>
        <Link
          :href="route('login')"
          class="text-base text-gray-700 dark:text-gray-500 underline"
          >Log in</Link
        >

        <Link
          v-if="canRegister"
          :href="route('register')"
          class="ml-4 text-base text-gray-700 dark:text-gray-500 underline"
          >Register</Link
        >
      </template>
    </div>

   
    <div class="flex flex-col text-center">
      <h1 class="text-4xl font-bold ">Welcome to Mailer S.A</h1>
      <p class="w-11/12 sm:w-1/2 mx-auto my-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus impedit ipsum excepturi nobis modi fugiat tempora perspiciatis pariatur consequuntur mollitia, deleniti cupiditate atque veritatis, nisi culpa quos. Reiciendis, cumque placeat.</p>
    </div>


  </div>
</template>
