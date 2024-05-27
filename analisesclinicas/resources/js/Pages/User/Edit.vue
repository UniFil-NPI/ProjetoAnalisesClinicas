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
        user: Object,
    },
    data() {
        return {
            form: {
                name: this.user.name,
                email: this.user.email,
                cpf: this.user.cpf,
            },
        };
    },
    methods: {
        async updateUser() {
            await axios.post("/user/update/" + this.user.id, this.form);
            window.location.href = route("user.index");
        },
    },
};
</script>
<template>
    <Head title="Usuários" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Usuários
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white flex flex-col gap-5 shadow-sm shadow-primary sm:rounded-lg p-5"
                >
                    <h2 class="text-2xl font-bold">
                        Editar cadastro do funcionário
                    </h2>
                    <form @submit.prevent="updateUser">
                        <div class="grid grid-cols-2 gap-4">
                            <input
                                type="text"
                                v-model="form.name"
                                placeholder="Seu Nome"
                                class="col-span-1 bg-neutral-200 border-none rounded-lg"
                            />
                            <input
                                type="email"
                                v-model="form.email"
                                placeholder="Seu Email"
                                class="col-span-1 bg-neutral-200 border-none rounded-lg"
                            />
                            <input
                                type="text"
                                v-model="form.cpf"
                                placeholder="Seu CPF"
                                class="col-span-1 bg-neutral-200 border-none rounded-lg"
                            />
                            <button
                                type="submit"
                                class="px-4 py-2 rounded-lg bg-primary text-white"
                            >
                                Salvar alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
