<script setup>
import Cards from '../components/Cards.vue';
import InputForm from '../components/InputForm.vue'; 

</script>

<template>
    <main class="box w-full flex justify-center">
      <div class="w-6/12 mb-8 max-xl:min-w-full max-xl:pt-5 max-md:px-5 h-auto justify-center bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <h1 class="mb-4 text-4xl text-center font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Encurtador de URLs <span class="text-blue-800 to-purple-700 font-extrabold">Short Url</span></h1>
        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">Encurte suas urls de forma prática e gratuita.</p>
        <div class="flex mx-auto items-center justify-center max-sm:mb-5">
          <a href="#" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
              Documentação
            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
            </svg>
          </a>
        </div>

      </div>
    </main>
    <div class="flex justify-evenly flex-wrap max-w-max mx-auto mb-34">
      <Cards 
        title="Histórico de urls"
        subject="No Short Url você pode guardar por quanto tempo quiser suas URLS encurtadas e seus respectivos QR Codes e utiliza-los quando quiser"  
      />

      <Cards 
        title="Sem custos"
        subject="No Short Url existem modalidades gratuittas para uso da api."  
      />

      <Cards 
        title="Api's sem a necessidade de tokens"
        subject="No Short Url existem modalidades gratuittas para uso da api."  
      />
    </div>
</template>

<style scoped>
.box{
  margin-top: 5%;
}
</style>