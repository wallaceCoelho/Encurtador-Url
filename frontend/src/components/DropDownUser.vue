<script setup>
import { initFlowbite } from 'flowbite'
import { onMounted , computed } from 'vue'
import { authStore } from '../stores/auth'
import { userStore } from '../stores/users'
import { RouterLink } from 'vue-router';

const store = userStore();
const auth = authStore()
let users = computed(() => store.users)

onMounted(async () => {
    initFlowbite();
    try{
      await store.getUser()
    }
    catch (error) {
    console.error('Erro ao carregar os dados:', error)
    }
})

async function logout() {
    await auth.signOut();
}

</script>

<template>
  <div class="flex items-center md:order-2">
        <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
          <span class="sr-only">Open user menu</span>
          <img class="w-8 h-8 rounded-full" src="../assets/img/profile.png" alt="user photo">
        </button>
        <!-- Dropdown menu -->
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
          <div class="px-4 py-3">
            <span class="block text-sm text-gray-900 dark:text-white">{{ users.name }}</span>
            <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{ users.email }}</span>
          </div>
          <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
              <RouterLink to="panel" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Painel</RouterLink>
            </li>
            <li>
              <RouterLink to="profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Configurações</RouterLink>
            </li>
            <li>
              <a type="button" @click="logout()" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sair</a>
            </li>
          </ul>
        </div>
        <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
          </svg>
      </button>
    </div>
</template>