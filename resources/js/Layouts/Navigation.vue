<template>
    <div :class="$page.props.showingMobileMenu ? 'block' : 'hidden'" @click="$page.props.showingMobileMenu = false"
        class="fixed inset-0 z-20 bg-red-900 opacity-50 transition-opacity lg:hidden"></div>

    <div :class="$page.props.showingMobileMenu ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
        class="overflow-y-auto fixed inset-y-0 left-0 z-30 w-64 bg-gray-600 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex justify-center items-center mt-4">
            <div class="flex items-center justify-center">
                <img :src="imglogo_w" class="w-4/6" alt="">

                <!-- <span class="mx-2 text-2xl font-semibold text-white">Administrador</span> -->
            </div>
        </div>

        <nav class="mt-6" x-data="{ isMultiLevelMenuOpen: false }">
            <SeparadorMenu>Menú</SeparadorMenu>
            <nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                <HomeIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Inicio</span>
            </nav-link>
            <nav-link :href="route('about')" :active="route().current('about')">
                <FireIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Pagina </span>
            </nav-link>
            <SeparadorMenu>Registro</SeparadorMenu>
            <nav-link :href="route('registrados.index')" :active="route().current().includes('registrados','registrado')">
                <ClipboardDocumentIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Registrados </span>
            </nav-link>
            <SeparadorMenu v-if="$page.props.user.permissions.includes('rol-listar')">Configuración</SeparadorMenu>
            <nav-link v-if="$page.props.user.permissions.includes('usuarios-listar')" :href="route('users.index')"
                :active="route().current().includes('users')">
                <UserGroupIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Usuarios</span>
            </nav-link>

            <nav-link class="flex items-center " v-if="$page.props.user.permissions.includes('rol-listar')"
                :href="route('roles.index')" :active="route().current().includes('roles')">
                <FingerPrintIcon class="h-6 w-6 text-white" />
                <span class="mx-3">Roles</span>

            </nav-link>

        </nav>
    </div>
</template>

<script>
import NavLink from '@/Components/NavLink.vue';
import SeparadorMenu from "@/Components/SeparadorMenu.vue";
import { Link } from '@inertiajs/vue3';
import imglogo_w from '/public/assets/img/logo_white.png'
import { ref } from 'vue'
import { FingerPrintIcon, UserGroupIcon, HomeIcon, FireIcon, ClipboardDocumentIcon, BarsArrowDownIcon } from '@heroicons/vue/24/solid'

export default {
    components: {
        NavLink,
        Link,
        FingerPrintIcon,
        UserGroupIcon,
        HomeIcon,
        FireIcon,
        ClipboardDocumentIcon,
        BarsArrowDownIcon,
        SeparadorMenu
    },

    setup() {
        let showingTwoLevelMenu = ref(false)

        return {
            showingTwoLevelMenu,
            imglogo_w
        }
    },
}
</script>

<style scoped></style>
