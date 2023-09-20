<script setup>
import Buttom from './Buttom.vue';
import { urlApiStore } from '../stores/api';
import { ref} from 'vue';

const apiUrl = urlApiStore()
const url = ref('')

function postUrl(){
  apiUrl.created(url.value.value)
}
</script>

<template>

  <form @submit.prevent="postUrl" class="mb-6 flex flex-wrap">
    <label for="default-input" class="max-lg:hidden block text-lg me-2 my-auto font-medium text-gray-900 dark:text-white">Url:</label>
    <input ref="url" placeholder="Insira a URL para ser encurtada aqui" type="text" id="default-input" class="max-lg:min-w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-9/12 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <Buttom text="Gerar" />
  </form>

  <div v-if="Object.keys(apiUrl.response).length != 0" id="res" class="mb-6 flex-coloumn">
    <div class="grid grid-flow-col auto-cols-max">
      <p class="mb-2">URL Original:</p>
      <div class="mb-2">{{ apiUrl.response.long_url }}</div>
    </div>
    <div class="grid grid-flow-col auto-cols-max">
      <p class="mb-2">URL Encurtada:</p>
      <div class="mb-2">{{ apiUrl.response.short_url }}</div>
    </div>
    <p class="mb-2">Qr Code:</p>
    <div class="w-3/4 md:w-auto" v-html="apiUrl.response.qr_code"></div>
  </div>

</template>