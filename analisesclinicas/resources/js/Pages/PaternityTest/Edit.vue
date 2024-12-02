<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { onUpdated, ref, watch } from "vue";

const props = defineProps({
    flash: {
        type: Object,
        default: () => ({}),
    },
    paternityTest: Object,
});

const form = useForm({
    lab: props.paternityTest.lab,
    exam_date: props.paternityTest.exam_date,
    description: props.paternityTest.description,
    health_insurance: props.paternityTest.health_insurance,
});

const save = () => {
    form.post("/paternitytest/update/" + props.paternityTest.id, form);
};

const clearError = () => {
    props.flash.error = null;
};

onUpdated(() => {
    if (props.flash.error) setTimeout(clearError, 5000);
});
</script>
<template>
    <Head title="Edição dos pedidos de teste de paternidade" />

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
                    class="flex flex-col gap-5 p-5 bg-white shadow-md sm:rounded-lg"
                >
                    <h2 class="text-2xl font-bold">
                        Editar pedido do paciente
                    </h2>
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-5 gap-4">
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
                                    >{{
                                        form.errors.name.health_insurance
                                    }}</span
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
