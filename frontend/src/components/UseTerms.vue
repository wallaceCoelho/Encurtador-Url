<script setup>
import Buttom from './Buttom.vue'
import { initFlowbite } from 'flowbite'
import { onMounted } from 'vue'

onMounted(() => {
    initFlowbite();
})

</script>

<template>
 
<a type="button" data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block cursor-pointer py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-800 to-purple-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700" onclick="my_modal_4.showModal()">Termos de Uso</a>

<div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-hidden md:inset-0 h-[calc(80%-1rem)] max-h-full">
    <div class="modalScroll relative w-full max-w-2xl max-h-full overflow-y-scroll pb-8">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Política de Uso
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Fechar</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6 text-justify">
                <h2 class="text-xl font-semibold mb-2">1. Introdução</h2>
                <p class="text-base leading-relaxed mb-2 text-gray-500 dark:text-gray-400">
                    A política de uso do encurtador de URL com autenticação tem como objetivo estabelecer as diretrizes e regras para o uso responsável e seguro dos serviços fornecidos por este encurtador de URL. A autenticação é necessária para garantir a identificação dos usuários e rastrear o uso da plataforma.                
                </p>
                <h2 class="text-xl font-semibold mb-2">2. Registro e Autenticação</h2>
                <p class="text-base leading-relaxed mb-2 text-gray-500 dark:text-gray-400">
                    2.1. Todos os usuários devem se registrar na plataforma para obter acesso ao serviço de encurtamento de URL.
                    2.2. A autenticação é obrigatória para todos os usuários, e informações de identificação precisas devem ser fornecidas no momento do registro.
                    2.3. Os usuários são responsáveis por manter suas credenciais de autenticação seguras e não devem compartilhá-las com terceiros.
                </p>
                <h2 class="text-xl font-semibold mb-2">2. Registro e Autenticação</h2>
                <p class="text-base leading-relaxed mb-2 text-gray-500 dark:text-gray-400">
                    3.1. O serviço de encurtamento de URL só deve ser usado para links e conteúdos legais e éticos.
                    3.2. Não é permitido o uso do serviço para links que promovam ou contenham qualquer forma de:
                </p>
                <ul class="text-base space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                    <li>Conteúdo ilegal, incluindo pirataria, hacking, ou atividades criminosas.</li>
                    <li>Conteúdo ofensivo, difamatório, discriminatório ou ameaçador.</li>
                    <li>Conteúdo adulto, pornográfico ou sexualmente explícito.</li>
                    <li>Spam ou links enganosos.</li>
                    <li>Vírus, malware ou qualquer forma de software malicioso.</li>
                </ul>

                <h2 class="text-xl font-semibold mb-2">4. Monitoramento e Cumprimento</h2>
                <p class="text-base leading-relaxed mb-2 text-gray-500 dark:text-gray-400">
                    4.1. A plataforma se reserva o direito de monitorar o uso dos serviços e tomar medidas corretivas em caso de violação desta política.
                    4.2. Em caso de suspeita de atividade ilegal ou não conforme, a administração do serviço poderá suspender ou encerrar a conta do usuário sem aviso prévio.
                </p>

                <h2 class="text-xl font-semibold mb-2">5. Rastreamento de URLs encurtadas</h2>
                <p class="text-base leading-relaxed mb-2 text-gray-500 dark:text-gray-400">
                    5.1. Os URLs encurtados fornecidos por esta plataforma podem ser rastreados para fins de análise de uso. Isso inclui informações como o número de cliques, localização geográfica dos cliques e datas e horários.
                </p>

                <h2 class="text-xl font-semibold mb-2">6. Privacidade dos Dados</h2>
                <p class="text-base leading-relaxed mb-2 text-gray-500 dark:text-gray-400">
                    6.1. Os dados dos usuários, incluindo informações de autenticação e URLs encurtados, serão tratados de acordo com nossa política de privacidade.
                    6.2. Não compartilharemos dados de usuários com terceiros sem o consentimento expresso dos mesmos, a menos que seja exigido por lei.
                </p>

                <h2 class="text-xl font-semibold mb-2">7. Alterações na Política de Uso</h2>
                <p class="text-base leading-relaxed mb-2 text-gray-500 dark:text-gray-400">
                    6.1. Os dados dos usuários, incluindo informações de autenticação e URLs encurtados, serão tratados de acordo com nossa política de privacidade.
                    6.2. Não compartilharemos dados de usuários com terceiros sem o consentimento expresso dos mesmos, a menos que seja exigido por lei.
                </p>

                <h2 class="text-xl font-semibold mb-2">8. Consequências de Violação</h2>
                <p class="text-base leading-relaxed mb-2 text-gray-500 dark:text-gray-400">
                    8.1. O não cumprimento desta política pode resultar em medidas disciplinares, incluindo suspensão ou encerramento da conta do usuário.    
                </p>

                <h2 class="text-xl font-semibold mb-2">9. Contato</h2>
                <p class="text-base leading-relaxed mb-2 text-gray-500 dark:text-gray-400">
                    9.1. Em caso de dúvidas, sugestões ou relatos de violação desta política, os usuários podem entrar em contato com a equipe de suporte por meio dos canais de comunicação fornecidos no site.
                    Esta política de uso visa garantir um ambiente seguro e responsável para todos os usuários do encurtador de URL com autenticação. O não cumprimento das diretrizes estabelecidas nesta política pode resultar em ações apropriadas, conforme necessário.    
                </p>

            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <Buttom text="Aceitar" data-modal-hide="defaultModal" />
            </div>
        </div>
    </div>
</div>

</template>

<style scoped>
.modalScroll{
    margin-top: 5%;
}
</style>