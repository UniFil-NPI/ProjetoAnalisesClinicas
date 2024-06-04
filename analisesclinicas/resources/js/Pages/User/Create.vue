<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

export default {
    components: {
        Head,
        AuthenticatedLayout,
        Link,
    },
    data() {
        return {
            form: useForm({
                name: "",
                email: "",
                cpf: "",
                role: 0,
            }),
        };
    },
    methods: {
        save() {
            this.form.post("/create/new/user");
        },
    },
};
</script>
<template>
    <Head title="Usuários" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Funcionários
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white flex flex-col gap-5 shadow-sm shadow-primary sm:rounded-lg p-5"
                >
                    <h2 class="text-2xl font-bold">Novo Funcionário</h2>
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">Nome</label>
                                <input
                                    type="text"
                                    v-model="form.name"
                                    placeholder="Seu Nome"
                                    class="col-span-1 bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.name"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.name }}</span
                                >
                            </div>
                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">E-mail</label>
                                <input
                                    type="email"
                                    v-model="form.email"
                                    placeholder="Seu Email"
                                    class="col-span-1 bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.email"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.email }}</span
                                >
                            </div>
                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">CPF</label>
                                <input
                                    type="text"
                                    v-model="form.cpf"
                                    placeholder="Seu CPF"
                                    class="col-span-1 bg-neutral-200 border-none rounded-lg"
                                    v-mask-cpf
                                />
                                <span
                                    v-if="form.errors.cpf"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.cpf }}</span
                                >
                            </div>
                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">Cargo</label>
                                <select
                                    v-model="form.role"
                                    class="col-span-1 bg-neutral-200 border-none rounded-lg"
                                >
                                    <option selected disabled value="0">
                                        Selecione
                                    </option>
                                    <option value="admin">admin</option>
                                    <option value="recepcionist">
                                        recepcionista
                                    </option>
                                    <option value="tecnico">técnico</option>
                                </select>
                                <span
                                    v-if="form.errors.role"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.role }}</span
                                >
                            </div>
                            <button
                                class="px-4 py-2 rounded-lg bg-primary text-white col-span-2 text-xl uppercase text-center font-semibold"
                                type="submit"
                            >
                                Criar Funcionário
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
