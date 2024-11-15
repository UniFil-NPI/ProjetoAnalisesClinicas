<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm, usePage } from "@inertiajs/vue3";
import { ref, computed, watch, onUpdated } from "vue";

const props = defineProps({
    exam: Object,
    flash: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    file: null,
});

const page = usePage();
const user = computed(() => page.props.auth);

const uploadedFile = ref(null);

const onFileSelect = (event) => {
    const file = event.target.files[0];
    if (!file) return;

    form.file = file;
    uploadedFile.value = {
        name: file.name,
        size: file.size,
    };
};

const submitFile = () => {
    form.post(`/exam/report/store/import/${props.exam.id}`, {
        onSuccess: () => {
            form.reset("file");
            uploadedFile.value = null;
        },
    });
};

const clearError = () => {
    props.flash.error = null;
};

onUpdated(() => {
    if (props.flash.error) setTimeout(clearError, 5000);
});
</script>

<template>
    <Head title="Importar resultado da análise" />

    <AuthenticatedLayout>
        <template #header>
            <button
                @click="
                    $inertia.visit(route('exam.report.manage', props.exam.id))
                "
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
                <div class="flex flex-col p-5 bg-white shadow-md sm:rounded-lg">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold" v-if="!user.isPatient">
                            Importar resultado
                        </h2>
                    </div>
                    <form @submit.prevent="submitFile" class="mt-6">
                        <div class="flex flex-col gap-6">
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
                                        @change="onFileSelect"
                                        type="file"
                                        accept=".csv, .xlsx, .xls"
                                        class="hidden"
                                    />
                                    <span
                                        v-if="form.errors.file"
                                        class="text-sm text-red-600"
                                        >{{ form.errors.file }}</span
                                    >
                                </label>
                            </div>

                            <div v-if="uploadedFile" class="mt-4">
                                <p class="text-sm text-center">
                                    <strong>Arquivo:</strong>
                                    {{ uploadedFile.name }}
                                    <br />
                                    <strong>Tamanho:</strong>
                                    {{
                                        (uploadedFile.size / 1024).toFixed(2)
                                    }}
                                    KB
                                </p>
                            </div>

                            <button
                                class="px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary"
                                :disabled="!form.file"
                                type="submit"
                            >
                                Exibir PDF
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
