<script setup>
import { RouterLink, RouterView } from 'vue-router'
import NavBar from './components/NavBar.vue';
import Footer from './components/Footer.vue';

</script>

<template>

  <header>
      <NavBar/>
  </header>

  <div class="mx-4 flex flex-col">
    <RouterView />
  </div>

  <footer>
    <Footer />
  </footer>

</template>

<style scoped>

</style>
