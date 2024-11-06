<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import { computed, onMounted, onUpdated, ref, watch } from "vue";

const props = defineProps({
    error: {
        type: String,
        default: null,
    },
    paternityTest: {
        type: Object,
    },
});

const errorMessage = ref(null);

onMounted(() => {
    router.on("finish", () => {
        errorMessage.value = props.error;
        if (errorMessage.value) {
            setTimeout(clearError, 5000);
        }
    });
});

const clickDownload = () => {
    router.get(route("paternity.report.download", props.paternityTest.id), {
        preserveState: "error",
    });
};

const clickRemove = () => {
    router.get(route("paternity.report.remove", props.paternityTest.id), {
        preserveState: "error",
    });
};

const participants = ref(JSON.parse(props.paternityTest.participants));

const clearError = () => {
    errorMessage.value = null;
};

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
                @click="$inertia.visit(route('paternity.index'))"
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
                            :href="
                                route(
                                    'paternity.report.create.trio',
                                    props.paternityTest.id
                                )
                            "
                            v-if="participants.length == 2"
                            class="col-span-1 px-4 py-2 rounded-lg bg-primary hover:bg-orange-300 text-white text-xl uppercase text-center font-semibold"
                        >
                            Gerar Laudo
                        </a>
                        <a
                            :href="
                                route(
                                    'paternity.report.create.duo',
                                    props.paternityTest.id
                                )
                            "
                            v-if="participants.length == 1"
                            class="col-span-1 px-4 py-2 rounded-lg bg-primary hover:bg-orange-300 text-white text-xl uppercase text-center font-semibold"
                        >
                            Gerar Laudo
                        </a>
                        <button
                            @click.prevent="clickDownload"
                            class="col-span-1 px-4 py-2 rounded-lg bg-primary hover:bg-orange-300 text-white text-xl uppercase text-center font-semibold"
                        >
                            Baixar
                        </button>
                        <button
                            @click.prevent="clickRemove"
                            class="col-span-1 px-4 py-2 rounded-lg bg-primary hover:bg-orange-300 text-white text-xl uppercase text-center font-semibold"
                        >
                            Remover laudo
                        </button>
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
</template>
