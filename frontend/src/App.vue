<script setup>
import { RouterLink, RouterView } from 'vue-router'
import NavBar from './components/NavBar.vue';

</script>

<template>
  <header>
      <NavBar/>
  </header>
  <div class="mx-4 flex flex-col">
    <RouterView />
  </div>
</template>

<style scoped>

</style>
