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
                phone_number: "",
                post_code: "",
                street: "",
                building_number: "",
                secondary_address: "",
                city: "",
                state: "",
                neighborhood: "",
                birth_date: "",
                health_insurance: 0,
                biological_sex: 0,
            }),
            currentDate: "",

        };
    },
    methods: {
        save() {
            this.form.post("/create/new/patient");
        },
        async getCep() {
            let response = await axios.get(route("cep", this.form.post_code));
            this.form.city = response.data.localidade;
            this.form.state = response.data.uf;
            this.form.street = response.data.logradouro;
            this.form.neighborhood = response.data.bairro;
        },
        getCurrentDate() {
            let today = new Date();

            let dd = today.getDate();

            let mm = today.getMonth() + 1;

            let yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }

            this.currentDate = yyyy + "-" + mm + "-" + dd;


        }
    },
    mounted() {
        this.getCurrentDate();
    },
};
</script>
<template>
    <Head title="Novo Paciente" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Pacientes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white flex flex-col gap-8 shadow-sm shadow-primary sm:rounded-lg p-5"
                >
                    <h2 class="text-2xl font-bold">Novo Paciente</h2>
                    <form @submit.prevent="save">
                        <div class="grid grid-cols-5 gap-4">

                            <div class="col-span-3 flex flex-col gap-2">
                                <label for="name">Nome Completo</label>
                                <input
                                    type="text"
                                    v-model="form.name"
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
                                    class="bg-neutral-200 border-none rounded-lg"
                                    v-mask-cpf
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
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.email"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.email }}</span
                                >
                            </div>

                            <div class="col-span-2 flex flex-col gap-2">
                                <label for="name">Celular</label>
                                <input
                                    type="text"
                                    v-model="form.phone_number"
                                    class="bg-neutral-200 border-none rounded-lg"
                                    v-mask-phone.br
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
                                    maxlength="9"
                                    class="bg-neutral-200 border-none rounded-lg"
                                    v-mask="'#####-###'"
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
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.secondary_address"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.secondary_address }}</span
                                >
                            </div>

                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">Bairro</label>
                                <input
                                    type="text"
                                    v-model="form.neighborhood"
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
                                    :max="currentDate"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />
                                <span
                                    v-if="form.errors.birth_date"
                                    class="text-sm text-red-600"
                                    >{{ form.errors.birth_date }}</span
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
                                    >{{ form.errors.health_insurance }}</span
                                >
                            </div>

                            <div class="col-span-1 flex flex-col gap-2">
                                <label for="name">Sexo biológico</label>
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

                            <button
                                class="col-span-5 px-4 py-2 rounded-lg bg-primary text-white text-xl uppercase text-center font-semibold"
                                type="submit"
                            >
                                Criar Paciente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
