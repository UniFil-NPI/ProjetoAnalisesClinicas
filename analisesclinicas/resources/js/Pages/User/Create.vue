<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    error: {
        type: String,
        default: null,
    },
});

const form = useForm({
    name: "",
    email: "",
    cpf: "",
    role: 0,
});
const errorMessage = ref(null);

const save = () => {
    form.post("/user/store");
    errorMessage.value = props.error;
};

const clearError = () => {
    errorMessage.value = null;
};

watch(
    () => props.error,
    (newError) => {
        errorMessage.value = newError;
    }
);

watch(
    () => errorMessage.value,
    (newError) => {
        errorMessage.value = newError;
        if (newError) {
            setTimeout(clearError, 5000);
        }
    }
);
</script>
<template>
    <Head title="Usuários" />

    <AuthenticatedLayout>
        <template #header>
            <button
                @click="$inertia.visit(route('user.index'))"
                class="bg-primary hover:bg-orange-300 text-white px-4 py-2 rounded-lg font-semibold"
            >
                <img
                    src="../../assets/voltar.png"
                    alt="Voltar"
                    class="w-5 h-5"
                />
            </button>
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
                                    <option value="technician">técnico</option>
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
    <div
        v-if="errorMessage"
        class="w-full py-4 px-6 bg-red-500 text-white text-lg fixed bottom-0 left-0"
    >
        {{ errorMessage }}
    </div>
</template>
