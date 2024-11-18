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
    paternity_tests: Object,
});

const page = usePage();
const user = computed(() => {
    return page.props.auth;
});
const search = ref("");

const calculateExamDate = (examDate) => {
    const [year, month, day] = examDate.split("-");
    const examDateFormated = new Date(Number(year), Number(month) - 1, Number(day));

    return examDateFormated.toLocaleDateString('pt-BR');
};

const research = () => {
    router.get(route("paternity.search", search.value));
};

const clearMessage = () => {
    props.flash.message = null;
};

if (props.flash.message) setTimeout(clearMessage, 5000);

watch(props.paternity_tests.data, (newValue) => {
    newValue.forEach((element) => {
        element.participants = JSON.parse(element.participants);
    });
});
</script>
<template>
    <Head title="Pedido de exame de paternidade" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Pedidos
            </h2>
        </template>

        <div class="px-10 mx-auto mt-10 max-w-7xl" v-if="!user.isPatient">
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
                    class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-orange-300 focus:border-orange-300"
                    placeholder="CPF do paciente"
                    v-mask-cpf
                    required
                />
                <a
                    :href="route('paternity.index')"
                    class="pr-4 text-gray-500 absolute end-20 bottom-2.5 bg-transparent hover:text-gray-800 focus:outline-none font-medium rounded-lg text-sm px-2 py-2"
                >
                    ✕
                </a>
                <button
                    v-on:click="research"
                    class="text-white absolute end-2.5 bottom-2.5 bg-primary hover:bg-orange-300 focus:outline-none font-medium rounded-lg text-sm px-4 py-2"
                >
                    Buscar
                </button>
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col p-5 bg-white shadow-md sm:rounded-lg">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold">
                            Gerenciamento de Pedidos
                        </h2>
                        <a
                            :href="route('paternity.select')"
                            class="px-4 py-2 text-white rounded-lg bg-primary hover:bg-orange-300"
                            v-if="user.isAdm"
                        >
                            Novo Pedido
                        </a>
                    </div>
                    <div class="mt-10" v-if="paternity_tests.data.length == 0">
                        <p class="text-xl font-bold text-red-600">
                            Pedido(s) não encontrado(s).
                        </p>
                    </div>
                    <table class="mt-10">
                        <thead
                            class="border-b-2"
                            v-show="paternity_tests.data.length != 0"
                        >
                            <tr>
                                <th>ID</th>
                                <th>Nome Do Paciente</th>
                                <th>Data do exame</th>
                                <th>Descrição</th>
                                <th>Laudo</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="text-center transition-all duration-300 hover:bg-gray-200"
                                v-for="paternityTest in paternity_tests.data"
                                :key="paternityTest.id"
                            >
                                <td class="py-4">{{ paternityTest.id }}</td>

                                <td class="py-4">
                                    {{ paternityTest.patient_name }}
                                </td>

                                <td class="py-4">
                                    {{ calculateExamDate(paternityTest.exam_date) }}
                                </td>

                                <td class="py-4 max-w-52">
                                    <div class="mx-auto break-all line-clamp-2">
                                        {{ paternityTest.description }}
                                    </div>
                                </td>

                                <td
                                    class="py-4 text-blue-600 underline transition-all duration-300 cursor-pointer hover:text-blue-800"
                                    v-if="!user.isPatient"
                                >
                                    <a
                                        :href="
                                            route(
                                                'paternity.report.manage',
                                                paternityTest.id
                                            )
                                        "
                                        >Gerenciar Laudo</a
                                    >
                                </td>

                                <td
                                    class="py-4"
                                    v-if="
                                        paternityTest.pdf == null &&
                                        user.isPatient
                                    "
                                >
                                    Indisponível
                                </td>

                                <td
                                    class="py-4 text-blue-600 underline transition-all duration-300 cursor-pointer hover:text-blue-800"
                                    v-if="
                                        paternityTest.pdf != null &&
                                        user.isPatient
                                    "
                                >
                                    <a
                                        :href="
                                            route(
                                                'paternity.report.download',
                                                paternityTest.id
                                            )
                                        "
                                        >Baixar</a
                                    >
                                </td>

                                <td class="py-4">{{ paternityTest.state }}</td>

                                <td class="flex justify-end py-4">
                                    <a
                                        v-if="paternityTest && user.isAdm"
                                        :href="
                                            route(
                                                'paternity.edit',
                                                paternityTest.id
                                            )
                                        "
                                        class="px-4 py-2 mr-4 text-white rounded-lg bg-primary hover:bg-orange-300"
                                    >
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :links="paternity_tests.links" />
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
</template>
