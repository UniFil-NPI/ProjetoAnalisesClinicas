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
                doctor_name: "",
                CRM: "",
            }),
            showError:true,
        };
    },
    methods: {
        save() {
            this.form.post('/create/new/doctor');
        },
    },
};
</script>

<template>
    <Head title="Novo Medico" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Médicos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white flex flex-col gap-8 shadow-sm shadow-primary sm:rounded-lg p-5"
                >
                    <h2 class="text-2xl font-bold">Novo Médico</h2>
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-5 gap-4">
                            <div class="col-span-3 flex flex-col gap-2">
                                <label for="cpf">Nome do Médico</label>

                                <input
                                    type="text"
                                    v-model="form.doctor_name"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />

                                <span
                                    v-if="form.errors.doctor_name"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.doctor_name }}</span
                                >
                            </div>

                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="name">CRM</label>
                                <input
                                    type="text"
                                    v-model="form.CRM"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.CRM"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.CRM }}</span
                                >
                            </div>

                            <button
                                class="col-span-5 px-4 py-2 rounded-lg bg-primary text-white text-xl uppercase text-center font-semibold"
                                type="submit"
                            >
                                Criar Médico
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
