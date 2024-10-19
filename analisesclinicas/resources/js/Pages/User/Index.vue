<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

export default {
    components: {
        Head,
        AuthenticatedLayout,
        Link,
    },
    props: {
        flash: {
            type: Object,
            default: () => ({}),
        },
    },
    data() {
        return {
            users: {},
            search: "",
            message: this.flash && this.flash.message ? this.flash.message : null,

        };
    },
    methods: {
        research() {
            axios
                .post("/user/search", { search: this.search })
                .then((response) => {
                    this.users = response.data;
                });
        },
        clearMessage() {
            this.message = null;
        },
    },
    mounted() {
        this.research();
        if (this.message) {
            setTimeout(this.clearMessage, 5000);
        }
    },
};
</script>
<template>
    <Head title="Funcionários" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Funcionários
            </h2>
        </template>

        <div class="max-w-7xl mx-auto px-10 mt-10">
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
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="CPF do funcionário"
                    v-model="search"
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
                        <h2 class="text-2xl font-bold">
                            Gerenciamento de funcionários
                        </h2>
                        <Link
                            :href="route('user.create')"
                            class="px-4 py-2 rounded-lg text-white bg-primary hover:bg-orange-300"
                        >
                            Novo funcionário
                        </Link>
                    </div>

                    <table class="mt-10">
                        <thead>
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
                                v-for="(user, i) in users"
                                :key="i"
                                class="text-center hover:bg-gray-200 transition-all duration-300"
                            >
                                <td class="py-2">{{ user.id }}</td>
                                <td class="py-2">{{ user.name }}</td>
                                <td class="py-2">{{ user.email }}</td>
                                <td class="py-2">{{ user.cpf }}</td>
                                <td
                                    class="py-2"
                                    v-if="user.roles[0].name == 'admin'"
                                >
                                    {{ "Adm" }}
                                </td>
                                <td
                                    class="py-2"
                                    v-if="user.roles[0].name == 'technician'"
                                >
                                    {{ "Técnico" }}
                                </td>
                                <td
                                    class="py-2"
                                    v-if="user.roles[0].name == 'recepcionist'"
                                >
                                    {{ "Recepcionista" }}
                                </td>
                                <td class="py-2">
                                    {{ user.status ? "ativo" : "inativo" }}
                                </td>
                                <td class="py-2">
                                    <a
                                        :href="route('user.edit', user.id)"
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
