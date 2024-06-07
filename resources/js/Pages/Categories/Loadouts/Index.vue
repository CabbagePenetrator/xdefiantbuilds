<script setup>
import { Head, Link } from '@inertiajs/vue3'

defineProps({
  loadouts: Array,
  categories: Array,
})
</script>

<template>
  <main class="container mx-auto px-6 pt-10 md:pt-16">
    <Head title="Loadouts" />

    <h1
      class="text-center text-2xl font-bold uppercase italic md:text-left md:text-4xl"
    >
      Loadouts
    </h1>

    <div class="mx-auto lg:max-w-5xl">
      <select
        class="mt-4 w-full border-0 bg-blue uppercase shadow-md md:mt-8 md:max-w-40 xl:hidden"
      >
        <option v-for="category in categories" :key="category.name" class="">
          {{ category.name }}
        </option>
      </select>

      <div class="mt-10 hidden gap-2 xl:flex">
        <Link
          v-for="category in categories"
          :key="category.name"
          :href="route('categories.loadouts', category)"
          class="relative px-4 py-1 uppercase"
        >
          <div class="absolute inset-0 -skew-x-12 transform bg-blue"></div>
          <p class="relative">{{ category.name }}</p>
        </Link>
      </div>

      <div class="mt-6 grid gap-6 md:mt-8">
        <Link
          v-for="loadout in loadouts"
          :key="loadout.id"
          :href="route('loadouts.show', loadout)"
          class="relative bg-light-blue p-4 shadow-md"
        >
          <article class="grid grid-cols-[auto_1fr_auto] items-center pr-8">
            <div>
              <h2 class="font-bold">{{ loadout.name }}</h2>
              <p>{{ loadout.gun.name }} loadout by {{ loadout.user.name }}</p>
            </div>
            <div class="col-start-3 text-center">
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
  </main>
</template>
