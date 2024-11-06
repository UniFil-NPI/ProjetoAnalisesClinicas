<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

</script>

<template>
    <Head title="Novo Exame de Paternidade" />

    <AuthenticatedLayout>
        <template #header>
                <button
                    @click="$inertia.visit(route('paternity.index'))"
                    class="bg-primary hover:bg-orange-300 text-white px-4 py-2 rounded-lg font-semibold"
                >
                     <img
                        src="../../assets/voltar.png"
                        alt="Voltar"
                        class="w-5 h-5"
                    />
                </button>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white flex flex-col gap-8 shadow-md sm:rounded-lg p-5"
                >
                    <div class="grid grid-cols-5 gap-4">
                        <h2 class="col-span-4 text-2xl font-bold">
                            Novo pedido
                        </h2>
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        <a  :href="route('paternity.create.duo')"
                            class="col-span-2 px-4 py-2 rounded-lg bg-primary hover:bg-orange-300 text-white text-xl uppercase text-center font-semibold"
                        >
                            Duo
                        </a>
                        <a  :href="route('paternity.create.trio')"
                            class="col-span-2 px-4 py-2 rounded-lg bg-primary hover:bg-orange-300 text-white text-xl uppercase text-center font-semibold"
                        >
                            Trio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>