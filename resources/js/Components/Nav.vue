<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { ref } from 'vue'
import Menu from '@/Components/Icons/Menu.vue'
import Close from '@/Components/Icons/Close.vue'

const open = ref(false)

const user = usePage().props.auth.user
</script>

<template>
  <nav class="flex h-14 items-center bg-blue shadow-sm md:h-20">
    <div
      class="container flex items-center justify-between gap-16 lg:justify-normal"
    >
      <Link
        :href="route('home')"
        class="text-lg font-bold uppercase italic md:text-left md:text-4xl"
      >
        XDefiant Builds
      </Link>
      <Link v-if="!user" :href="route('login')" class="hidden lg:block">
        Login
      </Link>
      <Link v-if="user" :href="route('select-gun')" class="hidden lg:block">
        New loadout
      </Link>
      <button @click="open = !open" type="button" class="lg:hidden">
        <Menu v-if="!open" />
        <Close v-else />
      </button>
      <Teleport to="body">
        <aside
          class="absolute bottom-0 left-0 right-0 top-14 bg-dark-blue p-4 md:top-20 lg:hidden"
          v-if="open"
        >
          <ul>
            <li v-if="!user">
              <Link :href="route('login')">Login</Link>
            </li>
            <li v-if="user">
              <Link :href="route('select-gun')">New loadout</Link>
            </li>
          </ul>
        </aside>
      </Teleport>
    </div>
  </nav>
</template>
