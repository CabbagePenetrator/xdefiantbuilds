<script setup>
import Nav from '@/Components/Nav.vue'
</script>

<template>
  <Nav />
  <main class="container pb-8 pt-4 md:py-8 lg:max-w-4xl lg:pb-16 lg:pt-12">
    <h1 class="text-xl font-bold italic md:text-3xl lg:text-4xl">
      <slot name="heading" />
    </h1>

    <slot name="content" />
  </main>
</template>
