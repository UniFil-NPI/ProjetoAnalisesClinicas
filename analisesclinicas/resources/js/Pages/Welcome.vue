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
    <div class="h-screen bg-gradient-to-b from-orange-50 via-transparent to-transparent">
        <Head title="Welcome" />

        <Navbar :canLogin="canLogin" :canRegister="canRegister" />

        <section
            class="relative pt-20 pb-12 overflow-hidden bg-gradient-to-b from-orange-50 via-transparent to-transparent sm:pb-16 sm:pt-32 lg:pb-24 xl:pb-32 xl:pt-40"
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
            <div class="relative z-20 px-6 mx-auto max-w-7xl lg:px-8">
                <div class="max-w-2xl mx-auto text-center">
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