<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router, usePage } from "@inertiajs/vue3";
import { computed, onMounted, ref } from "vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    flash: {
        type: Object,
        default: () => ({}),
    },
    exam_types: Object,
});

const search = ref("");

const research = () => {
    router.get(route("type.search", search.value));
};

const clearMessage = () => {
    props.flash.message = null;
};

if (props.flash.message) setTimeout(clearMessage, 5000);
</script>

<template>
    <Head title="Tipos de exame" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Tipos de Exame
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
                    v-model="search"
                    class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-orange-300 focus:border-orange-300"
                    placeholder="Nome do tipo de exame"
                    required
                />
                <a
                    :href="route('type.index')"
                    class="pr-4 text-gray-500 absolute end-20 bottom-2.5 bg-transparent hover:text-gray-800 focus:outline-none font-medium rounded-lg text-sm px-2 py-2"
                >
                    ✕
                </a>
                <button
                    v-on:click="research"
                    class="text-white absolute end-2.5 bottom-2.5 bg-primary hover:bg-orange-300  focus:outline-none  font-medium rounded-lg text-sm px-4 py-2"
                >
                    Buscar
                </button>
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex flex-col p-5 bg-white shadow-sm sm:rounded-lg">
                    <div class="flex items-center justify-between">
                        <h2 class="text-2xl font-bold">
                            Gerenciamento de Tipos de Exame
                        </h2>
                        <a
                            :href="route('type.create')"
                            class="px-4 py-2 text-white rounded-lg bg-primary hover:bg-orange-300"
                        >
                            Novo Tipo
                        </a>
                    </div>

                    <div class="mt-10" v-if="exam_types.data.length == 0">
                        <p class="text-xl font-bold text-red-600">
                            Tipo(s) de exame não encontrado
                        </p>
                    </div>

                    <table class="mt-10">
                        <thead
                            class="border-b-2"
                            v-show="exam_types.data.length != 0"
                        >
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="text-center transition-all duration-300 hover:bg-gray-200"
                                v-for="type in exam_types.data"
                                :key="type.id"
                            >
                                <td class="py-4">{{ type.id }}</td>
                                <td class="py-4">{{ type.name }}</td>
                                <td class="flex justify-end py-4">
                                    <a
                                        :href="route('type.edit', type.id)"
                                        class="px-4 py-2 mr-4 text-white rounded-lg bg-primary hover:bg-orange-300"
                                    >
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination :links="exam_types.links" />
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
