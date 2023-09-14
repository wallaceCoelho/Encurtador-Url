<script setup>
import ButtomUrl from './ButtomUrl.vue';
import { urlApiStore } from '../stores/api';
import { ref} from 'vue';

const apiUrl = urlApiStore()
const url = ref('')

function postUrl(){
  apiUrl.created(url.value.value)
}
</script>

<template>

  <form @submit.prevent="postUrl" class="mb-6 flex">
    <label for="default-input" class="block text-lg me-2 my-auto font-medium text-gray-900 dark:text-white">Url:</label>
    <input ref="url" type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-9/12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <ButtomUrl/>
  </form>

  <div id="res" class="mb-6 flex-coloumn">
    <p class="mb-2">URL Original: {{ apiUrl.response.long_url }}</p>
    <p class="mb-2">URL Encurtada: {{ apiUrl.response.short_url }}</p>
    <p class="mb-2">Qr Code:</p>
    <div class="w-3/4" v-html="apiUrl.response.qr_code"></div>
  </div>

</template>