<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { computed, onMounted, onUpdated, ref, watch } from "vue";

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
const goBack = () => {
  if (typeof window !== 'undefined') {
    window.history.back();
  }
}
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
    <Head title="Novo Exame de Paternidade" />

    <AuthenticatedLayout>
        <template #header>
            <button
                @click="goBack"
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
                <div
                    class="bg-white flex flex-col gap-8 shadow-md sm:rounded-lg p-5"
                >
                    <div class="grid grid-cols-5 gap-4">
                        <h2 class="col-span-4 text-2xl font-bold">
                            Gerenciar Laudo
                        </h2>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <a
                            :href="route('exam.import', exam.id)"
                            class="col-span-1 px-4 py-2 rounded-lg bg-primary hover:bg-orange-300 text-white text-xl uppercase text-center font-semibold"
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
                            class="col-span-1 px-4 py-2 rounded-lg bg-primary hover:bg-orange-300 text-white text-xl uppercase text-center font-semibold"
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
                            class="col-span-1 px-4 py-2 rounded-lg bg-primary hover:bg-orange-300 text-white text-xl uppercase text-center font-semibold"
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
        class="fixed bottom-0 left-0 w-full bg-red-500 text-white text-lg py-4 px-6 text-center"
    >
        {{ errorMessage }}
    </div>
    <div
        v-if="message"
        class="w-full py-4 px-6 bg-green-500 text-white text-lg fixed bottom-0 left-0"
    >
        {{ message }}
    </div>
</template>
