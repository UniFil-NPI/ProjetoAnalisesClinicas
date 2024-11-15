<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import AutoComplete from "primevue/autocomplete";
import { onMounted, onUpdated, reactive, ref, watch } from "vue";

const props = defineProps({
    flash: {
        type: Object,
        default: () => ({}),
    },
    paternityTest: {
        type: Object,
    },
});

const inputData = reactive({
    D8S1179: {
        crianca_alelo1: "14",
        crianca_alelo2: "14",
        pai_alelo1: "11",
        pai_alelo2: "14",
    },
    D21S11: {
        crianca_alelo1: "31.2",
        crianca_alelo2: "32",
        pai_alelo1: "29",
        pai_alelo2: "32",
    },
    D7S820: {
        crianca_alelo1: "9",
        crianca_alelo2: "11",
        pai_alelo1: "8",
        pai_alelo2: "9",
    },
    CSF1PO: {
        crianca_alelo1: "8",
        crianca_alelo2: "11",
        pai_alelo1: "8",
        pai_alelo2: "11",
    },
    D3S1358: {
        crianca_alelo1: "15",
        crianca_alelo2: "17",
        pai_alelo1: "15",
        pai_alelo2: "17",
    },
    THO1: {
        crianca_alelo1: "7",
        crianca_alelo2: "7",
        pai_alelo1: "6",
        pai_alelo2: "7",
    },
    D13S317: {
        crianca_alelo1: "9",
        crianca_alelo2: "13",
        pai_alelo1: "9",
        pai_alelo2: "12",
    },
    D16S539: {
        crianca_alelo1: "10",
        crianca_alelo2: "11",
        pai_alelo1: "10",
        pai_alelo2: "10",
    },
    D2S1338: {
        crianca_alelo1: "22",
        crianca_alelo2: "22",
        pai_alelo1: "18",
        pai_alelo2: "22",
    },
    D19S433: {
        crianca_alelo1: "13",
        crianca_alelo2: "13",
        pai_alelo1: "13",
        pai_alelo2: "16",
    },
    VWA: {
        crianca_alelo1: "14",
        crianca_alelo2: "17",
        pai_alelo1: "14",
        pai_alelo2: "18",
    },
    TPOX: {
        crianca_alelo1: "8",
        crianca_alelo2: "8",
        pai_alelo1: "6",
        pai_alelo2: "8",
    },
    D18S51: {
        crianca_alelo1: "13",
        crianca_alelo2: "14",
        pai_alelo1: "13",
        pai_alelo2: "17",
    },
    D5S818: {
        crianca_alelo1: "11",
        crianca_alelo2: "12",
        pai_alelo1: "9",
        pai_alelo2: "11",
    },
    FGA: {
        crianca_alelo1: "23",
        crianca_alelo2: "24",
        pai_alelo1: "23",
        pai_alelo2: "24",
    },
});

const form = useForm({
    loci: inputData,
});

const save = () => {
    form.get(`/paternitytest/duo/calc/${props.paternityTest.id}`);

};

const clearError = () => {
    props.flash.error = null;
};

if (props.flash.error) setTimeout(clearError, 5000);

onUpdated(() => {
    if (props.flash.error) setTimeout(clearError, 5000);
});
</script>

<template>
    <Head title="Novo Exame de Paternidade" />

    <AuthenticatedLayout>
        <template #header>
            <button
                @click="$inertia.visit(route('paternity.report.manage', paternityTest.id))"
                class="flex items-center px-4 py-2 font-semibold text-white rounded-lg bg-primary hover:bg-orange-300"
            >
                <img
                    src="../../assets/voltar.png"
                    alt="Voltar"
                    class="w-5 h-5 mr-2"
                />
                Voltar
            </button>
        </template>

        <div class="py-12">
            <div class="max-w-3xl p-6 mx-auto bg-white rounded-lg shadow-md">
                <h2 class="mb-6 text-2xl font-bold text-center">
                    Gerar o laudo
                </h2>

                <form @submit.prevent="save">
                    <div class="mb-6 overflow-x-auto">
                        <table class="min-w-full border border-gray-300">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 py-2 font-semibold bg-gray-100 border border-gray-300"
                                    >
                                        Marcador
                                    </th>
                                    <th
                                        colspan="2"
                                        class="px-4 py-2 font-semibold bg-gray-100 border border-gray-300"
                                    >
                                        Criança
                                    </th>
                                    <th
                                        colspan="2"
                                        class="px-4 py-2 font-semibold bg-gray-100 border border-gray-300"
                                    >
                                        Pai
                                    </th>
                                </tr>
                                <tr>
                                    <th
                                        class="px-4 py-2 bg-gray-100 border border-gray-300"
                                    ></th>
                                    <th
                                        class="px-4 py-2 bg-gray-100 border border-gray-300"
                                    >
                                        Alelo 1
                                    </th>
                                    <th
                                        class="px-4 py-2 bg-gray-100 border border-gray-300"
                                    >
                                        Alelo 2
                                    </th>
                                    <th
                                        class="px-4 py-2 bg-gray-100 border border-gray-300"
                                    >
                                        Alelo 1
                                    </th>
                                    <th
                                        class="px-4 py-2 bg-gray-100 border border-gray-300"
                                    >
                                        Alelo 2
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(items, locus) in form.loci"
                                    :key="locus"
                                >
                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        {{ locus }}
                                    </td>

                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        <input
                                            type="text"
                                            v-model="items.crianca_alelo1"
                                            required
                                            class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        />
                                    </td>
                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        <input
                                            type="text"
                                            required
                                            v-model="items.crianca_alelo2"
                                            class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        />
                                    </td>

                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        <input
                                            type="text"
                                            required
                                            v-model="items.pai_alelo1"
                                            class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        />
                                    </td>
                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        <input
                                            type="text"
                                            required
                                            v-model="items.pai_alelo2"
                                            class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button
                        type="submit"
                        class="w-full py-2 font-semibold text-white rounded-lg bg-primary hover:bg-orange-300"
                    >
                        Exibir o laudo
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>

    <div
        v-if="flash.error"
        class="fixed bottom-0 left-0 w-full px-6 py-4 text-lg text-white bg-red-500"
    >
        {{ flash.error }}
    </div>
</template>
