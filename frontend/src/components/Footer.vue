<script setup>
import { RouterLink } from 'vue-router';

</script>
<template>

<div class="fixed max-md:text-center flex-row-reverse bottom-0 left-0 z-20 w-full p-4 bg-white border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800 dark:border-gray-600">
    <ul class="flex flex-wrap max-md:mb-5 max-xl:justify-between items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
        <li>
          <RouterLink to="/" class="block py-2 pl-3 pr-4 mx-5 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Início</RouterLink>
        </li>
        <li>
            <RouterLink to="/" class="block py-2 pl-3 pr-4 mx-5 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Termos de Uso</RouterLink>
        </li>
        <li>
            <RouterLink to="/" class="block py-2 pl-3 pr-4 mx-5 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Privacidade</RouterLink>
        </li>
        <li>
            <RouterLink to="contact" class="block py-2 pl-3 pr-4 mx-5 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contato</RouterLink>
        </li>
    </ul>
    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 
        <RouterLink to="https://flowbite.com/" class=" text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Coelho Dev</RouterLink>. Todos os direitos reservados.
    </span>
</div>

</template>