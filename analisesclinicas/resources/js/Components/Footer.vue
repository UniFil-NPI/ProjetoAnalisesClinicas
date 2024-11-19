<script>
import { Link } from "@inertiajs/vue3";

export default {
    data() {
        return {
            menuItems: [
                {
                    name: "Política de privacidade",
                    link: "#clinica",
                },
                {
                    name: "Termos e condições",
                    link: "#contato",
                },
            ],
        };
    },
    props: {
        config: Object,
    },
    components: {
        Link,
    },
};
</script>

<template>
    <footer class="bg-white max">
        <div class="container px-4 mx-auto">
            <div class="max-w-6xl pt-24 mx-auto pb-11">
                <a class="flex mb-5 md:mx-auto max-w-max" href="#">
                    <img
                    draggable="false"
                        src="../assets/UniFil_Logo.png"
                        class="h-[75px]"
                        alt="Clinica Logo"
                    />
                    
                </a>
                <div class="flex flex-wrap justify-center w-full gap-2">
                    <div
                        v-for="(item, i) in menuItems"
                        :key="i"
                        class="w-full p-3 cursor-pointer gluten md:w-auto md:px-6"
                    >
                        <a
                            v-scroll-to="`${item.link}`"
                            class="inline-block text-lg font-medium text-gray-500 hover:text-gray-600"
                            >{{ item.name }}</a
                        >
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="border-b border-gray-100"></div>
        <div class="container px-4 mx-auto">
            <p
                class="py-10 font-medium text-center text-gray-400 md:pb-20 text-md"
            >
                © 2024
                <span>UniFil</span
                >
                . Todos os Direiros Reservados.
            </p>
        </div>
    </footer>
</template>
