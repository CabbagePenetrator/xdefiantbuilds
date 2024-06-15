<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

defineProps({
  categories: Array,
})
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Select Gun" />

    <template #heading>Select Gun</template>

    <template #content>
      <ul class="grid gap-6 pt-4 md:gap-y-8 md:pt-6">
        <li v-for="category in categories" :key="category.id">
          <h2 class="uppercase md:text-xl">
            {{ category.name }}
          </h2>
          <ul class="mt-2 grid gap-4 sm:grid-cols-2 md:mt-4 md:grid-cols-3">
            <li
              v-for="gun in category.guns"
              :key="gun.id"
              class="bg-blue px-2 py-4 sm:px-4"
            >
              <Link :href="route('loadouts.create', gun)">
                <h3>{{ gun.name }}</h3>
              </Link>
            </li>
          </ul>
        </li>
      </ul>
    </template>
  </AuthenticatedLayout>
</template>
