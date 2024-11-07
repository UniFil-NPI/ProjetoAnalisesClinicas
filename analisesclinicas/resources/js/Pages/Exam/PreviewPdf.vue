<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    info: Object,
    components: Array,
    exam: Object,
    error: {
        type: String,
        default: null,
    },
});

const currentDate = ref(
    new Date().toLocaleDateString("pt-BR", {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
    })
);

const form = useForm({
    info: props.info,
    components: props.components,
    conclusion: "",
});

const generatePdf = () => {
    form.post(`/exam/report/store/${props.exam.id}`);
};

const errorMessage = ref(null);

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
    <Head title="Pré-visualizar Laudo" />

    <AuthenticatedLayout>
        <template #header>
            <button
                @click="$inertia.visit(route('exam.import', props.exam.id))"
                class="flex items-center bg-primary hover:bg-orange-300 text-white px-4 py-2 rounded-lg font-semibold"
            >
                <img
                    src="../../assets/voltar.png"
                    alt="Voltar"
                    class="w-5 h-5 mr-2"
                />
                Voltar
            </button>
        </template>

        <br>

        <div class="p-8 bg-white shadow rounded-lg space-y-10 max-w-4xl mx-auto">
            <header class="text-center">
                <h1 class="text-3xl font-bold mb-4 text-gray-800">Laudo de Exame de Sangue</h1>
                <p class="text-lg text-gray-600">
                    <span class="font-semibold">Número da Requisição:</span>
                    {{ info.requisition_id }}
                </p>
            </header>

            <section class="border-b border-gray-300 pb-6">
                <h2 class="text-2xl font-semibold mb-6 text-gray-700">Informações do Paciente</h2>
                <div class="grid grid-cols-2 gap-6">
                    <p><span class="font-bold">Nome do Paciente:</span> {{ info.patient_name }}</p>
                    <p><span class="font-bold">Idade:</span> {{ info.age }} anos</p>
                    <p><span class="font-bold">Convênio:</span> {{ info.health_insurance }}</p>
                    <p><span class="font-bold">Local da Coleta:</span> {{ info.lab }}</p>
                </div>
            </section>

            <section class="border-b border-gray-300 pb-6">
                <h2 class="text-2xl font-semibold mb-6 text-gray-700">Informações do Exame</h2>
                <div class="grid grid-cols-2 gap-6">
                    <p><span class="font-bold">Médico Solicitante:</span> {{ info.doctor_name }}</p>
                    <p><span class="font-bold">Data do Exame:</span> {{ info.exam_date }}</p>
                    <p><span class="font-bold">Data de Emissão do Laudo:</span> {{ currentDate }}</p>
                </div>
            </section>

            <section v-if="info.sex == 'Feminino'" class="border-b border-gray-300 pb-6">
                <h2 class="text-2xl font-semibold mb-6 text-gray-700">Resultados dos Exames</h2>
                <div v-for="(component, index) in components" :key="index" class="mb-4">
                    <h3 class="font-semibold text-lg text-primary mb-3">{{ component.name }}</h3>
                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-3 text-left font-medium text-gray-700">Resultado</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-700">Valores de Referência</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-3 border-t">{{ info.value }} {{ component.metric }}</td>
                                <td class="px-4 py-3 border-t">
                                    Mínimo: {{ component.min_female }} - Máximo: {{ component.max_female }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section v-if="info.sex == 'Masculino'" class="border-b border-gray-300 pb-6">
                <h2 class="text-2xl font-semibold mb-6 text-gray-700">Resultados dos Exames</h2>
                <div v-for="(component, index) in components" :key="index" class="mb-4">
                    <h3 class="font-semibold text-lg text-primary mb-3">{{ component.name }}</h3>
                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-3 text-left font-medium text-gray-700">Resultado</th>
                                <th class="px-4 py-3 text-left font-medium text-gray-700">Valores de Referência</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 py-3 border-t">{{ info.value }} {{ component.metric }}</td>
                                <td class="px-4 py-3 border-t">
                                    Mínimo: {{ component.min_male }} - Máximo: {{ component.max_male }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <section>
                <h2 class="text-2xl font-semibold mb-4 text-gray-700">Conclusão</h2>
                <textarea
                    v-model="form.conclusion"
                    class="w-full h-32 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                    placeholder="Digite a conclusão aqui..."
                ></textarea>
            </section>

            <!-- Centralizar o botão no meio -->
            <div class="flex justify-center">
                <button
                    @click="generatePdf"
                    class="bg-primary hover:bg-orange-300 text-white px-6 py-3 rounded-lg font-semibold mt-4"
                >
                    Salvar PDF
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
