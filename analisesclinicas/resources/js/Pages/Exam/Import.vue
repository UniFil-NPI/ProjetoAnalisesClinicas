<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { computed, onMounted, ref, watch } from "vue";

const props = defineProps({
    exam: {
        type: Object,
    },
    error: {
        type: String,
        default: null,
    },
});

const form = useForm({
    file: null,
});
const page = usePage();
const user = computed(() => {
    return page.props.auth;
});
const errorMessage = ref(null);

const submitFile = () => {
    form.post(`/exam/${props.exam.id}/store-pdf`);
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
    <Head title="Importar resultado da análise" />

    <AuthenticatedLayout>
        <template #header>
            <button
                @click="$inertia.visit(route('exam.index'))"
                class="bg-primary hover:bg-orange-300 text-white px-4 py-2 rounded-lg font-semibold"
            >
                <img
                    src="../../assets/voltar.png"
                    alt="Voltar"
                    class="w-5 h-5"
                />
            </button>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white flex flex-col shadow-md sm:rounded-lg p-5">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold" v-if="!user.isPatient">
                            Importar resultado
                        </h2>
                    </div>
                    <form @submit.prevent="submitFile" class="mt-6">
                        <div class="col-span-1 flex flex-col gap-2">
                            <div
                                class="flex items-center justify-center w-full"
                            >
                                <label
                                    for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100"
                                >
                                    <div
                                        class="flex flex-col items-center justify-center pt-5 pb-6"
                                    >
                                        <svg
                                            class="w-8 h-8 mb-4 text-gray-500"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 20 16"
                                        >
                                            <path
                                                stroke="currentColor"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                                            />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500">
                                            <span class="font-semibold"
                                                >Clique para importar</span
                                            >
                                            ou arraste e solte
                                        </p>
                                        <p class="text-xs text-gray-500">CSV</p>
                                    </div>
                                    <input
                                        id="dropzone-file"
                                        @input="
                                            form.file = $event.target.files[0]
                                        "
                                        type="file"
                                        class="hidden"
                                    />
                                    <span
                                        v-if="form.errors.file"
                                        class="text-sm text-red-600"
                                        >{{ form.errors.file }}</span
                                    >
                                </label>
                            </div>
                            <button
                                class="col-span-5 px-4 py-2 rounded-lg bg-primary text-white text-xl uppercase text-center font-semibold"
                                type="submit"
                            >
                                Exibir pdf
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
