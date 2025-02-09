<script setup>
import { defineProps, computed, ref, onUpdated } from "vue";
import { usePage } from "@inertiajs/vue3"; // Supondo que você esteja usando Inertia.js
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    exams: {
        type: Object,
        default: null,
    },
    flash: {
        type: Object,
        default: () => ({}),
    },
});
const page = usePage();
const user = computed(() => {
    return page.props.auth;
});

const calculateExamDate = (examDate) => {
    const [year, month, day] = examDate.split("-");
    const examDateFormated = new Date(Number(year), Number(month) - 1, Number(day));

    return examDateFormated.toLocaleDateString('pt-BR');
};

const clearMessage = () => {
    props.flash.message = null;
};

const clearError = () => {
    props.flash.error = null;
};

onUpdated(() => {
    if (props.flash.message) setTimeout(clearMessage, 5000);
    if (props.flash.error) setTimeout(clearError, 5000);
});
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col p-5 bg-white shadow-sm sm:rounded-lg">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold">Pedidos Recentes</h2>
                    </div>
                    <div class="mt-10" v-if="exams.data.length == 0">
                        <p class="text-xl font-bold text-red-600">
                            Pedido(s) não encontrado(s).
                        </p>
                    </div>
                    <table class="mt-10">
                        <thead
                            class="border-b-2"
                            v-show="exams.data.length != 0"
                        >
                            <tr>
                                <th>Tipo</th>
                                <th>Nome do paciente</th>
                                <th>Data do exame</th>
                                <th>Descrição do exame</th>
                                <th>Laudo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="text-center transition-all duration-300 hover:bg-gray-200"
                                v-for="exam in exams.data"
                                :key="exam.id"
                            >
                                <td v-if="exam.type == 'blood'" class="py-4">{{ "Sangue" }}</td>
                                <td v-if="exam.type == 'paternity'" class="py-4">{{ "Paternidade" }}</td>
                                <td class="py-4">{{ exam.patient_name }}</td>
                                <td class="py-4">
                                    {{ calculateExamDate(exam.exam_date) }}
                                </td>
                                <td class="py-4 max-w-52">
                                    <div class="mx-auto break-all line-clamp-2">
                                        {{ exam.description }}
                                    </div>
                                </td>
                                <td
                                    class="py-4 text-blue-600 underline transition-all duration-300 cursor-pointer hover:text-blue-800"
                                    v-if="
                                        !user.isPatient &&
                                        exam.type == 'paternity'
                                    "
                                >
                                    <a
                                        :href="
                                            route(
                                                'paternity.report.manage',
                                                exam.id
                                            )
                                        "
                                        >Gerenciar laudo</a
                                    >
                                </td>
                                <td
                                    class="py-4 text-blue-600 underline transition-all duration-300 cursor-pointer hover:text-blue-800"
                                    v-if="
                                        !user.isPatient && exam.type == 'blood'
                                    "
                                >
                                    <a
                                        :href="
                                            route('exam.report.manage', exam.id)
                                        "
                                        >Gerenciar laudo</a
                                    >
                                </td>
                                <td
                                    class="py-4"
                                    v-if="exam.pdf == null && user.isPatient"
                                >
                                    Indisponível
                                </td>
                                <td
                                    class="py-4 text-blue-600 underline transition-all duration-300 cursor-pointer hover:text-blue-800"
                                    v-if="
                                        exam.pdf != null &&
                                        user.isPatient &&
                                        exam.type == 'blood'
                                    "
                                >
                                    <a
                                        :href="
                                            route(
                                                'exam.report.download',
                                                exam.id
                                            )
                                        "
                                        >Baixar</a
                                    >
                                </td>
                                <td
                                    class="py-4 text-blue-600 underline transition-all duration-300 cursor-pointer hover:text-blue-800"
                                    v-if="
                                        exam.pdf != null &&
                                        user.isPatient &&
                                        exam.type == 'paternity'
                                    "
                                >
                                    <a
                                        :href="
                                            route(
                                                'paternity.report.download',
                                                exam.id
                                            )
                                        "
                                        >Baixar</a
                                    >
                                </td>
                                <td class="flex justify-end py-4">
                                    <a
                                        v-if="
                                            exam &&
                                            exam.type == 'blood' &&
                                            !user.isPatient
                                        "
                                        :href="route('exam.edit', exam.id)"
                                        class="px-4 py-2 mr-4 text-white rounded-lg bg-primary hover:bg-orange-300"
                                    >
                                        Editar
                                    </a>
                                    <a
                                        v-if="
                                            exam &&
                                            exam.type == 'paternity' &&
                                            !user.isPatient
                                        "
                                        :href="route('paternity.edit', exam.id)"
                                        class="px-4 py-2 mr-4 text-white rounded-lg bg-primary hover:bg-orange-300"
                                    >
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :links="exams.links" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
    <div
        v-if="flash.message"
        class="fixed bottom-0 left-0 w-full px-6 py-4 text-lg text-white bg-green-500"
    >
        {{ flash.message }}
    </div>
    <div
        v-if="flash.error"
        class="fixed bottom-0 left-0 w-full px-6 py-4 text-lg text-white bg-red-500"
    >
        {{ flash.error }}
    </div>
</template>
