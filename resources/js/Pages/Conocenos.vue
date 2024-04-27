<template>

    <Head title="Conócenos" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+25&display=swap" rel="stylesheet">

    <PageLayout>
        <template #header>
            Conócenos
        </template>

        <!-- parte 1 -->
        <div class="bg-gradient-to-b from-dark to-secondary overflow-hidden h-screen flex">

            <div class="sm:flex sm:grid grid-cols-6 gap-4 mt-2">
                <div class="sm:col-span-4 md:col-span-3 p-12 m-auto">
                    <!-- Agrega la etiqueta de video con la ruta del archivo de video -->
                    <figure @mousemove="handleMouseMove" class="flex justify-center">
                        <img class="rounded-xl shadow-2xl hover:shadow-6xl" :src="imagen"
                            alt="imagen de robot llamado -- Atom"
                            v-tooltip.top="{ value: 'Buscando un mundo mejor', autoHide: false }">
                        <figcaption lang="es" class="hidden">Esta es una imagen de ReUsoTec
                        </figcaption>
                    </figure>


                </div>
                <div class="sm:col-span-2 md:col-span-3 p-8 m-auto">
                    <div>
                        <h2 class="text-2xl sm:text-4xl font-bold text-center text-white jersey-25-regular">
                            estamos comprometidos con la creación de un mundo más sostenible y respetuoso con el medio
                            ambiente.
                        </h2>
                        <div class="mt-4 flex justify-center">
                            <a href="#parte2" class="py-2 px-4 text-lg sm:text-xl text-primary cursor hover:scale-125">
                                <ArrowDownCircleIcon class="w-24 animate-bounce" />
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- parte 2 -->
        <div id="parte2" class="w-full flex h-full pb-2 bg-gradient-to-b from-secondary to-dark overflow-hidden">
            <div class="w-full flex justify-center px-12" data-aos="fade-down" data-aos-duration="1000" data-aos-easing="linear">
                <!-- Agrega la etiqueta de video con la ruta del archivo de video -->
                <video autoplay loop controls muted title="Visión proceso de reciclaje ReUsoTec"
                    class="flex justify-center rounded-xl shadow-2xl hover:shadow-6xl w-[80%]">
                    <source src="/assets/video/conocenos.mp4" type="video/mp4">
                    Tu navegador no soporta el elemento de video.
                </video>
            </div>
        </div>

        <!-- Parte 3 -->
        <div class="w-full flex h-screen fondo1 py-4 bg-dark overflow-hidden">
            <div class="mt-6 w-full flex" data-aos="fade-up" data-aos-duration="1000" data-aos-easing="linear">
                <div  class="justify-center m-auto">
                <h1 class="flex justify-center text-6xl text-[40pt] jersey-25-regular">Visión</h1>
                <span class="pt-6">
                    <p class="px-12 pt-6 sm:px-44 text-2xl sm:text-[38pt] text-center font-sans jersey-25-regular">
                        En 5 años tener la fundación "Rescatando mi generación"
                        <br>
                        Apoyando a la juventud en estado de drogadicción para encontrar un futuro mejor
                    </p>
                </span>

            </div>
            </div>
        </div>


    </PageLayout>
</template>

<script setup>
import PageLayout from '@/Layouts/PageLayout.vue';
import { Head } from '@inertiajs/vue3';
import imagen from '../../../public/assets/img/conocenos.jpg';
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
