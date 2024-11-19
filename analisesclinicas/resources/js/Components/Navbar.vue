<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

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
        <nav class="w-full py-3 bg-transparent shadow-md">
            <div class="flex items-center justify-between mx-auto max-w-7xl">
                <div class="flex items-center shrink-0">
                    <a :href="route('welcome')">
                        <ApplicationLogo
                            class="block h-[75px] w-auto fill-current text-gray-800"
                        />
                    </a>
                </div>

                <div class="flex flex-row">
                    <div v-if="$page.props.auth.user">
                        <a
                            :href="route('dashboard')"
                            class="px-4 py-2 text-xl text-white rounded-xl bg-primary hover:bg-orange-300"
                        >
                            Painel
                        </a>
                    </div>
                    <div v-else class="flex justify-end">
                        <a
                            :href="route('login')"
                            class="px-4 py-2 text-xl text-white rounded-xl bg-primary hover:bg-orange-300"
                        >
                            Entrar
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>
