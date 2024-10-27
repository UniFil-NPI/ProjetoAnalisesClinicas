<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";

const props = defineProps({
    patient: Object,
    error: {
        type: String,
        default: null,
    },
});

const form = useForm({
    name: props.patient.name,
    email: props.patient.email,
    cpf: props.patient.cpf,
    post_code: props.patient.post_code,
    phone_number: props.patient.phone_number,
    street: props.patient.street,
    building_number: props.patient.building_number,
    secondary_address: props.patient.secondary_address,
    city: props.patient.city,
    state: props.patient.state,
    neighborhood: props.patient.neighborhood,
    birth_date: props.patient.birth_date,
    health_insurance: props.patient.health_insurance,
    biological_sex: props.patient.biological_sex,
    status: props.patient.status,
});

const showError = ref(true);

const save = () => {
    form.post("/patient/update/" + props.patient.patient_id, form);
};

const getCep = async () => {
    let response = await axios.get(route("cep", form.post_code));
    form.city = response.data.localidade;
    form.state = response.data.uf;
    form.street = response.data.logradouro;
    form.neighborhood = response.data.bairro;
};
const changeStatus = () => {
    form.status = !form.status;
};

watch(
    () => props.error,
    (newValue) => {
        if (newValue == null) {
            showError = false;

            setTimeout(() => {
                showError = true;
            }, 2000);
        }
    }
);
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
                                    v-mask-phone.br
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
                                    v-mask="'#####-###'"
                                    maxlength="9"
                                    v-on:input="getCep"
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
                                        v-if="patient.status === true"
                                        type="checkbox"
                                        value=""
                                        class="sr-only peer"
                                        @click="changeStatus()"
                                        checked
                                    />
                                    <input
                                        v-if="patient.status === false"
                                        type="checkbox"
                                        value=""
                                        class="sr-only peer"
                                        @click="changeStatus()"
                                    />
                                    <div
                                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
                                    ></div>
                                    <span
                                        v-if="patient.status === true"
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >Ativo</span
                                    >
                                    <span
                                        v-if="patient.status === false"
                                        class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300"
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

    <div
        v-if="error && showError"
        class="w-full py-4 px-6 bg-red-500 text-white text-lg fixed bottom-0 left-0"
    >
        {{ error }}
    </div>
</template>
