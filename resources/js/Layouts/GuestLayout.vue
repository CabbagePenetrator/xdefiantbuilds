<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <nav class="bg-dark-blue py-4 shadow-sm md:py-6">
    <div class="container flex items-center justify-between">
      <Link
        href="/"
        class="text-lg font-bold uppercase italic md:text-left md:text-4xl"
      >
        XDefiant Builds
      </Link>
      <button type="button">
        <svg viewBox="0 0 20 20" fill="currentColor" class="size-5">
          <path
            fill-rule="evenodd"
            d="M2 4.75A.75.75 0 0 1 2.75 4h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75ZM2 10a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 10Zm0 5.25a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z"
            clip-rule="evenodd"
          />
        </svg>
      </button>
    </div>
  </nav>
  <main class="mx-auto py-4 md:py-8 lg:max-w-4xl lg:py-12">
    <slot />
  </main>
</template>
