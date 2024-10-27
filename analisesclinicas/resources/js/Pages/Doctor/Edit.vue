<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    doctor: Object,
    error: {
        type: String,
        default: null,
    },
});

const form = useForm({
    name: props.doctor.name,
    crm: props.doctor.crm,
});

const showError = ref(true);

const save = () => {
    form.post("/doctor/update/" + props.doctor.id, form);
};

watch(
    () => {
        props.error;
    },
    (newValue) => {
        if (newValue == null) {
            showError.value = false;

            setTimeout(() => {
                showError.value = true;
            }, 2000);
        }
    }
);
</script>
<template>
    <Head title="Medicos" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Médicos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white flex flex-col gap-5 shadow-sm shadow-primary sm:rounded-lg p-5"
                >
                    <h2 class="text-2xl font-bold">
                        Editar informações do médico
                    </h2>
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-5 gap-4">
                            <div class="col-span-3 flex flex-col gap-2">
                                <label for="name">Nome do médico</label>
                                <input
                                    type="text"
                                    v-model="form.name"
                                    placeholder="Nome"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.name"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.name }}</span
                                >
                            </div>

                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="name">CRM</label>
                                <input
                                    type="text"
                                    v-model="form.crm"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.crm"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.crm }}</span
                                >
                            </div>

                            <button
                                type="submit"
                                class="px-4 py-2 rounded-lg bg-primary text-white col-span-5 text-xl uppercase text-center font-semibold"
                            >
                                Salvar alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <div
        v-if="error && showError"
        class="w-full py-4 px-6 bg-red-500 text-white text-lg fixed bottom-0 left-0"
    >
        {{ error }}
    </div>
</template>
