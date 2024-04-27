<template>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+10&display=swap" rel="stylesheet">
    <div class="flex flex-col">

        <nav class="w-full h-full bg-dark py-2 jersey-10-regular text-xl sm:text-2xl z-10">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div class="flex-shrink-0">
                        <a href="/" class="text-white text-2xl font-semibold">
                            <figure>
                                <img class="w-[23%]" :src="imagenEco" alt="imagen de logo"
                                    title="¡Hola! ¿Eres nuevo por aquí? Me encanta conocer gente nueva.">
                                <figcaption lang="es" class="hidden">Esta es una imagen del logo de ReUsoTec
                                </figcaption>
                            </figure>
                        </a>
                    </div>
                    <div class="hidden md:block">
                        <ul class="flex space-x-4">
                            <li><a :href="route('about')" :class="{ 'underline': route().current('about') }" v-tooltip.top="{ value: 'Únete como empresa', autoHide: false }"
                                    class="text-white cursor border-r-2 pe-2 hover:underline">Se parte del cambio</a></li>
                            <li><a :href="route('conocenos')" :class="{ 'underline': route().current('conocenos') }"
                                    class="text-white cursor border-r-2 pe-2 hover:underline">conócenos</a></li>
                            <li><a :href="route('login')" :class="{ 'underline': route().current('login') }"
                                    class="text-white cursor border-r-2 pe-2 hover:underline">inicio sesión</a></li>
                            <li><a :href="route('register')" :class="{ 'underline': route().current('register') }" v-tooltip.top="{ value: 'ReUsoPartner', autoHide: false }"
                                    class="text-white cursor hover:underline">Registrarse</a></li>
                        </ul>
                    </div>
                    <div class="md:hidden">
                        <!-- Mobile menu button -->
                        <button class="text-white hover:text-white focus:outline-none">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-1 overflow-y-auto overflow-x-hidden bg-gray-200">

            <slot />

        </main>

        <footer class="px-2 bg-dark text-white flex flex-col py-6">
            <div class="container mx-auto flex flex-wrap items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0 mr-6">
                    <h2 class="text-xl sm:text-2xl font-bold">ReUsoTec</h2>
                </div>
                <!-- Redes Sociales -->
                <div class="flex justify-center items-center space-x-4">
                    <a href="#" target="_blank" class="text-white hover:text-gray-400 transition duration-300">
                        <font-awesome-icon :icon="faInstagram" size="xl" />
                    </a>
                    <a href="#" target="_blank" class="text-white hover:text-gray-400 transition duration-300">
                        <font-awesome-icon :icon="faFacebook" size="xl" />
                    </a>
                    <a href="#" target="_blank" class="text-white hover:text-gray-400 transition duration-300">
                        <font-awesome-icon :icon="faWhatsapp" size="xl" />
                    </a>
                    
                </div>
                
                <div>
                    <a href="#particles" class="text-white hover:text-gray-400 transition duration-300">
                        <ArrowUpCircleIcon class="w-12 animate-bounce"/>
                    </a>
                </div>
            </div>
            <div class="container mt-8 flex justify-center md:ms-36">
                <a class="flex justify-center" href="#" target="_blank">
                    Creado por <strong> &copy; Taytech</strong>
                </a>
            </div>
        </footer>


    </div>
</template>

<script setup>
import imagenEco from '../../../public/assets/img/ECOBOT CORTADO.svg';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { ArrowUpCircleIcon } from '@heroicons/vue/24/solid'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faInstagram, faFacebook, faWhatsapp } from '@fortawesome/free-brands-svg-icons'



AOS.init();

</script>

<style>
body {
    font-family: "Roboto Mono", monospace;
    font-weight: 400;
    font-style: normal;
    color: #fff;
    line-height: 1.3;
    -webkit-font-smoothing: antialiased;
}

.jersey-10-regular {
    font-family: "Jersey 10", sans-serif;
    font-weight: 400;
    font-style: normal;
}
</style>
