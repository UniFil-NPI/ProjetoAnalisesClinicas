<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";
import { computed, onMounted, ref, watch } from "vue";

const props = defineProps({
    flash: {
        type: Object,
        default: () => ({}),
    },
});

const page = usePage();
const user = computed(() => {
    return page.props.auth;
});
const search = ref("");
const exams = ref([]);
const firstSearch = ref(true);
const message = ref(
    props.flash && props.flash.message ? props.flash.message : null
);
const status = ref("");

const research = () => {
    axios
        .post(route("exam.search"), { search: search.value })
        .then((response) => {
            exams.value = response.data.result;
            status.value = response.data.status;
        });
    firstSearch.value = false;
};

const clearMessage = () => {
    message.value = null;
};

onMounted(() => {
    research();
    if (message.value) {
        setTimeout(clearMessage, 5000);
    }
});
</script>
<template>
    <Head title="Pedidos de exames" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pedidos
            </h2>
        </template>

        <div
            class="max-w-7xl mx-auto px-10 mt-10"
            v-if="user.isAdm || user.isRecepcionist"
        >
            <div class="relative">
                <div
                    class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"
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
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="CPF do paciente"
                    v-mask-cpf
                    required
                />
                <button
                    v-on:click="research"
                    class="text-white absolute end-2.5 bottom-2.5 bg-primary hover:bg-orange-300 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2"
                >
                    Buscar
                </button>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white flex flex-col shadow-sm sm:rounded-lg p-5">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold" v-if="!user.isPatient">
                            Gerenciamento de Pedidos
                        </h2>
                        <a
                            v-if="user.isAdm || user.isRecepcionist"
                            :href="route('exam.create')"
                            class="px-4 py-2 rounded-lg text-white bg-primary hover:bg-orange-300"
                        >
                            Novo Pedido
                        </a>
                    </div>
                    <div
                        class="mt-10"
                        v-if="
                            exams.length == 0 && firstSearch && !user.isPatient
                        "
                    >
                        <p class="text-xl font-bold text-red-600">
                            Faça uma busca para aparecer algum pedido
                        </p>
                    </div>
                    <div
                        class="mt-10"
                        v-if="status == 'exams is empty' && !user.isPatient"
                    >
                        <p class="text-xl font-bold text-red-600">
                            Não possui nenhum pedido
                        </p>
                    </div>
                    <div
                        class="mt-10"
                        v-if="status == 'patient not found' && !user.isPatient"
                    >
                        <p class="text-xl font-bold text-red-600">
                            Paciente não encontrado
                        </p>
                    </div>
                    <table class="mt-10">
                        <thead v-show="exams.length != 0">
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
                                class="text-center hover:bg-gray-200 transition-all duration-300"
                                v-for="exam in exams"
                                :key="exam.id"
                            >
                                <td class="py-2">{{ exam.id }}</td>
                                <td class="py-2">{{ exam.patient_name }}</td>
                                <td class="py-2">{{ exam.doctor_name }}</td>
                                <td class="py-2">{{ exam.exam_type_name }}</td>
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
                                <td class="py-2" v-if="exam.pdf == null">
                                    Indisponível
                                </td>
                                <td
                                    class="py-2 flex items-center justify-center"
                                    v-else
                                >
                                    <a href="#" v-if="exam.pdf != null"
                                        >baixar</a
                                    >
                                </td>
                                <td class="py-2">{{ exam.state }}</td>
                                <td class="py-2">
                                    <a
                                        v-if="
                                            exam &&
                                            (user.isAdm || user.isRecepcionist)
                                        "
                                        :href="route('exam.edit', exam.id)"
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
    <div
        v-if="message"
        class="w-full py-4 px-6 bg-green-500 text-white text-lg fixed bottom-0 left-0"
    >
        {{ message }}
    </div>
</template>
