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
        patient: Object,
    },
    data() {
        return {
            form: useForm({
                name: this.patient.name,
                email: this.patient.email,
                cpf: this.patient.cpf,
                post_code: this.patient.post_code,
                phone_number: this.patient.phone_number,
                street: this.patient.street,
                building_number: this.patient.building_number,
                secondary_address: this.patient.secondary_address,
                city: this.patient.city,
                state: this.patient.state,
                neighborhood: this.patient.neighborhood,
                birth_date: this.patient.birth_date,
                health_insurance: this.patient.health_insurance,
                biological_sex: this.patient.biological_sex,
            }),
        };
    },
    methods: {
        save() {
            this.form.post(
                "/patient/update/" + this.patient.patient_id,
                this.form
            );
        },
        async getCep() {
            let response = await axios.get(route("cep", this.form.post_code));
            this.form.city = response.data.localidade;
            this.form.state = response.data.uf;
            this.form.street = response.data.logradouro;
            this.form.neighborhood = response.data.bairro;
        },
    },
};
</script>
<template>
    <Head title="Pacientes" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pacientes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white flex flex-col gap-5 shadow-sm shadow-primary sm:rounded-lg p-5"
                >
                    <h2 class="text-2xl font-bold">
                        Editar cadastro do paciente
                    </h2>
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-5 gap-4">
                            <div class="col-span-3 flex flex-col gap-2">
                                <label for="name">Nome Completo</label>
                                <input
                                    type="text"
                                    v-model="form.name"
                                    placeholder="Nome"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.name"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.name }}</span
                                >
                            </div>

                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="cpf">CPF</label>
                                <input
                                    type="text"
                                    v-model="form.cpf"
                                    placeholder="CPF"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.cpf"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.cpf }}</span
                                >
                            </div>

                            <div class="col-span-3 flex flex-col gap-2">
                                <label for="name">Email</label>
                                <input
                                    type="email"
                                    v-model="form.email"
                                    placeholder="Email"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.email"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.email }}</span
                                >
                            </div>

                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="name">Telefone</label>
                                <input
                                    type="text"
                                    v-model="form.phone_number"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.phone_number"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.phone_number }}</span
                                >
                            </div>

                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">CEP</label>
                                <input
                                    type="text"
                                    v-model="form.post_code"
                                    v-on:input="getCep"
                                    placeholder="CEP"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.post_code"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.post_code }}</span
                                >
                            </div>

                            <div class="col-span-3 flex flex-col gap-2">
                                <label for="name">Rua</label>
                                <input
                                    type="text"
                                    v-model="form.street"
                                    placeholder="Rua"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.street"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.street }}</span
                                >
                            </div>

                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">Número</label>
                                <input
                                    type="text"
                                    v-model="form.building_number"
                                    placeholder="Número"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.building_number"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.building_number }}</span
                                >
                            </div>

                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="name">Complemento</label>
                                <input
                                    type="text"
                                    v-model="form.secondary_address"
                                    placeholder="Complemento"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                            </div>

                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">Bairro</label>
                                <input
                                    type="text"
                                    v-model="form.neighborhood"
                                    placeholder="Bairro"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.neighborhood"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.neighborhood }}</span
                                >
                            </div>

                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">Cidade</label>
                                <input
                                    type="text"
                                    v-model="form.city"
                                    placeholder="Cidade"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.city"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.city }}</span
                                >
                            </div>

                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">Estado</label>
                                <input
                                    type="text"
                                    v-model="form.state"
                                    placeholder="Estado"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.state"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.state }}</span
                                >
                            </div>

                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="name">Data de Nascimento</label>
                                <input
                                    type="date"
                                    v-model="form.birth_date"
                                    placeholder="Data de nascimento"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.birth_date"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.birth_date }}</span
                                >
                            </div>

                            <div class="col-span-1 flex flex-col gap-2">
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
                                <label for="name">Sexo</label>
                                <select
                                    v-model="form.biological_sex"
                                    class="col-span-1 bg-neutral-200 border-none rounded-lg"
                                >
                                    <option selected disabled value="0">
                                        Sexo biológico
                                    </option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                                <span
                                    v-if="form.errors.biological_sex"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.biological_sex }}</span
                                >
                            </div>

                            <div class="col-span-1 flex flex-col gap-2">
                                <Label>Status</Label>
                                <label
                                    class="inline-flex items-center cursor-pointer"
                                >
                                    <input
                                        type="checkbox"
                                        value=""
                                        class="sr-only peer"
                                    />
                                    <div
                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
                                    ></div>
                                    <span
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        v-if="patient.status === true"
                                        >Ativo</span
                                    >
                                    <span
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        v-if="patient.status === false"
                                        >Inativo</span
                                    >
                                </label>
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
