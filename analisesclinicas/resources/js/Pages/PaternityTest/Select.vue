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
    patients: {
        type: Array,
    },
});

const form = useForm({
    cpf: "",
    participants: [],
    lab: "",
    health_insurance: 0,
    exam_date: "",
    description: "",
});

const valuePatientInput = ref("");
const items = ref([]);

const errorMessage = ref(null);

const save = () => {
    form.post("/create/new/paternitytest");
    errorMessage.value = props.error;
};

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
const addParticipant = () => {
    form.participants.push({ cpf: "", error: null });
};
const updateParticipant = (update, index) => {
    form.participants[index].cpf = value;
};

const clearError = () => {
    errorMessage.value = null;
};

watch(valuePatientInput, (newValue) => {
    if (newValue) {
        form.cpf = newValue.value;
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
    <Head title="Novo Exame de Paternidade" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Exame de Paternidade
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white flex flex-col gap-8 shadow-sm shadow-primary sm:rounded-lg p-5"
                >
                    <div class="grid grid-cols-5 gap-4">
                        <h2 class="col-span-4 text-2xl font-bold">
                            Novo pedido
                        </h2>
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        <a  :href="route('paternity.create.duo')"
                            class="col-span-2 px-4 py-2 rounded-lg bg-primary text-white text-xl uppercase text-center font-semibold"
                        >
                            Duo
                        </a>
                        <a  :href="route('paternity.create.trio')"
                            class="col-span-2 px-4 py-2 rounded-lg bg-primary text-white text-xl uppercase text-center font-semibold"
                        >
                            Trio
                        </a>
                    </div>
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
