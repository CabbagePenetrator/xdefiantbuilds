<script setup>
import { Head, Link } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import Categories from '@/Components/Categories.vue'

defineProps({
  loadouts: Array,
  categories: Array,
})
</script>

<template>
  <GuestLayout>
    <Head title="Loadouts" />

    <div class="container">
      <h1 class="text-xl md:text-3xl">Loadouts</h1>

      <Categories :categories="categories" />

      <div class="mt-6 grid gap-6 md:mt-8">
        <Link
          v-for="loadout in loadouts"
          :key="loadout.id"
          :href="route('loadouts.show', loadout)"
          class="relative bg-light-blue p-4 shadow-md"
        >
          <article class="grid grid-cols-[auto_1fr_auto] items-center md:pr-8">
            <div>
              <h2 class="font-bold">{{ loadout.name }}</h2>
              <p>{{ loadout.gun.name }} loadout by {{ loadout.user.name }}</p>
            </div>
            <div class="col-start-3 hidden text-center md:block">
              <p class="text-sm uppercase">Votes</p>
              <p class="font-bold">{{ loadout.votes }}</p>
            </div>
          </article>
          <svg
            class="absolute right-0 top-0 h-4 w-4"
            viewBox="0 0 15 15"
            fill="none"
          >
            <path d="M0 0h15v15L8 8.5 0 0Z" fill="#EDCE52" />
          </svg>
        </Link>
      </div>
    </div>
  </GuestLayout>
</template>
