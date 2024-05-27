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
                post_code: this.user.post_code,
                street: this.user.street,
                building_number: this.user.building_number,
                secondary_address: this.user.secondary_address,
                city: this.user.city,
                state: this.user.state,
                neighborhood: this.user.neighborhood,
                birth_date: this.user.birth_date,
                health_insurance: this.user.health_insurance == '0'? 'Nenhum' : this.user.health_insurance,
                biological_sex: this.user.biological_sex == 'Masculino' ? 1 : 2,
            },
        };
    },
    methods: {
        async updatePatient() {
            await axios.post("/user/update/" + this.user.id, this.form);
            window.location.href = route("user.index");
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
                    <form @submit.prevent="updatePatient">
                        <div class="grid grid-cols-5 gap-4">

                            <div class="grid grid-cols-5 gap-4">

                                <label for="name">Nome Completo</label>
                                <input
                                    type="text"
                                    v-model="form.name"
                                    placeholder="Nome"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />

                            </div>

                            <div class="col-span-2 flex flex-col gap-2">

                                <label for="cpf">CPF</label>
                                <input
                                    type="text"
                                    v-model="form.cpf"
                                    placeholder="CPF"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />

                            </div>

                            <div class="col-span-3 flex flex-col gap-2">

                                <label for="name">Email</label>
                                <input
                                    type="email"
                                    v-model="form.email"
                                    placeholder="Email"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />

                            </div>

                            <div class="col-span-2 flex flex-col gap-2">

                                <label for="name">CEP</label>
                                <input
                                    type="text"
                                    v-model="form.post_code"
                                    v-on:input="getCep"
                                    placeholder="CEP"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />

                            </div>

                            <div class="col-span-3 flex flex-col gap-2">

                                <label for="name">Rua</label>
                                <input
                                    type="text"
                                    v-model="form.street"
                                    placeholder="Rua"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />

                            </div>

                            <div class="col-span-2 flex flex-col gap-2">

                                <label for="name">Número</label>
                                <input
                                    type="text"
                                    v-model="form.building_number"
                                    placeholder="Número"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />

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

                            </div>

                            <div class="col-span-1 flex flex-col gap-2">

                                <label for="name">Cidade</label>
                                <input
                                    type="text"
                                    v-model="form.city"
                                    placeholder="Cidade"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />

                            </div>

                            <div class="col-span-1 flex flex-col gap-2">

                                <label for="name">Estado</label>
                                <input
                                    type="text"
                                    v-model="form.state"
                                    placeholder="Estado"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />

                            </div>

                            <div class="col-span-2 flex flex-col gap-2">

                                <label for="name">Data de Nascimento</label>
                                <input
                                    type="date"
                                    v-model="form.birth_date"
                                    placeholder="Data de nascimento"
                                    class="bg-neutral-200 border-none rounded-lg"
                                />

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

                            </div>

                            <button
                                type="submit"
                                class="px-4 py-2 rounded-lg bg-primary text-white col-span-2 text-xl uppercase text-center font-semibold"
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
