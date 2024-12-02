<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onUpdated, ref, watch } from "vue";

const props = defineProps({
    flash: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    name: "",
    email: "",
    cpf: "",
    role: 0,
});

const save = () => {
    form.post("/user/store");
};

const clearError = () => {
    props.flash.error = null;
};

onUpdated(() => {
    if (props.flash.error) setTimeout(clearError, 5000);
});
</script>
<template>
    <Head title="Usuários" />

    <AuthenticatedLayout>
        <template #header>
            <button
                @click="$inertia.visit(route('user.index'))"
                class="px-4 py-2 font-semibold text-white rounded-lg bg-primary hover:bg-orange-300"
            >
                <img
                    src="../../assets/voltar.png"
                    alt="Voltar"
                    class="w-5 h-5"
                />
            </button>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="flex flex-col gap-5 p-5 bg-white shadow-md sm:rounded-lg"
                >
                    <h2 class="text-2xl font-bold">Novo Funcionário</h2>
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex flex-col col-span-1 gap-2">
                                <label for="name">Nome *</label>
                                <input
                                    type="text"
                                    v-model="form.name"
                                    placeholder="Seu Nome"
                                    class="col-span-1 border-none rounded-lg bg-neutral-200"
                                />
                                <span
                                    v-if="form.errors.name"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.name }}</span
                                >
                            </div>
                            <div class="flex flex-col col-span-1 gap-2">
                                <label for="name">E-mail *</label>
                                <input
                                    type="email"
                                    v-model="form.email"
                                    placeholder="Seu Email"
                                    class="col-span-1 border-none rounded-lg bg-neutral-200"
                                />
                                <span
                                    v-if="form.errors.email"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.email }}</span
                                >
                            </div>
                            <div class="flex flex-col col-span-1 gap-2">
                                <label for="name">CPF *</label>
                                <input
                                    type="text"
                                    v-model="form.cpf"
                                    placeholder="Seu CPF"
                                    class="col-span-1 border-none rounded-lg bg-neutral-200"
                                    v-mask-cpf
                                />
                                <span
                                    v-if="form.errors.cpf"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.cpf }}</span
                                >
                            </div>
                            <div class="flex flex-col col-span-1 gap-2">
                                <label for="name">Cargo *</label>
                                <select
                                    v-model="form.role"
                                    class="col-span-1 border-none rounded-lg bg-neutral-200"
                                >
                                    <option selected disabled value="0">
                                        Selecione
                                    </option>
                                    <option value="admin">admin</option>
                                    <option value="recepcionist">
                                        recepcionista
                                    </option>
                                    <option value="biomedic">biomédico</option>
                                </select>
                                <span
                                    v-if="form.errors.role"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.role }}</span
                                >
                            </div>
                            <button
                                class="col-span-2 px-4 py-2 text-xl font-semibold text-center text-white uppercase rounded-lg bg-primary"
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
    <div
        v-if="flash.error"
        class="fixed bottom-0 left-0 w-full px-6 py-4 text-lg text-white bg-red-500"
    >
        {{ flash.error }}
    </div>
</template>
