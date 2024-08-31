<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

export default {
    components: {
        Head,
        AuthenticatedLayout,
        Link,
    },
    props: {
        exam: Object,
    },
    data() {
        return {
            form: useForm({
                lab: this.exam.lab,
                exam_date: this.exam.exam_date,
                description: this.exam.description,
                health_insurance: this.exam.health_insurance,
            }),
        };
    },
    methods: {
        save() {
            this.form.post("/exam/update/" + this.exam.id, this.form);
        },
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

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white flex flex-col gap-5 shadow-sm shadow-primary sm:rounded-lg p-5"
                >
                    <h2 class="text-2xl font-bold">Editar exame do paciente</h2>
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-5 gap-4">
                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="name">Local de coleta</label>
                                <input
                                    type="text"
                                    v-model="form.lab"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.lab"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.lab }}</span
                                >
                            </div>

                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="name">Convênio</label>
                                <select
                                    v-model="form.health_insurance"
                                    class="bg-neutral-200 border-none rounded-lg"
                                >
                                    <option selected disabled value="0">
                                        Convênio
                                    </option>
                                    <option value="Nenhum">Nenhum</option>
                                    <option value="Unimed">Unimed</option>
                                    <option value="Hausey">Hausey</option>
                                    <option value="SUS">SUS</option>
                                    <option value="Hospitalar">
                                        Hospitalar
                                    </option>
                                    <option value="Cassi">Cassi</option>
                                    <option value="Sulamérica">
                                        Sulamérica
                                    </option>
                                </select>
                                <span
                                    v-if="form.errors.health_insurance"
                                    class="text-sm text-red-600"
                                    >{{
                                        form.errors.name.health_insurance
                                    }}</span
                                >
                            </div>

                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="date">Data do Exame</label>
                                <input
                                    type="date"
                                    v-model="form.exam_date"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.exam_date"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.exam_date }}</span
                                >
                            </div>

                            <div class="col-span-5 flex flex-col gap-2">
                                <label>Descrição do Exame</label>
                                <textarea
                                    v-model="form.description"
                                    class="bg-neutral-200 border-none rounded-lg"
                                ></textarea>
                                <span
                                    v-if="form.errors.description"
                                    class="text-sm text-red-600"
                                >
                                    {{ form.errors.description }}
                                </span>
                            </div>

                            <button
                                type="submit"
                                class="px-4 py-2 rounded-lg bg-primary text-white col-span-5 text-xl uppercase text-center font-semibold"
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
