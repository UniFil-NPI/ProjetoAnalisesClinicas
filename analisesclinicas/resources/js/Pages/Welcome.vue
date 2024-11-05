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
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-20 mt-20 min-h-[70vh] max-md:px-10 ">
        <div class="col-span-1 flex flex-col justify-center max-sm:items-center gap-8">
            <h2 class="text-3xl max-sm:text-center md:text-6xl font-extrabold leading-none">Projeto
             de Análises <br> Clínicas</h2>
            <p class="text-lg max-sm:text-justify md:text-2xl md:max-w-[70%]">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, at. Odit iusto provident quam pariatur rem quaerat delectus distinctio, commodi illo, ab ut nemo deserunt libero nostrum expedita possimus officia harum. Architecto, aut. Quis reiciendis ea numquam sed architecto quasi. Ipsa, nihil dolore facilis quas tempore, mollitia reprehenderit consequuntur ad eveniet excepturi suscipit sint quibusdam exercitationem, velit repudiandae enim officiis? Magni et fugit placeat commodi voluptas error cupiditate aperiam sit, odit id repudiandae corporis. Nobis sequi ab nisi quia? Consectetur, dolore. Eaque architecto odit minima numquam obcaecati, eos dicta veniam aliquam omnis, neque consequuntur illum sed. Commodi quisquam perspiciatis ipsum.
            </p>
        </div>
        <div class="flex md:justify-end col-span-1 md:h-full">
            <img
                draggable="false"
                src="https://placehold.co/400x600"
                class="rounded-lg md:rounded-tl-[6rem]  md:rounded-br-[6rem] rounded-tl-[4rem]  rounded-br-[4rem] shadow-md object-cover max-sm:max-w-[70%] max-sm:mx-auto"
            />
        </div>
    </div>
    <Footer/>
</template>
