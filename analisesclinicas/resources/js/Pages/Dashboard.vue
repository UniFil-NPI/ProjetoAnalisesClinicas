<script setup>
import { defineProps, computed } from 'vue';
import { usePage } from '@inertiajs/vue3'; // Supondo que você esteja usando Inertia.js
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

const props = defineProps({
    exams: {
        type: Array,
        default: null,
    },
});
const page = usePage();
const user = computed(() => {
            return page.props.auth;
})


</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white flex flex-col shadow-sm sm:rounded-lg p-5">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold">Pedidos Recentes</h2>
                    </div>
                    <div class="mt-10" v-if="props.exams.length == 0">
                        <p class="text-xl font-bold text-red-600">
                            Não possui nenhum pedido
                        </p>
                    </div>
                    <table class="mt-10">
                        <thead v-show="props.exams.length != 0">
                            <tr>
                                <th>ID</th>
                                <th>Nome do paciente</th>
                                <th>Nome do médico</th>
                                <th>Data do exame</th>
                                <th>Descrição do exame</th>
                                <th>Laudo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="text-center hover:bg-gray-200 transition-all duration-300"
                                v-for="exam in props.exams"
                                :key="exam.id"
                            >
                                <td class="py-2">{{ exam.id }}</td>
                                <td class="py-2">{{ exam.patient_name }}</td>
                                <td class="py-2">
                                    {{
                                        exam.doctor_name
                                            ? exam.doctor_name
                                            : "Não possui"
                                    }}
                                </td>
                                <td class="py-2">
                                    {{
                                        new Date(
                                            exam.exam_date
                                        ).toLocaleDateString()
                                    }}
                                </td>
                                <td class="py-2 max-w-52">
                                    <div class="line-clamp-2 break-all mx-auto">
                                        {{ exam.description }}
                                    </div>
                                </td>
                                <td
                                    class="py-2 flex items-center justify-center"
                                >
                                    <p v-if="exam.pdf == null">Indisponível</p>
                                    <a href="#" v-if="exam.pdf != null"
                                        >baixar</a
                                    >
                                </td>
                                <td class="py-2">
                                    <a
                                        v-if="
                                            exam &&
                                            exam.type == 'blood' &&
                                            !user.isPatient
                                        "
                                        :href="route('exam.edit', exam.id)"
                                        class="px-4 py-2 rounded-lg bg-primary hover:bg-orange-300 text-white"
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
                                        class="px-4 py-2 rounded-lg bg-primary hover:bg-orange-300 text-white"
                                    >
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
