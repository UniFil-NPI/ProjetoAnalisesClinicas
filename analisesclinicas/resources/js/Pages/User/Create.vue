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
                password: "",
            }),
        };
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
                    <h2 class="text-2xl font-bold">Novo Usuário</h2>
                    <form>
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
                            <input
                                type="password"
                                v-model="form.password"
                                placeholder="Sua Senha"
                                class="col-span-1 bg-neutral-200 border-none rounded-lg"
                            />
                            <Link
                                href="/create/new/user"
                                method="post"
                                :data="this.form"
                                class="px-4 py-2 rounded-lg bg-primary text-white col-span-2 text-xl uppercase text-center font-semibold"
                            >
                                Criar Usuário
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
