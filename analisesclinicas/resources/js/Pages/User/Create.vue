<script> 
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';

    export default {
        components: {
            Head,
            AuthenticatedLayout,
            Link,
        },
        data() {
            return {
                form: {
                    name: "",
                    email: "",
                    cpf: "",
                    password: "",
                },
            }
        },
        methods: {
            async createUser(){
                await axios.post('/create/new/user', this.form);
                window.location.href = route('user.index');
            }
        }
    }
</script>
<template>

    <Head title="Usuários" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Usuários</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white flex justify-between items-center shadow-sm sm:rounded-lg">
                <h2 class="text-2xl font-bold">Novo Usuário</h2>
                    <form @submit.prevent="createUser" >
                        <input type="text" v-model="form.name" placeholder="Seu Nome">
                        <input type="email" v-model="form.email" placeholder="Seu Email">
                        <input type="text" v-model="form.cpf" placeholder="Seu CPF">
                        <input type="password" v-model="form.password" placeholder="Sua Senha">
                        <button type="submit" class="px-4 py-2 rounded-lg bg-sky-200 border-sky-600 text-neutral-700">Criar Usuário</button>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>


</template>