<template>

    <Head title="Sobre nosotros" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+25&display=swap" rel="stylesheet">

    <PageLayout>
        <template #header>
            Sobre nosotros
        </template>

        <!-- parte 1 -->
        <div class="bg-dark overflow-hidden h-screen fondo1 flex">
            <div class="flex flex-col justify-center m-auto w-[80%]">
                <h2 class="px-12 text-white text-2xl sm:text-[38pt] text-center jersey-25-regular">
                    ¡Haz parte del cambio! Conviértete en socio y contribuye al cuidado del medio ambiente mientras
                    fortaleces
                    tu marca.
                </h2>
                <div class="mt-6 flex justify-center">
                    <a href="#formulario"
                        class="py-2 px-4 rounded-md bg-primary text-lg sm:text-xl text-secondary cursor shadow-xl hover:scale-125 hover:shadow-2xl">
                        Ir al Formulario
                    </a>
                </div>
            </div>
        </div>

        <!-- parte 2 -->
        <div class="w-full flex h-full pb-2 bg-dark overflow-hidden">
            <div class="sm:flex sm:grid grid-cols-6 gap-4 mt-2" data-aos="fade-down" data-aos-duration="1000"
                data-aos-easing="linear">
                <div class="sm:col-span-4 md:col-span-3 p-12 m-auto">
                    <!-- Agrega la etiqueta de video con la ruta del archivo de video -->
                    <figure @mousemove="handleMouseMove" class="flex justify-center">
                        <img class="drop-shadow-[0_35px_35px_rgba(1,39,18,1)]" :src="imagen1"
                            alt="imagen de robot llamado -- Atom"
                            v-tooltip.top="{ value: '¿Quieres hacer la diferencia?', autoHide: false }">
                        <figcaption lang="es" class="hidden">Esta es una de arom, el robot de la marca
                        </figcaption>
                    </figure>


                </div>
                <div class="sm:col-span-2 md:col-span-3 p-8 m-auto">
                    <div>
                        <h2 class="text-2xl sm:text-4xl font-bold text-center text-white jersey-25-regular">
                            Haz del reciclaje una parte integral de tu empresa. Conviértete en nuestro socio y haz parte
                            de la
                            diferencia.
                        </h2>
                        <div class="mt-4 flex justify-center">
                            <a href="#formulario"
                                class="py-2 px-4 text-lg sm:text-xl text-primary cursor hover:scale-125">
                                <ArrowDownCircleIcon class="w-24 animate-bounce" />
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Parte 3 -->
        <div class="w-full flex fondo1 py-4 bg-dark overflow-hidden">
            <div class="mt-6 w-full" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="linear">
                <div id="formulario" class="w-full flex justify-center">
                    <form class="w-full max-w-lg bg-white p-8 rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold mb-6 text-center text-secondary">A un paso del futuro!</h2>
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre de la
                                empresa</label>
                            <input id="nombre" name="nombre" type="text" required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Correo
                                electrónico</label>
                            <input id="email" name="email" type="email" required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mb-6">
                            <label for="mensaje" class="block text-sm font-medium text-gray-700">Mensaje</label>
                            <textarea id="mensaje" name="mensaje" rows="4" required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit"
                                class="w-full px-4 py-2 bg-primary text-white font-semibold rounded-md shadow-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary-light">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </PageLayout>
</template>

<script setup>
import PageLayout from '@/Layouts/PageLayout.vue';
import { Head } from '@inertiajs/vue3';
import imagen1 from '../../../public/assets/img/ECOBOT.svg';
import { ArrowDownCircleIcon } from '@heroicons/vue/24/solid'

//Hover 3d
const handleMouseMove = (event) => {
    const { offsetX, offsetY, target } = event;
    const { clientWidth, clientHeight } = target;
    const rotateX = (offsetY - clientHeight / 2) / 10;
    const rotateY = (offsetX - clientWidth / 2) / 10;

    target.style.transform = `perspective(2000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) rotateZ(0deg) translateX(-30px) translateY(0px) translateZ(0px)`;
};

</script>

<style scoped>
.fondo1 {
    background-image: url('../../../public/assets/img/fondo1.svg');
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover, auto;
}

.jersey-25-regular {
    font-family: "Jersey 25", sans-serif;
    font-weight: 400;
    font-style: normal;
}
</style>
