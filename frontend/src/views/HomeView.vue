<script setup>
import Cards from '../components/Cards.vue';
import InputForm from '../components/InputForm.vue';

</script>

<template>
    <main class="box w-full flex justify-center">
      <div class="w-6/12 max-xl:min-w-full max-xl:pt-5 max-md:px-5 h-auto justify-center bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
        <InputForm />
      </div>
    </main>
    <div class="w-full text-center my-16">
      <p class="text-4xl font-medium text-gray-900 dark:text-white">Por quê utilizar o <span class="text-blue-800 to-purple-700 font-medium">Short Url?</span></p>
    </div>
    <div class="flex justify-evenly flex-wrap max-w-max mx-auto mb-14">
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
  margin-top: 10%;
}
</style>