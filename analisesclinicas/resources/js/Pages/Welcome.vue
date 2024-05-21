<script setup>
import { Head, Link } from "@inertiajs/vue3";

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
    <div class="">
        <div class="">
            <div class="">
                <header class="">
                    <div class=""></div>
                    <nav
                        v-if="canLogin"
                        class="container h-[90px] mx-auto py-[15px]"
                    >
                        <button
                            v-if="$page.props.auth.user"
                            :href="route('dashboard')"
                            class=""
                        >
                            Dashboard
                        </button>

                        <template v-else>
                            <!-- nav -->
                            <div class="flex flex-row">
                                <div class="inline-flex">
                                    <img
                                        src="../assets/UniFil_Logo Isolado Horizontal-01.png"
                                        height="60"
                                        width="200"
                                    />
                                </div>

                                <div class="grow"></div>

                                <div class="flex justify-end">
                                    <button
                                        :href="route('login')"
                                        class="h-[40px] w-[90px] my-[20px] bg-primary rounded-md text-white place-content-center text-center text-lg"
                                    >
                                        Entrar
                                    </button>
                                </div>
                            </div>

                            <!-- <Link
                                v-if="canRegister"
                                :href="route('register')"
                                class=""
                            >
                                Register
                            </Link> -->
                        </template>
                    </nav>
                </header>

                <main class="container mx-auto pt-[92px]">
                    <div class="grid grid-cols-2 gap-[170px]">
                        <div
                            class="grid grid-cols-1 gap-[28px] w-[509px] h-[457px]"
                        >
                            <div class="w-[509px] h-[165px]">
                                <p class="font-bold text-5xl">
                                    Projeto de Análises Clínicas
                                </p>
                            </div>
                            <div class="w-[470px] h-[264px]">
                                <p class="text-xl">
                                    Lorem, ipsum dolor sit amet consectetur
                                    adipisicing elit. Facere optio ratione id
                                    sapiente ea sequi iste in expedita,
                                    explicabo fugit sit voluptatum maxime velit
                                    atque assumenda. Animi, error in repellat
                                    minima quas itaque nostrum, perferendis
                                    omnis quo amet impedit ea numquam ad libero,
                                    earum sit odit hic aut. A, hic.
                                </p>
                            </div>
                        </div>
                        <div class="w-[491px] h-[515px]">
                            <img
                                src="../assets/lab.jpg"
                                class=" w-[491px] h-[515px] rounded-lg rounded-tl-[110px] object-cover"
                            />
                        </div>
                    </div>
                </main>

                <footer></footer>
            </div>
        </div>
    </div>
</template>
