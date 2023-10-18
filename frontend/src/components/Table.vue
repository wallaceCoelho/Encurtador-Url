<script>
import Buttom from './Buttom.vue';
import { urlApiStore } from '../stores/url';

/*
const urls = urlApiStore().response
console.log(urls)
export default {
  components:{
    Buttom,
    urlApiStore
  },
  mounted() {
    this.getUrls()
  },
  methods: {
    getUrls() {
      const apiUrl = urlApiStore()
      apiUrl.created()
    }
  }
}
*/
</script>
<template>
  
  <ul role="list" class="divide-y divide-gray-100">

    <li v-for="url in urls" :key="url.short_url" class="flex justify-between gap-x-6 py-5">

      <div class="flex min-w-0 gap-x-4">
        <img class="h-12 w-12 flex-none rounded-full bg-gray-50" :src="url.url" alt="" />
        <div class="min-w-0 flex-auto">
          <p class="text-sm font-semibold leading-6 text-gray-900">{{ url.short_url }}</p>
          <p class="mt-1 truncate text-xs leading-5 text-gray-500">{{ url.url }}</p>
        </div>
      </div>

      <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
        <p class="text-sm leading-6 text-gray-900">{{ url.created_at }}</p>
        <p v-if="url.created_at" class="mt-1 text-xs leading-5 text-gray-500">
          Last seen <time :datetime="url.updated_at">{{ url.updated_at }}</time>
        </p>
        <div v-else class="mt-1 flex items-center gap-x-1.5">
          <div class="flex-none rounded-full bg-emerald-500/20 p-1">
            <div class="h-1.5 w-1.5 rounded-full bg-emerald-500" />
          </div>
          <p class="text-xs leading-5 text-gray-500">Online</p>
        </div>
      </div>

      <div>
        <Buttom class="max-md:-mt-0.5" text="info "/>
      </div>

    </li>
  </ul>
</template>
