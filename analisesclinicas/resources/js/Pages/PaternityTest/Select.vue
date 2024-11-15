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
                    class="px-4 py-2 font-semibold text-white rounded-lg bg-primary hover:bg-orange-300"
                >
                     <img
                        src="../../assets/voltar.png"
                        alt="Voltar"
                        class="w-5 h-5"
                    />
                </button>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="flex flex-col gap-8 p-5 bg-white shadow-md sm:rounded-lg"
                >
                    <div class="grid grid-cols-5 gap-4">
                        <h2 class="col-span-4 text-2xl font-bold">
                            Novo pedido
                        </h2>
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        <a  :href="route('paternity.create.duo')"
                            class="col-span-2 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary hover:bg-orange-300"
                        >
                            Duo
                        </a>
                        <a  :href="route('paternity.create.trio')"
                            class="col-span-2 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary hover:bg-orange-300"
                        >
                            Trio
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>