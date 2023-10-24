<script setup>
import Buttom from './Buttom.vue'
import { urlApiStore } from '../stores/url'
import { onMounted , computed } from 'vue'

const store = urlApiStore()
let urls = computed(() => store.url)

onMounted(async () => {
  try {
    await store.getUrl()
  } catch (error) {
    console.error('Erro ao carregar os dados:', error)
  }
})

console.log(urls)

</script>
<template>
  
  <ul role="list" class="divide-y divide-gray-100">

    <li v-for="url in urls" :key="url.short_url" class="flex justify-between gap-x-6 py-5">

      <div class="flex min-w-0 gap-x-4">
        <div class="flex-none w-1/2">
          <svg class="svg my-auto" viewBox="0 0 600 600" v-html="url.code"></svg>
        </div>
        <!--img class="h-12 w-12 flex-none rounded-full bg-gray-50" :src="url.code" alt="" /-->
        <div class="flex-auto items-start">
          <p class="text-sm truncate font-semibold leading-6 text-gray-900">{{ url.short_url }}</p>
          <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ url.url }}</p>
        </div>
      </div>

      <div>
        <Buttom class="max-md:-mt-0.5" text="info "/>
      </div>

    </li>
  </ul>
</template>

<style scoped>
.svg{
  width: 40%;
}
</style>
