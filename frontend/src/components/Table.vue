<script setup>
import { urlApiStore } from '../stores/url'
import { onMounted , computed } from 'vue'

const store = urlApiStore()
let urls = computed(() => store.url)

async function deleteUrl(id){
  try{
    await store.deleteUrl(id)
  } catch (error) {
    console.error('Erro ao carregar os dados:', error)
  }
}

onMounted(async () => {
  try {
    await store.getUrl()
  } catch (error) {
    console.error('Erro ao carregar os dados:', error)
  }
})

</script>
<template>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
            Histórico
            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">Navegue pela lista de histórico de URLs que você já encurtou e as gerencie, podendo visualizar e excluir do histórico.</p>
        </caption>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Url Original
                </th>
                <th scope="col-2" class="px-6 py-3">
                    Url Encurtada
                </th>
                <th scope="col" class="px-6 py-3">
                    Qr Code
                </th>
                <th scope="col" class="px-6 py-3">
                    <span class="sr-only">Info</span>
                </th>
            </tr>
        </thead>
        <tbody v-for="url in urls" :key="url.short_url">
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace dark:text-white">
                  {{ url.url }}
                </th>
                <td class="px-6 py-4">
                  {{ url.short_url }}
                </td>
                <td class="px-6 py-4">
                  <svg class="svg mt-8" viewBox="0 0 600 600" v-html="url.code"></svg>
                </td>
                <td class="px-6 py-4 text-right">
                  <div class="flex space-x-4">
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Info</a>
                    <a type="button" @click="deleteUrl(url.id)">
                      <svg class="svg-crash" viewBox="0 0 600 600">
                        <image class="fill-gray-500 w-full" href="../assets/crash.svg" />
                      </svg>
                    </a>
                  </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
</template>

<style scoped>
.svg{
  width: 5rem;
}
.svg-crash{
  width: 1.3rem;
}
</style>
