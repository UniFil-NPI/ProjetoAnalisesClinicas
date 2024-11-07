<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import AutoComplete from "primevue/autocomplete";
import { onMounted, reactive, ref, watch } from "vue";

const props = defineProps({
    error: {
        type: String,
        default: null,
    },
    paternityTest: {
        type: Object,
    },
});

const inputData = reactive({
    D8S1179: {
        mae_alelo1: "14",
        mae_alelo2: "15",
        crianca_alelo1: "14",
        crianca_alelo2: "14",
        pai_alelo1: "11",
        pai_alelo2: "14",
    },
    D21S11: {
        mae_alelo1: "30",
        mae_alelo2: "31.2",
        crianca_alelo1: "31.2",
        crianca_alelo2: "32",
        pai_alelo1: "29",
        pai_alelo2: "32",
    },
    D7S820: {
        mae_alelo1: "8",
        mae_alelo2: "11",
        crianca_alelo1: "9",
        crianca_alelo2: "11",
        pai_alelo1: "8",
        pai_alelo2: "9",
    },
    CSF1PO: {
        mae_alelo1: "11",
        mae_alelo2: "12",
        crianca_alelo1: "8",
        crianca_alelo2: "11",
        pai_alelo1: "8",
        pai_alelo2: "11",
    },
    D3S1358: {
        mae_alelo1: "14",
        mae_alelo2: "15",
        crianca_alelo1: "15",
        crianca_alelo2: "17",
        pai_alelo1: "15",
        pai_alelo2: "17",
    },
    THO1: {
        mae_alelo1: "7",
        mae_alelo2: "7",
        crianca_alelo1: "7",
        crianca_alelo2: "7",
        pai_alelo1: "6",
        pai_alelo2: "7",
    },
    D13S317: {
        mae_alelo1: "12",
        mae_alelo2: "13",
        crianca_alelo1: "9",
        crianca_alelo2: "13",
        pai_alelo1: "9",
        pai_alelo2: "12",
    },
    D16S539: {
        mae_alelo1: "11",
        mae_alelo2: "12",
        crianca_alelo1: "10",
        crianca_alelo2: "11",
        pai_alelo1: "10",
        pai_alelo2: "10",
    },
    D2S1338: {
        mae_alelo1: "21",
        mae_alelo2: "22",
        crianca_alelo1: "22",
        crianca_alelo2: "22",
        pai_alelo1: "18",
        pai_alelo2: "22",
    },
    D19S433: {
        mae_alelo1: "12",
        mae_alelo2: "13",
        crianca_alelo1: "13",
        crianca_alelo2: "13",
        pai_alelo1: "13",
        pai_alelo2: "16",
    },
    VWA: {
        mae_alelo1: "17",
        mae_alelo2: "18",
        crianca_alelo1: "14",
        crianca_alelo2: "17",
        pai_alelo1: "14",
        pai_alelo2: "18",
    },
    TPOX: {
        mae_alelo1: "8",
        mae_alelo2: "8",
        crianca_alelo1: "8",
        crianca_alelo2: "8",
        pai_alelo1: "6",
        pai_alelo2: "8",
    },
    D18S51: {
        mae_alelo1: "14",
        mae_alelo2: "15",
        crianca_alelo1: "13",
        crianca_alelo2: "14",
        pai_alelo1: "13",
        pai_alelo2: "17",
    },
    D5S818: {
        mae_alelo1: "12",
        mae_alelo2: "13",
        crianca_alelo1: "11",
        crianca_alelo2: "12",
        pai_alelo1: "9",
        pai_alelo2: "11",
    },
    FGA: {
        mae_alelo1: "23",
        mae_alelo2: "25",
        crianca_alelo1: "23",
        crianca_alelo2: "24",
        pai_alelo1: "23",
        pai_alelo2: "24",
    },
});

const form = useForm({
    loci: inputData,
});

const errorMessage = ref(null);

const save = () => {
    form.get(`/paternitytest/trio/calc/${props.paternityTest.id}`);
    errorMessage.value = props.error;
};

const clearError = () => {
    errorMessage.value = null;
};

watch(
    () => props.error,
    (newError) => {
        errorMessage.value = newError;
    }
);

watch(
    () => errorMessage.value,
    (newError) => {
        errorMessage.value = newError;
        if (newError) {
            setTimeout(clearError, 5000);
        }
    }
);
</script>

<template>
    <Head title="Novo Exame de Paternidade" />

    <AuthenticatedLayout>
        <template #header>
            <button
                @click="$inertia.visit(route('paternity.report.manage', paternityTest.id))"
                class="bg-primary hover:bg-orange-300 text-white px-4 py-2 rounded-lg font-semibold flex items-center"
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
            <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-center mb-6">
                    Gerar o laudo
                </h2>

                <form @submit.prevent="save">
                    <div class="overflow-x-auto mb-6">
                        <table class="min-w-full border border-gray-300">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 py-2 border border-gray-300 bg-gray-100 font-semibold"
                                    >
                                        Marcador
                                    </th>
                                    <th
                                        colspan="2"
                                        class="px-4 py-2 border border-gray-300 bg-gray-100 font-semibold"
                                    >
                                        Mãe
                                    </th>
                                    <th
                                        colspan="2"
                                        class="px-4 py-2 border border-gray-300 bg-gray-100 font-semibold"
                                    >
                                        Criança
                                    </th>
                                    <th
                                        colspan="2"
                                        class="px-4 py-2 border border-gray-300 bg-gray-100 font-semibold"
                                    >
                                        Pai
                                    </th>
                                </tr>
                                <tr>
                                    <th
                                        class="px-4 py-2 border border-gray-300 bg-gray-100"
                                    ></th>
                                    <th
                                        class="px-4 py-2 border border-gray-300 bg-gray-100"
                                    >
                                        Alelo 1
                                    </th>
                                    <th
                                        class="px-4 py-2 border border-gray-300 bg-gray-100"
                                    >
                                        Alelo 2
                                    </th>
                                    <th
                                        class="px-4 py-2 border border-gray-300 bg-gray-100"
                                    >
                                        Alelo 1
                                    </th>
                                    <th
                                        class="px-4 py-2 border border-gray-300 bg-gray-100"
                                    >
                                        Alelo 2
                                    </th>
                                    <th
                                        class="px-4 py-2 border border-gray-300 bg-gray-100"
                                    >
                                        Alelo 1
                                    </th>
                                    <th
                                        class="px-4 py-2 border border-gray-300 bg-gray-100"
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
                                            v-model="items.mae_alelo1"
                                            required
                                            class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        />
                                    </td>
                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        <input
                                            type="text"
                                            v-model="items.mae_alelo2"
                                            required
                                            class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        />
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
                                            v-model="items.crianca_alelo2"
                                            required
                                            class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        />
                                    </td>

                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        <input
                                            type="text"
                                            v-model="items.pai_alelo1"
                                            required
                                            class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        />
                                    </td>
                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        <input
                                            type="text"
                                            v-model="items.pai_alelo2"
                                            required
                                            class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-primary hover:bg-orange-300 text-white font-semibold py-2 rounded-lg"
                    >
                        Exibir o laudo
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>

    <div
        v-if="errorMessage"
        class="fixed bottom-0 left-0 w-full bg-red-500 text-white text-lg py-4 px-6 text-center"
    >
        {{ errorMessage }}
    </div>
</template>
