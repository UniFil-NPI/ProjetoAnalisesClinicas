<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { computed, onMounted, onUpdated, ref, watch } from "vue";

const props = defineProps({
    flash: {
        type: Object,
        default: () => ({}),
    },
    paternityTest: {
        type: Object,
    },
});

const participants = ref(JSON.parse(props.paternityTest.participants));

const clearMessage = () => {
    props.flash.message = null;
};

const clearError = () => {
    props.flash.error = null;
};

if (props.flash.message) setTimeout(clearMessage, 5000);
if (props.flash.error) setTimeout(clearError, 5000);

onUpdated(() => {
    if (props.flash.error) setTimeout(clearError, 5000);
    if (props.flash.message) setTimeout(clearMessage, 5000);
});
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
                            Gerenciar Laudo
                        </h2>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <a
                            v-if="participants.length == 1"
                            :href="
                                route(
                                    'paternity.report.create.duo',
                                    paternityTest.id
                                )
                            "
                            class="col-span-1 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary hover:bg-orange-300"
                        >
                            Gerar Laudo
                        </a>
                        <a
                            v-if="participants.length == 2"
                            :href="
                                route(
                                    'paternity.report.create.trio',
                                    paternityTest.id
                                )
                            "
                            class="col-span-1 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary hover:bg-orange-300"
                        >
                            Gerar Laudo
                        </a>
                        <a
                            :href="
                                route(
                                    'paternity.report.download',
                                    paternityTest.id
                                )
                            "
                            class="col-span-1 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary hover:bg-orange-300"
                        >
                            Baixar
                        </a>
                        <a
                            :href="
                                route(
                                    'paternity.report.remove',
                                    paternityTest.id
                                )
                            "
                            class="col-span-1 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary hover:bg-orange-300"
                        >
                            Remover laudo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
    <div
        v-if="flash.error"
        class="fixed bottom-0 left-0 w-full px-6 py-4 text-lg text-white bg-red-500"
    >
        {{ flash.error }}
    </div>
    <div
        v-if="flash.message"
        class="fixed bottom-0 left-0 w-full px-6 py-4 text-lg text-white bg-green-500"
    >
        {{ flash.message }}
    </div>
</template>
