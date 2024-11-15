<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { onUpdated, ref, watch } from "vue";

const props = defineProps({
    doctor: Object,
    flash: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    name: props.doctor.name,
    crm: props.doctor.crm,
});

const save = () => {
    form.post("/doctor/update/" + props.doctor.id, form);
};

const clearError = () => {
    props.flash.error = null;
};

onUpdated(() => {
    if (props.flash.error) setTimeout(clearError, 5000);
});
</script>
<template>
    <Head title="Medicos" />

    <AuthenticatedLayout>
        <template #header>
                <button
                    @click="$inertia.visit(route('doctor.index'))"
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
                    class="flex flex-col gap-5 p-5 bg-white shadow-md sm:rounded-lg"
                >
                    <h2 class="text-2xl font-bold">
                        Editar informações do médico
                    </h2>
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-5 gap-4">
                            <div class="flex flex-col col-span-3 gap-2">
                                <label for="name">Nome do médico</label>
                                <input
                                    type="text"
                                    v-model="form.name"
                                    placeholder="Nome"
                                    class="border-none rounded-lg bg-neutral-200"
                                />
                                <span
                                    v-if="form.errors.name"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.name }}</span
                                >
                            </div>

                            <div class="flex flex-col col-span-2 gap-2">
                                <label for="name">CRM</label>
                                <input
                                    type="text"
                                    v-model="form.crm"
                                    class="border-none rounded-lg bg-neutral-200"
                                />
                                <span
                                    v-if="form.errors.crm"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.crm }}</span
                                >
                            </div>

                            <button
                                type="submit"
                                class="col-span-5 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary"
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
        v-if="flash.error"
        class="fixed bottom-0 left-0 w-full px-6 py-4 text-lg text-white bg-red-500"
    >
        {{ flash.error }}
    </div>
</template>
