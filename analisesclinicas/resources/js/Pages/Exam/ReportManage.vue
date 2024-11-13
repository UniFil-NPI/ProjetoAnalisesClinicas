<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    flash: {
        type: Object,
        default: () => ({}),
    },
    error: {
        type: String,
        default: null,
    },
    exam: {
        type: Object,
    },
});

const errorMessage = ref(props.error || null);
const message = ref(props.flash?.message || null);

const clearMessage = () => {
    message.value = null;
};

const clearError = () => {
    errorMessage.value = null;
};

if (message.value) setTimeout(clearMessage, 5000);
if (errorMessage.value) setTimeout(clearError, 5000);

watch(
    () => props.error,
    (newError) => {
        errorMessage.value = newError;
        if (newError) {
            setTimeout(clearError, 5000);
        }
    }
);
</script>

<template>
    <Head title="Gerenciamento de laudos" />

    <AuthenticatedLayout>
        <template #header>
            <button
                @click="$inertia.visit(route('exam.index'))"
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
                            Gerenciar Laudo
                        </h2>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <a
                            :href="route('exam.import', exam.id)"
                            class="col-span-1 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary hover:bg-orange-300"
                        >
                            Gerar Laudo
                        </a>
                        <a
                            :href="
                                route(
                                    'exam.report.download',
                                    exam.id
                                )
                            "
                            class="col-span-1 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary hover:bg-orange-300"
                        >
                            Baixar
                        </a>
                        <a
                            :href="
                                route(
                                    'exam.report.remove',
                                    exam.id
                                )
                            "
                            class="col-span-1 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary hover:bg-orange-300"
                        >
                            Remover laudo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
    <div
        v-if="errorMessage"
        class="fixed bottom-0 left-0 w-full px-6 py-4 text-lg text-center text-white bg-red-500"
    >
        {{ errorMessage }}
    </div>
    <div
        v-if="message"
        class="fixed bottom-0 left-0 w-full px-6 py-4 text-lg text-white bg-green-500"
    >
        {{ message }}
    </div>
</template>
