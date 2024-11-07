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
        <nav class="w-full bg-transparent shadow-md py-3">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <div class="shrink-0 flex items-center">
                    <a :href="route('welcome')">
                        <ApplicationLogo
                            class="block h-14 w-auto fill-current text-gray-800"
                        />
                    </a>
                </div>

                <div class="flex flex-row">
                    <div v-if="$page.props.auth.user">
                        <a
                            :href="route('dashboard')"
                            class="text-white text-xl px-4 py-2 rounded-xl bg-primary hover:bg-orange-300"
                        >
                            Painel
                        </a>
                    </div>
                    <div v-else class="flex justify-end">
                        <a
                            :href="route('login')"
                            class="text-white text-xl px-4 py-2 rounded-xl bg-primary hover:bg-orange-300"
                        >
                            Entrar
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>
