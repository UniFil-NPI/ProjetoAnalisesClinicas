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
            <div class="pt-24 pb-11 mx-auto max-w-6xl">
                <a class="flex md:mx-auto mb-5 max-w-max" href="#">
                    <img
                    draggable="false"
                        src="../assets/UniFil_Logo Isolado Horizontal-01.png"
                        class="h-16"
                        alt="Clinica Logo"
                    />
                    
                </a>
                <div class="flex flex-wrap justify-center gap-2 w-full">
                    <div
                        v-for="(item, i) in menuItems"
                        :key="i"
                        class="cursor-pointer gluten w-full md:w-auto p-3 md:px-6"
                    >
                        <a
                            v-scroll-to="`${item.link}`"
                            class="inline-block text-lg text-gray-500 hover:text-gray-600 font-medium"
                            >{{ item.name }}</a
                        >
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="border-b border-gray-100"></div>
        <div class="container px-4 mx-auto">
            <p
                class="py-10 md:pb-20 text-md text-gray-400 font-medium text-center"
            >
                © 2024
                <span>UniFil</span
                >
                . Todos os Direiros Reservados.
            </p>
        </div>
    </footer>
</template>
