<script setup>
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>
<template>
    <header>
        <nav class="w-full bg-neutral-50 shadow-md shadow-primary py-3">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <img
                    src="../assets/UniFil_Logo Isolado Horizontal-01.png"
                    height="60"
                    width="200"
                />

                <div class="flex flex-row">
                    <div v-if="$page.props.auth.user">
                        <a :href="route('dashboard')" class=" text-neultral-700 text-xl
                        px-4 py-2 rounded-xl
                        hover:-translate-x-1 hover:-translate-y-1 hover:shadow-[5px_5px_rgba(242,_148,_0,_0.3),_10px_10px_rgba(242,_148,_0,_0.2),_15px_15px_rgba(242,_148,_0,_0.1)] transform transition-all duration-300 ease-in-out">
                            Painel
                        </a>
                    </div>
                    <div v-else class="flex justify-end">
                        <a
                            :href="route('login')"
                            class=" text-neultral-700 text-xl
                        px-4 py-2 rounded-xl
                        hover:-translate-x-1 hover:-translate-y-1 hover:shadow-[5px_5px_rgba(242,_148,_0,_0.3),_10px_10px_rgba(242,_148,_0,_0.2),_15px_15px_rgba(242,_148,_0,_0.1)] transform transition-all duration-300 ease-in-out"
                        >
                            Entrar
                        </a>
                    </div>
                </div>
            </div>

            <!-- <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class=""
                >
                    Register
                </Link> -->
        </nav>
    </header>
</template>
