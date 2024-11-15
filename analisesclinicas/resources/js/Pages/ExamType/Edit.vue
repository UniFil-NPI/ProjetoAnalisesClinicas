<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { onUpdated, ref, watch } from "vue";

const props = defineProps({
    flash: {
        type: Object,
        default: () => ({}),
    },
    exam_type: Object,
});

const form = useForm({
    name: props.exam_type.name,
    components_info: JSON.parse(props.exam_type.components_info),
});

const save = () => {
    form.post("/typeofexam/update/" + props.exam_type.id, form);
};

const addComponent = () => {
    form.components_info.push({
        name: "",
        min_female: 0.0,
        max_female: 0.0,
        min_male: 0.0,
        max_male: 0.0,
        metric: "",
    });
};

const updateComponent = (index, field, value) => {
    form.components_info[index][field] = value;
};

const removeComponent = (index) => {
    form.components_info.splice(index, 1);
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
                @click="$inertia.visit(route('type.index'))"
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
                    <div class="grid grid-cols-5 gap-4">
                        <h2 class="col-span-4 text-2xl font-bold">
                            Alterar dados do tipo de exame
                        </h2>
                        <button
                            class="col-span-1 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary"
                            @click="addComponent"
                        >
                            Adicionar Componente
                        </button>
                    </div>
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-5 gap-4">
                            <div class="flex flex-col col-span-2 gap-2">
                                <label for="name">Nome do tipo de exame</label>
                                <input
                                    type="text"
                                    v-model="form.name"
                                    class="border-none rounded-lg bg-neutral-200"
                                />
                                <span
                                    v-if="form.errors.name"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.name }}</span
                                >
                            </div>

                            <div
                                v-for="(
                                    component, index
                                ) in form.components_info"
                                :key="index"
                                class="relative flex flex-col col-span-5 gap-2 pt-4"
                            >
                                <div class="grid grid-cols-3 gap-4">
                                    <div class="flex flex-col gap-2">
                                        <label for="`name-${index}`"
                                            >Nome do componente</label
                                        >
                                        <input
                                            type="text"
                                            v-model="component.name"
                                            @input="
                                                updateComponent(
                                                    index,
                                                    'name',
                                                    $event.target.value
                                                )
                                            "
                                            class="border-none rounded-lg bg-neutral-200"
                                        />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="`min_female-${index}`"
                                            >Min. Feminino</label
                                        >
                                        <input
                                            type="number"
                                            step="0.01"
                                            v-model="component.min_female"
                                            @input="
                                                updateComponent(
                                                    index,
                                                    'min_female',
                                                    $event.target.valueAsNumber
                                                )
                                            "
                                            class="border-none rounded-lg bg-neutral-200"
                                        />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="`max_female-${index}`"
                                            >Max. Feminino</label
                                        >
                                        <input
                                            type="number"
                                            step="0.01"
                                            v-model="component.max_female"
                                            @input="
                                                updateComponent(
                                                    index,
                                                    'max_female',
                                                    $event.target.valueAsNumber
                                                )
                                            "
                                            class="border-none rounded-lg bg-neutral-200"
                                        />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="`min_male-${index}`"
                                            >Min. Masculino</label
                                        >
                                        <input
                                            type="number"
                                            step="0.01"
                                            v-model="component.min_male"
                                            @input="
                                                updateComponent(
                                                    index,
                                                    'min_male',
                                                    $event.target.valueAsNumber
                                                )
                                            "
                                            class="border-none rounded-lg bg-neutral-200"
                                        />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="`max_male-${index}`"
                                            >Max. Masculino</label
                                        >
                                        <input
                                            type="number"
                                            step="0.01"
                                            v-model="component.max_male"
                                            @input="
                                                updateComponent(
                                                    index,
                                                    'max_male',
                                                    $event.target.valueAsNumber
                                                )
                                            "
                                            class="border-none rounded-lg bg-neutral-200"
                                        />
                                    </div>
                                    <div class="flex flex-col gap-2">
                                        <label for="`metric-${index}`"
                                            >Unidade de Medida</label
                                        >
                                        <input
                                            type="text"
                                            v-model="component.metric"
                                            @input="
                                                updateComponent(
                                                    index,
                                                    'metric',
                                                    $event.target.value
                                                )
                                            "
                                            class="border-none rounded-lg bg-neutral-200"
                                        />
                                    </div>
                                </div>
                                <button
                                    @click="removeComponent(index)"
                                    class="absolute top-0 right-0 z-10 p-2 mr-2 -mt-2 text-white bg-red-500 rounded-lg hover:bg-red-600"
                                >
                                    X
                                </button>
                                <hr
                                    v-if="
                                        form.components_info.length > 1 &&
                                        index != form.components_info.length - 1
                                    "
                                />
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
