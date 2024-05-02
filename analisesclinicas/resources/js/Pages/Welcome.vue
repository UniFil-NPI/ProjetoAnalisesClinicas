<script setup>
import { Head, Link } from "@inertiajs/vue3";

</script>

<template>
    <Head title="Welcome" />

    <header>
        <div class="navbar bg-base-100">
            <div class="flex-1">
                <a class="btn btn-ghost text-xl">UniFil</a>
            </div>
        </div>
    </header>

    <main>
        <div class="hero min-h-screen bg-base-100">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-center text-neutral-content">
                <div class="max-w-md">
                    <h1 class="mb-5 text-5xl font-bold">Caro cliente</h1>
                    <p class="mb-5">
                        Entre com seu CPF e com a senha que foi enviada para seu Email.
                        Não esqueça de troca-lá quando entrar pela primeira vez, caso seja de sua vontade!
                    </p>
                    <a href="/login" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="footer p-10 bg-base-100 text-base-content">
        <nav>
            <h6 class="footer-title">Serviços</h6>
            <a class="link link-hover">Exames</a>
        </nav>
        <nav>
            <h6 class="footer-title">Company</h6>
            <a class="link link-hover">About us</a>
            <a class="link link-hover">Contact</a>
        </nav>
        <nav>
            <h6 class="footer-title">Legal</h6>
            <a class="link link-hover">Terms of use</a>
            <a class="link link-hover">Privacy policy</a>
        </nav> 
    </footer>
</template>
