<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import AutoComplete from "primevue/autocomplete";
import { onMounted, ref, watch } from "vue";

const props = defineProps({
    error: {
        type: String,
        default: null,
    },
    paternityTest: {
        type: Object,
    },
});

const form = useForm({
    D8S1179_crianca_alelo1: "",
    D8S1179_crianca_alelo2: "",
    D8S1179_pai_alelo1: "",
    D8S1179_pai_alelo2: "",

    D21S11_crianca_alelo1: "",
    D21S11_crianca_alelo2: "",
    D21S11_pai_alelo1: "",
    D21S11_pai_alelo2: "",

    D7S820_crianca_alelo1: "",
    D7S820_crianca_alelo2: "",
    D7S820_pai_alelo1: "",
    D7S820_pai_alelo2: "",

    CSF1PO_crianca_alelo1: "",
    CSF1PO_crianca_alelo2: "",
    CSF1PO_pai_alelo1: "",
    CSF1PO_pai_alelo2: "",

    D3S1358_crianca_alelo1: "",
    D3S1358_crianca_alelo2: "",
    D3S1358_pai_alelo1: "",
    D3S1358_pai_alelo2: "",

    THO1_crianca_alelo1: "",
    THO1_crianca_alelo2: "",
    THO1_pai_alelo1: "",
    THO1_pai_alelo2: "",

    D13S317_crianca_alelo1: "",
    D13S317_crianca_alelo2: "",
    D13S317_pai_alelo1: "",
    D13S317_pai_alelo2: "",

    D16S539_crianca_alelo1: "",
    D16S539_crianca_alelo2: "",
    D16S539_pai_alelo1: "",
    D16S539_pai_alelo2: "",

    D2S1338_crianca_alelo1: "",
    D2S1338_crianca_alelo2: "",
    D2S1338_pai_alelo1: "",
    D2S1338_pai_alelo2: "",

    D19S433_crianca_alelo1: "",
    D19S433_crianca_alelo2: "",
    D19S433_pai_alelo1: "",
    D19S433_pai_alelo2: "",

    VWA_crianca_alelo1: "",
    VWA_crianca_alelo2: "",
    VWA_pai_alelo1: "",
    VWA_pai_alelo2: "",

    TPOX_crianca_alelo1: "",
    TPOX_crianca_alelo2: "",
    TPOX_pai_alelo1: "",
    TPOX_pai_alelo2: "",

    D18S51_crianca_alelo1: "",
    D18S51_crianca_alelo2: "",
    D18S51_pai_alelo1: "",
    D18S51_pai_alelo2: "",

    D5S818_crianca_alelo1: "",
    D5S818_crianca_alelo2: "",
    D5S818_pai_alelo1: "",
    D5S818_pai_alelo2: "",

    FGA_crianca_alelo1: "",
    FGA_crianca_alelo2: "",
    FGA_pai_alelo1: "",
    FGA_pai_alelo2: "",
});

const markers = [
    "D8S1179", "D21S11", "D7S820", "CSF1PO", "D3S1358", "THO1", "D13S317",
    "D16S539", "D2S1338", "D19S433", "VWA", "TPOX", "D18S51", "D5S818", "FGA"
];

const errorMessage = ref(null);

const save = () => {
    form.post("/paternitytest/store");
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
                @click="$inertia.visit(route('paternity.index'))"
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
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="marker in markers"
                                    :key="marker"
                                >
                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        {{ marker }}
                                    </td>


                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        <input
                                            type="text"
                                            v-model="
                                                form[
                                                    marker + '_crianca_alelo1'
                                                ]
                                            "
                                            class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        />
                                    </td>
                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        <input
                                            type="text"
                                            v-model="
                                                form[
                                                    marker + '_crianca_alelo2'
                                                ]
                                            "
                                            class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        />
                                    </td>

                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        <input
                                            type="text"
                                            v-model="
                                                form[marker + '_pai_alelo1']
                                            "
                                            class="w-full px-2 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                                        />
                                    </td>
                                    <td
                                        class="px-4 py-2 border border-gray-300"
                                    >
                                        <input
                                            type="text"
                                            v-model="
                                                form[marker + '_pai_alelo2']
                                            "
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
