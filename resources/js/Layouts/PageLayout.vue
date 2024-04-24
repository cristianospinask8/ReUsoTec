<template>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+10&display=swap" rel="stylesheet">
    <div class="flex flex-col">

        <nav class="w-full h-full bg-dark py-4 jersey-10-regular text-xl sm:text-2xl z-10">
            <div class="mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div class="flex-shrink-0">
                        <a href="#" class="text-white text-2xl font-semibold">Logo</a>
                    </div>
                    <div class="hidden md:block">
                        <ul class="flex space-x-4">
                            <li><a :href="route('dashboard')" :class="{'underline': route().current('dashboard') }" class="text-white cursor hover:underline">Se parte del cambio</a></li>
                            <li><a :href="route('about')" :class="{'underline': route().current('about') }" class="text-white cursor hover:underline">conócenos</a></li>
                            <li><a :href="route('login')" :class="{'underline': route().current('login') }" class="text-white cursor hover:underline">inicio sesión</a></li>
                            <li><a :href="route('register')" :class="{'underline': route().current('register') }" class="text-white cursor hover:underline">Registrarse</a></li>
                        </ul>
                    </div>
                    <div class="md:hidden">
                        <!-- Mobile menu button -->
                        <button class="text-gray-300 hover:text-white focus:outline-none">
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

    </div>
</template>

<script setup>

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
