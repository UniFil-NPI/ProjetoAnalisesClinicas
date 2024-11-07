<script setup>
import { Head } from "@inertiajs/vue3";
import Navbar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <Navbar :canLogin="canLogin" :canRegister="canRegister" />
    <div
        class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-20 mt-10 md:mt-20 min-h-[70vh] px-6 md:px-10"
    >
        <div class="col-span-1 flex flex-col justify-center items-center md:items-start gap-6 md:gap-8">
            <h2
                class="text-3xl md:text-5xl lg:text-6xl font-extrabold leading-tight text-center md:text-left text-gray-800"
            >
                Projeto de Análises <br />
                Clínicas
            </h2>
            <div class="text-lg md:text-xl lg:text-2xl md:max-w-[85%] lg:max-w-[90%] leading-relaxed space-y-6 text-gray-700">
                <p class="text-center md:text-left">
                    A Clínica de Exames e Testes de Paternidade da UniFil é uma
                    unidade de saúde dedicada à realização de exames laboratoriais,
                    com especialização em análises de sangue e testes de paternidade. 
                    Localizada nas instalações da Universidade, a clínica combina o
                    conhecimento acadêmico com o atendimento de excelência, oferecendo
                    serviços de qualidade para a comunidade de Londrina e região.
                </p>
                <p class="text-center md:text-left">
                    Com uma equipe formada por profissionais experientes e estudantes
                    supervisionados por professores, a clínica realiza uma ampla gama
                    de exames de sangue, incluindo análises bioquímicas, hematológicas
                    e sorológicas, essenciais para o monitoramento e diagnóstico de
                    diversas condições de saúde. Além disso, a clínica também realiza
                    testes de paternidade, utilizando tecnologias avançadas e métodos de
                    análise de DNA que garantem resultados confiáveis e precisos.
                </p>
                <p class="text-center md:text-left">
                    A Clínica da UniFil prioriza a ética, o sigilo e o atendimento
                    humanizado, fornecendo aos pacientes todo o suporte necessário durante
                    o processo de coleta e emissão de laudos. Os serviços oferecidos são
                    acessíveis à comunidade e desempenham um papel importante no
                    desenvolvimento acadêmico dos alunos, que ganham experiência prática
                    e aprimoram suas habilidades técnicas sob orientação profissional.
                </p>
            </div>
        </div>
        <div class="flex justify-center md:justify-end col-span-1">
            <img
                draggable="false"
                src="https://placehold.co/400x600"
                class="rounded-xl shadow-lg object-cover w-full max-w-[400px] max-h-[600px] h-auto transform transition-transform duration-500 ease-in-out hover:scale-105"
            />
        </div>
    </div>
    <Footer />
</template>

