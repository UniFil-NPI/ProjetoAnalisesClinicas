<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, usePage } from "@inertiajs/vue3";
import { computed, onMounted, ref, watch } from "vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    flash: {
        type: Object,
        default: () => ({}),
    },
    exams: Object,
});

const page = usePage();
const user = computed(() => {
    return page.props.auth;
});
const search = ref("");

const research = () => {
    router.get(route("exam.search", search.value));
};
const message = ref(props.flash?.message || null);

const clearMessage = () => {
    message.value = null;
};

if (message.value) setTimeout(clearMessage, 5000);
</script>
<template>
    <Head title="Pedidos de exames" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Pedidos
            </h2>
        </template>

        <div
            class="px-10 mx-auto mt-10 max-w-7xl"
            v-if="user.isAdm || user.isRecepcionist"
        >
            <div class="relative">
                <div
                    class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3"
                >
                    <svg
                        class="w-4 h-4 text-gray-500"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 20 20"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                        />
                    </svg>
                </div>
                <input
                    type="search"
                    id="search"
                    v-model="search"
                    class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="CPF do paciente"
                    v-mask-cpf
                    required
                />
                <a
                    :href="route('exam.index')"
                    class="pr-4 text-gray-500 absolute end-20 bottom-2.5 bg-transparent hover:text-gray-800 focus:outline-none font-medium rounded-lg text-sm px-2 py-2"
                >
                    ✕
                </a>
                <button
                    v-on:click="research"
                    class="text-white absolute end-2.5 bottom-2.5 bg-primary hover:bg-orange-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2"
                >
                    Buscar
                </button>
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col p-5 bg-white shadow-sm sm:rounded-lg">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold" v-if="!user.isPatient">
                            Gerenciamento de Pedidos
                        </h2>
                        <a
                            v-if="user.isAdm || user.isRecepcionist"
                            :href="route('exam.create')"
                            class="px-4 py-2 text-white rounded-lg bg-primary hover:bg-orange-300"
                        >
                            Novo Pedido
                        </a>
                    </div>
                    <div class="mt-10" v-if="exams.data == 0">
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
                                <th>ID</th>
                                <th>Nome do paciente</th>
                                <th>Nome do médico</th>
                                <th>Tipo do exame</th>
                                <th>Data do exame</th>
                                <th>Descrição do exame</th>
                                <th>Laudo</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="text-center transition-all duration-300 hover:bg-gray-200"
                                v-for="exam in exams.data"
                                :key="exam.id"
                            >
                                <td class="py-4">{{ exam.id }}</td>
                                <td class="py-4">{{ exam.patient_name }}</td>
                                <td class="py-4">{{ exam.doctor_name }}</td>
                                <td class="py-4">{{ exam.exam_type_name }}</td>
                                <td class="py-4">
                                    {{
                                        exam.exam_date
                                    }}
                                </td>
                                <td class="py-4 max-w-52">
                                    <div class="mx-auto break-all line-clamp-2">
                                        {{ exam.description }}
                                    </div>
                                </td>
                                <td
                                    class="py-4"
                                    v-if="exam.pdf == null && user.isPatient"
                                >
                                    Indisponível
                                </td>
                                <td
                                    class="py-4 text-blue-600 underline transition-all duration-300 cursor-pointer hover:text-blue-800"
                                    v-if="!user.isPatient"
                                >
                                    <a
                                        :href="
                                            route('exam.report.manage', exam.id)
                                        "
                                        >Gerenciar laudo</a
                                    >
                                </td>
                                <td
                                    class="py-4 text-blue-600 underline transition-all duration-300 cursor-pointer hover:text-blue-800"
                                    v-if="exam.pdf != null && user.isPatient"
                                >
                                    <a href="#">Baixar</a>
                                </td>
                                <td class="py-4">{{ exam.state }}</td>
                                <td class="flex justify-end py-4">
                                    <a
                                        v-if="
                                            exam &&
                                            (user.isAdm || user.isRecepcionist)
                                        "
                                        :href="route('exam.edit', exam.id)"
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
        v-if="message"
        class="fixed bottom-0 left-0 w-full px-6 py-4 text-lg text-white bg-green-500"
    >
        {{ message }}
    </div>
</template>
