<script setup>
import { Head, Link } from "@inertiajs/vue3";
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
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-20 mt-20 min-h-[70vh] max-md:px-10 ">
        <div class="col-span-1 flex flex-col justify-center max-sm:items-center gap-8">
            <h2 class="text-3xl max-sm:text-center md:text-6xl font-extrabold leading-none">Projeto
             de Análises <br> Clínicas</h2>
            <p class="text-lg max-sm:text-justify md:text-2xl md:max-w-[70%]">
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque,
                debitis.
            </p>
            <button class="md:self-start max-sm:w-full bg-amber-400 text-neutral-50 px-6 py-2 border-2xl text-xl">
            Conhecer o Projeto</button>
        </div>
        <div class="flex md:justify-end col-span-1 md:h-full">
            <img
                draggable="false"
                src="https://placehold.co/400x600"
                class="rounded-lg md:rounded-tl-[6rem]  md:rounded-br-[6rem] rounded-tl-[4rem]  rounded-br-[4rem] shadow-md object-cover shadow-primary max-sm:max-w-[70%] max-sm:mx-auto"
            />
        </div>
    </div>
    <Footer/>
</template>
