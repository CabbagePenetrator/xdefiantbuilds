<script setup>
import { Link, router } from '@inertiajs/vue3'

defineProps({
  categories: Array,
})
</script>

<template>
  <div>
    <select
      @change="(event) => router.get(event.target.value)"
      class="mt-4 w-full border-0 bg-blue uppercase shadow-md md:mt-8 md:hidden"
    >
      <option
        :selected="route().params.category === 'home'"
        :value="route('home')"
      >
        All
      </option>
      <option
        v-for="category in categories"
        :key="category.name"
        :selected="route().params.category === category.name"
        :value="route('categories.loadouts', category)"
      >
        {{ category.name }}
      </option>
    </select>
    <div class="mt-6 hidden gap-2 md:flex">
      <Link :href="route('home')" class="relative px-4 py-1 uppercase">
        <div
          class="absolute inset-0 -skew-x-12 transform bg-blue"
          :class="{ 'bg-white': route().current('home') }"
        ></div>
        <p class="relative" :class="{ 'text-black': route().current('home') }">
          All
        </p>
      </Link>
      <Link
        v-for="category in categories"
        :key="category.name"
        :href="route('categories.loadouts', category)"
        class="relative px-4 py-1 uppercase"
      >
        <div
          class="absolute inset-0 -skew-x-12 transform bg-blue"
          :class="{ 'bg-white': route().params.category === category.name }"
        ></div>
        <p
          class="relative"
          :class="{ 'text-black': route().params.category === category.name }"
        >
          {{ category.name }}
        </p>
      </Link>
    </div>
  </div>
</template>
