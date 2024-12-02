<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import AutoComplete from "primevue/autocomplete";
import { onMounted, onUpdated, ref, watch } from "vue";

const props = defineProps({
    flash: {
        type: Object,
        default: () => ({}),
    },
    patients: {
        type: Array,
    },
});

const form = useForm({
    cpf: "",
    participants: [{ cpf: "" }],
    lab: "",
    health_insurance: 0,
    exam_date: "",
    description: "",
});

const valuePatientInput = ref("");
const items = ref([]);

const save = () => {
    form.post("/paternitytest/store/duo");
};

const searchPatients = (event) => {
    items.value = props.patients
        .filter(
            (patient) => {
                if (patient.is_active == true){
                    return patient.patient_name
                        .toLowerCase()
                        .includes(event.query.toLowerCase()) ||
                    patient.cpf.includes(event.query.toLowerCase())
                }
            }
        )
        .map((patient) => ({
            label: `${patient.patient_name} - ${patient.cpf}`,
            value: patient.cpf,
        }));
};

const updateParticipant = (update, index) => {
    form.participants[index].cpf = value;
};

watch(valuePatientInput, (newValue) => {
    if (newValue) {
        form.cpf = newValue.value;
    }
});

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
                    @click="$inertia.visit(route('paternity.select'))"
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
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-5 gap-4">
                            <div class="flex flex-col col-span-5 gap-2">
                                <label for="cpf"
                                    >Nome ou CPF do requerente *</label
                                >

                                <div
                                    class="relative w-full h-full rounded-lg focus-within:border-blue-600 focus-within:border"
                                >
                                    <AutoComplete
                                        v-model="valuePatientInput"
                                        dropdown
                                        :suggestions="items"
                                        optionLabel="label"
                                        @complete="searchPatients"
                                        class="w-full h-full px-3 rounded-lg bg-neutral-200 autocomplete-custom"
                                    />
                                </div>

                                <span
                                    v-if="form.errors.cpf"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.cpf }}</span
                                >
                            </div>
                            <div
                                v-for="(
                                    participant, index
                                ) in form.participants"
                                :key="index"
                                class="flex flex-col col-span-5 gap-2"
                            >
                                <label :for="`cpf-${index}`"
                                    >Nome ou CPF do outro participante *</label
                                >

                                <div
                                    class="relative w-full h-full rounded-lg focus-within:border-blue-600 focus-within:border"
                                >
                                    <AutoComplete
                                        v-model="participant.cpf"
                                        dropdown
                                        :suggestions="items"
                                        optionLabel="label"
                                        @complete="searchPatients"
                                        class="w-full h-full px-3 rounded-lg bg-neutral-200 autocomplete-custom"
                                    />
                                </div>

                                <span
                                    v-if="participant.error"
                                    class="text-sm text-red-600"
                                    >{{ participant.error }}</span
                                >
                            </div>

                            <div class="flex flex-col col-span-2 gap-2">
                                <label for="name">Local de coleta *</label>
                                <input
                                    type="text"
                                    v-model="form.lab"
                                    class="border-none rounded-lg bg-neutral-200"
                                />
                                <span
                                    v-if="form.errors.lab"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.lab }}</span
                                >
                            </div>

                            <div class="flex flex-col col-span-2 gap-2">
                                <label for="name">Convênio *</label>
                                <select
                                    v-model="form.health_insurance"
                                    class="border-none rounded-lg bg-neutral-200"
                                >
                                    <option selected disabled value="0">
                                        Convênio
                                    </option>
                                    <option value="Nenhum">Nenhum</option>
                                    <option value="Unimed">Unimed</option>
                                    <option value="Hausey">Hausey</option>
                                    <option value="SUS">SUS</option>
                                    <option value="Hospitalar">
                                        Hospitalar
                                    </option>
                                    <option value="Cassi">Cassi</option>
                                    <option value="Sulamérica">
                                        Sulamérica
                                    </option>
                                </select>
                                <span
                                    v-if="form.errors.health_insurance"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.health_insurance }}</span
                                >
                            </div>

                            <div class="flex flex-col col-span-1 gap-2">
                                <label for="date">Data do Exame *</label>
                                <input
                                    type="date"
                                    v-model="form.exam_date"
                                    class="border-none rounded-lg bg-neutral-200"
                                />
                                <span
                                    v-if="form.errors.exam_date"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.exam_date }}</span
                                >
                            </div>

                            <div class="flex flex-col col-span-5 gap-2">
                                <label>Descrição do Exame *</label>
                                <textarea
                                    v-model="form.description"
                                    class="border-none rounded-lg bg-neutral-200"
                                ></textarea>
                                <span
                                    v-if="form.errors.description"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.description }}
                                </span>
                            </div>

                            <button
                                class="col-span-5 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary"
                                type="submit"
                            >
                                Criar pedido
                            </button>
                        </div>
                    </form>
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
</template>

<style>
.p-autocomplete-input {
    width: 100% !important;
}

.p-autocomplete-overlay {
    margin-top: 6px;
    background-color: #fff !important;
    width: 22.8vw;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.p-autocomplete-overlay > ul > li:hover {
    background-color: #d4d4d4 !important;
    padding-left: 3px;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}
</style>

<style scoped>
.autocomplete-custom {
    height: 2.5rem;
}
</style>
