<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, Head, router } from "@inertiajs/vue3";
import { onMounted, onUpdated, ref, watch } from "vue";

const props = defineProps({
    infos: Array,
    components: Array,
    exam: Object,
});

const form = useForm({
    infos: props.infos,
    components: props.components,
    conclusion: "",
});

const calculateAge = () => {
    const [day, month, year] = props.infos[0].birth_date.split("-");

    const birthDate = new Date(`${year}-${month}-${day}`);

    const today = new Date();
    let age = today.getFullYear() - birthDate.getFullYear();

    const monthDifference = today.getMonth() - birthDate.getMonth();
    const dayDifference = today.getDate() - birthDate.getDate();

    if (monthDifference < 0 || (monthDifference === 0 && dayDifference < 0)) {
        age--;
    }
    return age;
};

const currentDate = ref(
    new Date().toLocaleDateString("pt-BR", {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
    })
);

const generatePdf = () => {
    form.post(`/exam/report/store/${props.exam.id}`);
};
</script>

<template>
    <Head title="Pré-visualizar Laudo" />

    <AuthenticatedLayout>
        <template #header>
            <button
                @click="$inertia.visit(route('exam.import', props.exam.id))"
                class="flex items-center px-4 py-2 font-semibold text-white rounded-lg bg-primary hover:bg-orange-300"
            >
                <img
                    src="../../assets/voltar.png"
                    alt="Voltar"
                    class="w-5 h-5 mr-2"
                />
                Voltar
            </button>
        </template>

        <br />

        <div
            class="max-w-4xl p-8 mx-auto space-y-10 bg-white rounded-lg shadow"
        >
            <header class="text-center">
                <h1 class="mb-4 text-3xl font-bold text-gray-800">
                    Laudo de Exame de Sangue
                </h1>
                <p class="text-lg text-gray-600">
                    <span class="font-semibold">Número da Requisição:</span>
                    {{ infos[0].requisition_id }}
                </p>
            </header>

            <section class="pb-6 border-b border-gray-300">
                <h2 class="mb-6 text-2xl font-semibold text-gray-700">
                    Informações do Paciente
                </h2>
                <div class="grid grid-cols-2 gap-6">
                    <p>
                        <span class="font-bold">Nome do Paciente:</span>
                        {{ infos[0].patient_name }}
                    </p>
                    <p>
                        <span class="font-bold">Idade:</span>
                        {{ calculateAge() }} anos
                    </p>
                    <p>
                        <span class="font-bold">Convênio:</span>
                        {{ infos[0].health_insurance }}
                    </p>
                    <p>
                        <span class="font-bold">Local da Coleta:</span>
                        {{ infos[0].lab }}
                    </p>
                </div>
            </section>

            <section class="pb-6 border-b border-gray-300">
                <h2 class="mb-6 text-2xl font-semibold text-gray-700">
                    Informações do Exame
                </h2>
                <div class="grid grid-cols-2 gap-6">
                    <p>
                        <span class="font-bold">Médico Solicitante:</span>
                        {{ infos[0].doctor_name }}
                    </p>
                    <p>
                        <span class="font-bold">Data do Exame:</span>
                        {{ infos[0].exam_date }}
                    </p>
                    <p>
                        <span class="font-bold">Data de Emissão do Laudo:</span>
                        {{ currentDate }}
                    </p>
                </div>
            </section>
            <div v-for="(info, i) in infos" :key="i">
                <section
                    v-if="info.sex == 'Feminino'"
                    class="pb-6 border-b border-gray-300"
                >
                    <h2 class="mb-6 text-2xl font-semibold text-gray-700">
                        Resultados dos Exames
                    </h2>
                    <div
                        v-for="(component, index) in components"
                        :key="index"
                        class="mb-4"
                    >
                        <h3 class="mb-3 text-lg font-semibold text-primary">
                            {{ component.name }}
                        </h3>
                        <table
                            class="w-full overflow-hidden border border-gray-200 rounded-lg shadow-sm"
                        >
                            <thead>
                                <tr class="bg-gray-100">
                                    <th
                                        class="px-4 py-3 font-medium text-left text-gray-700"
                                    >
                                        Resultado
                                    </th>
                                    <th
                                        class="px-4 py-3 font-medium text-left text-gray-700"
                                    >
                                        Valores de Referência
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="component.name == info.exam_name">
                                    <td class="px-4 py-3 border-t">
                                        {{ info.value }}
                                        {{ component.metric }}
                                    </td>
                                    <td class="px-4 py-3 border-t">
                                        Mínimo: {{ component.min_female }} -
                                        Máximo: {{ component.max_female }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section
                    v-if="info.sex == 'Masculino'"
                    class="pb-6 border-b border-gray-300"
                >
                    <h2 class="mb-6 text-2xl font-semibold text-gray-700">
                        Resultados dos Exames
                    </h2>
                    <div
                        v-for="(component, index) in components"
                        :key="index"
                        class="mb-4"
                    >
                        <h3 class="mb-3 text-lg font-semibold text-primary">
                            {{ component.name }}
                        </h3>
                        <table
                            class="w-full overflow-hidden border border-gray-200 rounded-lg shadow-sm"
                        >
                            <thead>
                                <tr class="bg-gray-100">
                                    <th
                                        class="px-4 py-3 font-medium text-left text-gray-700"
                                    >
                                        Resultado
                                    </th>
                                    <th
                                        class="px-4 py-3 font-medium text-left text-gray-700"
                                    >
                                        Valores de Referência
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="component.name == info.exam_name">
                                    <td class="px-4 py-3 border-t">
                                        {{ info.value }}
                                        {{ component.metric }}
                                    </td>
                                    <td class="px-4 py-3 border-t">
                                        Mínimo: {{ component.min_male }} -
                                        Máximo: {{ component.max_male }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>

            <section>
                <h2 class="mb-4 text-2xl font-semibold text-gray-700">
                    Conclusão
                </h2>
                <textarea
                    v-model="form.conclusion"
                    class="w-full h-32 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
                    placeholder="Digite a conclusão aqui..."
                ></textarea>
            </section>

            <div class="flex justify-center">
                <button
                    @click="generatePdf"
                    class="px-6 py-3 mt-4 font-semibold text-white rounded-lg bg-primary hover:bg-orange-300"
                >
                    Salvar PDF
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
