<template>

    <Head title="Usuarios" />

    <AuthenticatedLayout>
        <template #header>
            Usuarios
        </template>

        <div class="inline-block min-w-full overflow-hidden mb-3 grid md:grid-cols-3 gap-4">
            
            <div class="...">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" @keydown.enter="handleEnterKey" v-model="search" id="default-search"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-0 focus:border-transparent"
                        placeholder="Busqueda de usuarios" required>
                    <PrimaryLink type="submit" @click="handleEnterKey"
                        class="text-white absolute end-2.5 bottom-2.5 bg-sky-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-sky-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Buscar</PrimaryLink>
                </div>
            </div>

            <div class="text-right p-4">
                
            </div>


        </div>
        <div class="flex flex-col overflow-x-auto">
            <div class="inline-block rounded-lg shadow">
                <div class="inline-block min-w-full py-2">
                    <div class="overflow-x-auto">
                        <table class="min-w-full whitespace-no-wrap ">
                            <thead>
                                <tr
                                    class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Fecha registro
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Nombre
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Edad
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Identificacion
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Dirección
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Telefono <br>
                                        Email
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Punto vive
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Genero
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Condición
                                    </th>
                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Etnía
                                    </th>

                                    <th
                                        class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                                        Editar
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in registrados" :key="user.id" class="text-gray-700">
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm"
                                        :class="{ 'bg-green-200': isToday(user.created_at) }">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ formatDate(new
                                            Date(user.created_at)) }}
                                        </p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ user.nombres }} {{ user.apellidos
                                            }} </p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ user.edad }}</p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ user.tipo_documento }} - {{
                                            user.identificacion }}</p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ user.direccion }} - {{
                                            user.sector }}</p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ user.telefono }} <br> {{
                                            user.email }}
                                        </p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap"
                                            :class="{ 'bg-blue-200 p-2 rounded-md': puntos.find(item => item.id == user.id_puntos).id_user == $page.props.auth.user.id }">
                                            {{ puntos.find(item => item.id == user.id_puntos).nombre }} </p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ user.genero }}</p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ user.condicion }}</p>
                                    </td>
                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ user.etnia }}</p>
                                    </td>

                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                        <SecondaryButton :href="route('registrados.edit', {id:user.id})">
                                            Editar
                                        </SecondaryButton>
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
            <pagination v-if="registrados.links" :links="registrados.links" />
        </div>

    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from "vue";
import { watch } from "vue";
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryLink from '@/Components/PrimaryLink.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";




const props = defineProps({
    registro: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
    validation: {
        type: Boolean,
        default: false,
    },
    puntos: {
        type: Object,
        default: ([]),
    }

});



const registrados = ref(props.registro.data);

if (props.validation) {
    let nuevosRegistros = [];

    // Agregar el último registro al nuevo array
    nuevosRegistros.push(props.registro);
    registrados.value = nuevosRegistros;

}

console.log(registrados.value);

// pass filters in search
let search = ref(props.filters.search);
let estado_users = ref(props.filters.estado_users ?? "");
const handleEnterKey = () => {
    router.get(
        "/registrados", {
        onSuccess: () => {
            window.location.reload();
        }
    },
{ search: search.value },
        {
            preserveState: true,
            replace: true,
        },

    );
};



const formatDate = (fechaHora) => {

    return `${fechaHora.getFullYear()}-${('0' + (fechaHora.getMonth() + 1)).slice(-2)}-${('0' + fechaHora.getDate()).slice(-2)}`;
}

const isToday = (fecha) => {
    const formattedDate = formatDate(new Date(fecha));
    const today = new Date();
    const formattedToday = formatDate(today);

    // Comparar solo el año, mes y día
    console.log(formattedDate === formattedToday);
    return formattedDate === formattedToday;
}


watch(search, (value) => {
    console.log("Valor de búsqueda actualizado:", value)
});
</script>
