<script setup>
import Nav from '@/Components/Nav.vue'
</script>

<template>
  <Nav />
  <main class="mx-auto py-4 md:py-8 lg:max-w-4xl lg:py-12">
    <slot />
  </main>
</template>
