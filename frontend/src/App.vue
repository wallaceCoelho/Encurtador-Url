<script setup>
import { RouterView } from 'vue-router'
import NavBar from './components/NavBar.vue';
import Footer from './components/Footer.vue';
import { authStore } from './stores/auth'
import { onMounted } from 'vue'

const store = authStore()

onMounted(async () => {
    await store.isSignedIn()
})


</script>

<template>

  <header>
      <NavBar/>
  </header>

  <div class="mx-4 flex flex-col">
    <RouterView />
  </div>

  <footer class="max-lg:mt-32">
    <Footer />
  </footer>

</template>

<style scoped>

</style>
