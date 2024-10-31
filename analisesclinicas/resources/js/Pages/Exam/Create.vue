<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import AutoComplete from "primevue/autocomplete";
import { ref, watch } from "vue";

const props = defineProps({
    error: {
        type: String,
        default: null,
    },
    patients: {
        type: Array,
    },
    doctors: {
        type: Array,
    },
    examTypes: {
        type: Array,
    },
});

const form = useForm({
    cpf: "",
    crm: "",
    exam_type_name: "",   
    lab: "",
    health_insurance: 0,
    exam_date: "",
    description: "",
});
const errorMessage = ref(null);
const valuePatientInput = ref("");
const valueDoctorInput = ref("");
const valueTypeInput = ref("");
const items = ref([]);

const searchPatients = (event) => {
    items.value = props.patients
        .filter(
            (patient) =>
                patient.patient_name
                    .toLowerCase()
                    .includes(event.query.toLowerCase()) ||
                patient.cpf.includes(event.query.toLowerCase())
        )
        .map((patient) => ({
            label: `${patient.patient_name} - ${patient.cpf}`,
            value: patient.cpf,
        }));
};

const searchDoctors = (event) => {
    items.value = props.doctors
        .filter(
            (doctor) =>
                doctor.name.toLowerCase().includes(event.query.toLowerCase()) ||
                doctor.crm.toLowerCase().includes(event.query.toLowerCase())
        )
        .map((doctor) => ({
            label: `${doctor.name} - ${doctor.crm}`,
            value: doctor.crm,
        }));
};

const searchExamTypes = (event) => {
    items.value = props.examTypes
        .filter(
            (type) =>
                type.name.toLowerCase().includes(event.query.toLowerCase())
        )
        .map((type) => ({
            label: `${type.name}`,
            value: type.name,
        }));
};

const save = () => {
    form.post("/create/new/exam");
    errorMessage.value = props.error;
};

const clearError = () => {
    errorMessage.value = null;
};

watch(valueTypeInput, (newValue) => {
    if (newValue) {
        form.exam_type_name = newValue.value;
    }
});

watch(valuePatientInput, (newValue) => {
    if (newValue) {
        form.cpf = newValue.value;
    }
});

watch(valueDoctorInput, (newValue) => {
    if (newValue) {
        form.crm = newValue.value;
    }
});

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
    <Head title="Novo Paciente" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Exames
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white flex flex-col gap-8 shadow-sm shadow-primary sm:rounded-lg p-5"
                >
                    <h2 class="text-2xl font-bold">Novo Exame</h2>
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-5 gap-4">
                            <div class="col-span-3 flex flex-col gap-2">
                                <label for="cpf">Nome ou CPF do paciente</label>

                                <div
                                    class="focus-within:border-blue-600 focus-within:border h-full rounded-lg w-full relative"
                                >
                                    <AutoComplete
                                        v-model="valuePatientInput"
                                        :suggestions="items"
                                        optionLabel="label"
                                        @complete="searchPatients"
                                        class="bg-neutral-200 rounded-lg w-full h-full px-3 autocomplete-custom"
                                    />
                                </div>

                                <span
                                    v-if="form.errors.cpf"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.cpf }}</span
                                >
                            </div>

                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="name">Nome ou CRM do médico</label>
                                <div
                                    class="focus-within:border-blue-600 focus-within:border h-full rounded-lg w-full relative"
                                >
                                    <AutoComplete
                                        v-model="valueDoctorInput"
                                        :suggestions="items"
                                        optionLabel="label"
                                        @complete="searchDoctors"
                                        class="bg-neutral-200 rounded-lg w-full h-full px-3 autocomplete-custom"
                                    />
                                </div>
                                <span
                                    v-if="form.errors.crm"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.crm }}</span
                                >
                            </div>

                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="name">Tipo de exame</label>
                                <div
                                    class="focus-within:border-blue-600 focus-within:border h-full rounded-lg w-full relative"
                                >
                                    <AutoComplete
                                        v-model="valueTypeInput"
                                        :suggestions="items"
                                        optionLabel="label"
                                        @complete="searchExamTypes"
                                        class="bg-neutral-200 rounded-lg w-full h-full px-3 autocomplete-custom"
                                    />
                                </div>
                                <span
                                    v-if="form.errors.exam_type_name"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.exam_type_name }}</span
                                >
                            </div>

                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">Local de coleta</label>
                                <input
                                    type="text"
                                    v-model="form.lab"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.lab"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.lab }}</span
                                >
                            </div>

                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">Convênio</label>
                                <select
                                    v-model="form.health_insurance"
                                    class="bg-neutral-200 border-none rounded-lg"
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

                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="date">Data do Exame</label>
                                <input
                                    type="date"
                                    v-model="form.exam_date"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.exam_date"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.exam_date }}</span
                                >
                            </div>

                            <div class="col-span-5 flex flex-col gap-2">
                                <label>Descrição do Exame</label>
                                <textarea
                                    v-model="form.description"
                                    class="bg-neutral-200 border-none rounded-lg"
                                ></textarea>
                                <span
                                    v-if="form.errors.description"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.description }}
                                </span>
                            </div>

                            <button
                                class="col-span-5 px-4 py-2 rounded-lg bg-primary text-white text-xl uppercase text-center font-semibold"
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
        v-if="errorMessage"
        class="w-full py-4 px-6 bg-red-500 text-white text-lg fixed bottom-0 left-0"
    >
        {{ errorMessage }}
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
