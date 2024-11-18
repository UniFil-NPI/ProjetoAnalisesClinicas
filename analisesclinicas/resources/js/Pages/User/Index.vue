<script setup>
import { ref, defineProps } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, router } from "@inertiajs/vue3";

const props = defineProps({
    flash: {
        type: Object,
        default: () => ({}),
    },
    users: Object,
    selectedFilter: {
        type: String,
        default: 'all',
    },
});

const search = ref(null);
const selectedFilter = ref(props.selectedFilter);

const research = () => {
    router.get(route("user.search", [selectedFilter.value, search.value]));
};

const clearMessage = () => {
    props.flash.message = null;
};

const clearError = () => {
    props.flash.error = null;
};

if (props.flash.error) setTimeout(clearError, 5000);
if (props.flash.message) setTimeout(clearMessage, 5000);
</script>
<template>
    <Head title="Funcionários" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Funcionários
            </h2>
        </template>

        <div class="px-10 mx-auto mt-10 max-w-7xl">
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
                    class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-orange-300 focus:border-orange-300"
                    placeholder="CPF do funcionário"
                    v-model="search"
                    v-mask-cpf
                    required
                />
                <a
                    :href="route('user.index')"
                    class="pr-[7.5rem] text-gray-500 absolute end-20 bottom-2.5 bg-transparent hover:text-gray-800 focus:outline-none font-medium rounded-lg text-sm px-2 py-2"
                >
                    ✕
                </a>
                <div
                    class="flex items-center absolute end-2.5 bottom-2.5 gap-2"
                >
                    <button
                        @click="research"
                        class="px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary hover:bg-orange-300 focus:outline-none"
                    >
                        Buscar
                    </button>
                    <select
                        v-model="selectedFilter"
                        class="px-4 py-2 pr-8 text-sm font-medium text-white border-none rounded-lg bg-primary hover:bg-orange-300 focus:outline-none focus:ring-0"
                    >
                        <option value="all">Todos</option>
                        <option value="active">Ativos</option>
                        <option value="inactive">Inativos</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col p-5 bg-white shadow-sm sm:rounded-lg">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold">
                            Gerenciamento de funcionários
                        </h2>
                        <a
                            :href="route('user.create')"
                            class="px-4 py-2 text-white rounded-lg bg-primary hover:bg-orange-300"
                        >
                            Novo funcionário
                        </a>
                    </div>

                    <div class="mt-10" v-if="users.data.length == 0">
                        <p class="text-xl font-bold text-red-600">
                            Funcionário(s) não encontrado(s).
                        </p>
                    </div>

                    <table class="mt-10" v-if="users.data.length != 0">
                        <thead class="border-b-2">
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>CPF</th>
                                <th>Cargo</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="user in users.data"
                                :key="user.id"
                                class="text-center transition-all duration-300 hover:bg-gray-200"
                            >
                                <td class="py-4">{{ user.id }}</td>
                                <td class="py-4">{{ user.name }}</td>
                                <td class="py-4">{{ user.email }}</td>
                                <td class="py-4">{{ user.cpf }}</td>
                                <td
                                    class="py-4"
                                    v-if="user.roles[0].name == 'admin'"
                                >
                                    {{ "Administrador" }}
                                </td>
                                <td
                                    class="py-4"
                                    v-if="user.roles[0].name == 'biomedic'"
                                >
                                    {{ "Biomédico" }}
                                </td>
                                <td
                                    class="py-4"
                                    v-if="user.roles[0].name == 'recepcionist'"
                                >
                                    {{ "Recepcionista" }}
                                </td>
                                <td class="py-4">
                                    {{ user.is_active ? "ativo" : "inativo" }}
                                </td>
                                <td class="flex justify-end py-4">
                                    <a
                                        :href="route('user.edit', user.id)"
                                        class="px-4 py-2 mr-4 text-white rounded-lg bg-primary hover:bg-orange-300"
                                    >
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :links="users.links" />
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

<style scoped>
select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: primary;
    color: white;
    padding-right: 2rem;
    position: relative;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20' fill='white'%3E%3Cpath fill-rule='evenodd' d='M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 011.06 1.06l-4 3.75a.75.75 0 01-1.06 0l-4-3.75a.75.75 0 01-.02-1.06z' clip-rule='evenodd'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.5rem center;
    background-size: 1rem;
}
</style>
