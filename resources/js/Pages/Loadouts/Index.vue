<script setup>
import { Head } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import Categories from '@/Components/Categories.vue'
import Loadout from '@/Components/Loadout.vue'

defineProps({
  loadouts: Array,
  categories: Array,
})
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Loadouts" />

    <section class="container">
      <h1 class="text-xl md:text-3xl">Loadouts</h1>

      <Categories :categories="categories" />

      <div class="mt-6 grid gap-6 md:mt-8">
        <Loadout
          v-for="loadout in loadouts"
          :key="loadout.id"
          :loadout="loadout"
        />
      </div>
    </section>
  </AuthenticatedLayout>
</template>
