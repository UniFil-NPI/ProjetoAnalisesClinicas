<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

export default {
    props: {
        isAdminOrRecepcionist:{
            type: Boolean,
            default: null,
        }
    },
    data() {
        return {
            search: "",
            exams: [],
        };
    },
    components: {
        Head,
        AuthenticatedLayout,
        Link,
    },
    methods: {
        research() {
            axios
                .post(route("exam.search"), { search: this.search })
                .then((response) => {
                    this.exams = response.data;
                });
        },
    },
    mounted() {
        this.research();
    },
};
</script>
<template>
    <Head title="Exames" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Exames
            </h2>
        </template>

        <div class="max-w-7xl mx-auto px-10 mt-10" v-if="isAdminOrRecepcionist">
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
                        <h2 class="text-2xl font-bold">
                            Gerenciamento de Exames
                        </h2>
                        <Link v-if="isAdminOrRecepcionist"
                            :href="route('exam.create')"
                            class="px-4 py-2 rounded-lg text-white bg-primary hover:bg-orange-300"
                        >
                            Novo exame
                        </Link>
                    </div>

                    <table class="mt-10" >
                        <thead v-show="exams.length != 0">
                            <tr>
                                <th>ID</th>
                                <th>Nome do paciente</th>
                                <th>Data do exame</th>
                                <th>Descrição do exame</th>
                                <th>Laudo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="text-center"
                                v-for="exam in exams"
                                :key="exam.id"
                            >
                                <td class="py-2">{{ exam.id }}</td>
                                <td class="py-2">{{ exam.name }}</td>
                                <td class="py-2">{{ new Date(exam.exam_date).toLocaleDateString() }}</td>
                                <td class="py-2 max-w-52">
                                    <div class="line-clamp-2 break-all mx-auto">
                                    {{ exam.description }}
                                    </div>
                                </td>
                                <td class="py-2 flex items-center justify-center">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 cursor-pointer">
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                    </svg>
                                </td>
                                <td class="py-2">
                                    <Link
                                        v-if="exam"
                                        :href="route('exam.edit', exam.id)"
                                        class="px-4 py-2 rounded-lg bg-primary hover:bg-orange-300 text-white"
                                    >
                                        Editar
                                    </Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
