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
    <div class="bg-gradient-to-b from-orange-50 via-transparent to-transparent  h-screen">
        <Head title="Welcome" />

        <Navbar :canLogin="canLogin" :canRegister="canRegister" />

        <section
            class="relative overflow-hidden bg-gradient-to-b from-orange-50 via-transparent to-transparent pb-12 pt-20 sm:pb-16 sm:pt-32 lg:pb-24 xl:pb-32 xl:pt-40"
        >
            <div class="relative z-10">
                <div
                    class="absolute inset-x-0 top-1/2 -z-10 flex -translate-y-1/2 justify-center overflow-hidden [mask-image:radial-gradient(50%_45%_at_50%_55%,white,transparent)]"
                >
                    <svg
                        class="h-[60rem] w-[100rem] flex-none stroke-primary opacity-20"
                        aria-hidden="true"
                    >
                        <defs>
                            <pattern
                                id="e9033f3e-f665-41a6-84ef-756f6778e6fe"
                                width="200"
                                height="200"
                                x="50%"
                                y="50%"
                                patternUnits="userSpaceOnUse"
                                patternTransform="translate(-100 0)"
                            >
                                <path d="M.5 200V.5H200" fill="none"></path>
                            </pattern>
                        </defs>
                        <svg
                            x="50%"
                            y="50%"
                            class="overflow-visible fill-blue-50"
                        >
                            <path
                                d="M-300 0h201v201h-201Z M300 200h201v201h-201Z"
                                stroke-width="0"
                            ></path>
                        </svg>
                        <rect
                            width="100%"
                            height="100%"
                            stroke-width="0"
                            fill="url(#e9033f3e-f665-41a6-84ef-756f6778e6fe)"
                        ></rect>
                    </svg>
                </div>
            </div>
            <div class="relative z-20 mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h1
                        class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl"
                    >
                        Projeto de Análises Clínicas
                        <span class="text-primary">UniFil</span>
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600 justify tex">
                        A Clínica de Exames e Testes de Paternidade da UniFil é uma unidade de saúde dedicada à realização de exames laboratoriais com especialização em análises de sangue e testes de paternidade. Com uma equipe formada por profissionais experientes e estudantes, a clínica oferece serviços de qualidade para a comunidade de Londrina e região, priorizando ética, sigilo e atendimento humanizado. Além disso, a clínica realiza testes de paternidade com tecnologias avançadas e métodos de análise de DNA, garantindo resultados confiáveis e precisos.
                    </p>
                    
                </div>
            </div>
        </section>
    </div>
    <Footer />
</template>

    <!-- <div
        class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-20 mt-10 md:mt-20 min-h-[70vh] px-6 md:px-10"
    >
        <div class="col-span-2 w-full flex flex-col text-neutral-800 justify-center items-center md:items-start gap-6 md:gap-8">
            <h2
                class="w-full text-center text-6xl font-semibold mb-6"
            >
                Projeto de Análises Clínicas
            </h2>
            <div class="w-full text-2xl text-justify">
            <img
                draggable="false"
                src="https://placehold.co/400x600"
                class="float-right ms-6 mb-6 rounded-lg w-[20%]"
            />

                <p>
                    A Clínica de Exames e Testes de Paternidade da UniFil é uma
                    unidade de saúde dedicada à realização de exames laboratoriais,
                    com especialização em análises de sangue e testes de paternidade. 
                    Localizada nas instalações da Universidade, a clínica combina o
                    conhecimento acadêmico com o atendimento de excelência, oferecendo
                    serviços de qualidade para a comunidade de Londrina e região.
                
    <br/>

                
                    Com uma equipe formada por profissionais experientes e estudantes
                    supervisionados por professores, a clínica realiza uma ampla gama
                    de exames de sangue, incluindo análises bioquímicas, hematológicas
                    e sorológicas, essenciais para o monitoramento e diagnóstico de
                    diversas condições de saúde. Além disso, a clínica também realiza
                    testes de paternidade, utilizando tecnologias avançadas e métodos de
                    análise de DNA que garantem resultados confiáveis e precisos.
           

                <br/>
                
                    A Clínica da UniFil prioriza a ética, o sigilo e o atendimento
                    humanizado, fornecendo aos pacientes todo o suporte necessário durante
                    o processo de coleta e emissão de laudos. Os serviços oferecidos são
                    acessíveis à comunidade e desempenham um papel importante no
                    desenvolvimento acadêmico dos alunos, que ganham experiência prática
                    e aprimoram suas habilidades técnicas sob orientação profissional.
                </p>
            </div>
        </div>
    </div> -->