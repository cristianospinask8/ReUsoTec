<template>

    <Head title="Registro" />

    <GuestLayout :isRegister=true>
        <div class="flex grid grid-cols-2 gap-4 w-full">
            <Link href="/" class="flex items-center justify-center">
            <ApplicationLogo class="w-full sm:w-2/6 fill-current text-gray-500" />
            </Link>

            <div class="flex items-center justify-center">
                <img :src="logoViveD">
            </div>

        </div>


        <form @submit.prevent="submit">

            <div class="mt-6 justify-center">
                <Steps :model="items" v-model:activeStep="active" />
            </div>


            <div class="rounded-xl shadow-xl p-4">

                <!-- Formulario de registro 1 -->
                <div class="justify-center font-medium" v-if="active == 0">

                    <div class="w-full mt-6 sm:grid grid-cols-2 gap-4">

                        <!-- nombres -->
                        <div class="mb-4">
                            <InputLabel class="sm:text-sm text-xs" for="nombres" value="Nombres" />
                            <TextInput id="nombres" type="text" class="mt-1 block w-full p-0 sm:p-2"
                                v-model="form.nombres" required autofocus autocomplete="nombre" />
                            <InputError class="mt-1" :message="form.errors.nombres" />
                        </div>
                        <!-- apellidos -->
                        <div class="mb-4">
                            <InputLabel class="sm:text-sm text-xs" for="apellidos" value="Apellidos" />
                            <TextInput id="apellidos" type="text" class="mt-1 block w-full p-0 sm:p-2"
                                v-model="form.apellidos" required autocomplete="apellidos" />
                            <InputError class="mt-1" :message="form.errors.apellidos" />
                        </div>

                        <!-- edad e identificacion -->
                        <div class="col-span-2 mb-4 sm:flex">

                            <!-- edad -->
                            <div class="w-3/12 sm:pe-6">
                                <InputLabel class="sm:text-sm text-xs" for="edad" value="Edad" />
                                <TextInput id="edad" type="number" class="mt-1 p-0 sm:p-2 block w-full"
                                    v-model="form.edad" required autocomplete="edad" />
                                <InputError class="mt-1" :message="form.errors.edad" />
                            </div>

                            <!-- identificacion -->
                            <div class="w-full sm:w-9/12 grid grid-cols-4 gap-4 mt-4 sm:mt-0">
                                <!-- tipo de identificacion -->
                                <div class="col-span-1">
                                    <InputLabel for="tipo" value="Tipo" class="text-neutral-500 sm:text-sm text-xs" />
                                    <select id="tipo" name="tipo" v-model="form.tipo_documento"
                                        class="block w-full sm:px-4 sm:py-2 p-0 mt-1 text-base text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500">

                                        <option class="text-black text-[9px] sm:text-xs" v-for="tipo in tipoIden"
                                            :key="tipo.id" :value="tipo.nombre">
                                            {{ tipo.nombre }}
                                        </option>
                                    </select>
                                    <InputError class="mt-1" :message="form.errors.tipo_documento" />
                                </div>
                                <!-- Identificacion -->
                                <div class="col-span-3">
                                    <InputLabel for="identificacion" value="identificacion" />
                                    <TextInput id="identificacion" type="number" class="mt-1 block w-full p-0 sm:p-2"
                                        v-model="form.identificacion" required autocomplete="identificacion" />
                                    <InputError class="mt-1" :message="form.errors.edad" />
                                </div>

                            </div>



                        </div>

                        <!-- direccion -->
                        <div class="mb-4">
                            <InputLabel class="sm:text-sm text-xs" for="direccion" value="Dirección de residencia" />
                            <TextInput id="direccion" type="text" class="mt-1 block w-full p-0 sm:p-2"
                                v-model="form.direccion" required autofocus autocomplete="direccion" />
                            <InputError class="mt-1" :message="form.errors.direccion" />
                        </div>
                        <!-- sector -->
                        <div class="mb-4">
                            <InputLabel class="sm:text-sm text-xs" for="sector" value="Barrio o vereda" />
                            <TextInput id="sector" type="text" class="mt-1 block w-full p-0 sm:p-2"
                                v-model="form.sector" required autofocus autocomplete="sector" />
                            <InputError class="mt-1" :message="form.errors.sector" />
                        </div>
                        <!-- telefono -->
                        <div class="mb-4">
                            <InputLabel class="sm:text-sm text-xs" for="telefono" value="Telefono" />
                            <TextInput id="telefono" type="number" class="mt-1 block w-full p-0 sm:p-2"
                                v-model="form.telefono" required autofocus autocomplete="telefono" />
                            <InputError class="mt-1" :message="form.errors.telefono" />
                        </div>
                        <!-- email -->
                        <div class="mb-4">
                            <InputLabel class="sm:text-sm text-xs" for="email" value="Correo electronico" />
                            <TextInput id="email" type="email" class="mt-1 block w-full p-0 sm:p-2" v-model="form.email"
                                required autofocus autocomplete="username" />
                            <InputError class="mt-1" :message="form.errors.email" />
                        </div>

                    </div>

                    <!-- botones -->
                    <div class="flex pt-4 justify-end">
                        <Button type="button" @click="nextStep(1)"
                            class="bg-red-700 text-xs sm:text-sm text-white p-2 rounded-md shadow-xl">
                            Siguiente
                        </Button>
                    </div>

                </div>



                <!-- Formulario de registro 2 -->
                <div class="justify-center font-medium" v-if="active == 1">

                    <div class="w-full mt-6 sm:grid grid-cols-2 gap-4">

                        <!-- genero -->
                        <div class="mb-4">
                            <InputLabel class="sm:text-sm text-xs" for="genero" value="Genero" />
                            <div class="mt-2 block sm:flex">
                                <div class="">
                                    <input type="radio" id="masculino" value="Masculino" v-model="form.genero" />
                                    <label class="ps-2 text-sm sm:text-base" for="masculino">Masculino</label>
                                </div>
                                <div class="sm:ms-6">
                                    <input type="radio" id="two" value="Femenino" v-model="form.genero" />
                                    <label class="ps-2 text-sm sm:text-base" for="two">Femenino</label>
                                </div>
                                <!-- otros generos -->
                                <div v-if="IsNewGenero" class="sm:ms-6">
                                    <InputLabel class="sm:text-sm text-xs" for="genero" value="¿Cual?" />
                                    <TextInput id="genero" type="text" class="mt-1 block w-full p-0 sm:p-1"
                                        v-model="form.genero" autofocus autocomplete="genero" />
                                    <InputError class="mt-1" :message="form.errors.genero" />
                                </div>
                                <div v-else class="sm:ms-6">
                                    <input type="radio" id="two" value="true" v-model="IsNewGenero" />
                                    <label class="ps-2 text-sm sm:text-base" for="two">Otro</label>
                                </div>
                                



                            </div>

                        </div>
                        <!-- condicion -->
                        <div class="mb-4">
                            <InputLabel for="condicion" value="Condición" class="text-neutral-500 sm:text-sm text-xs" />
                            <select id="condicion" name="condicion" v-model="form.condicion"
                                class="block w-full sm:px-4 sm:py-2 p-0 mt-1 text-base text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500">

                                <option class="text-black" v-for="con in condiciones" :key="con.id" :value="con.code">
                                    {{ con.nombre }}
                                </option>
                            </select>
                            <InputError class="mt-1" :message="form.errors.condicion" />
                        </div>
                        <!-- etnia -->
                        <div class="mb-4">
                            <InputLabel for="etnia" value="Etnia" class="text-neutral-500 sm:text-sm text-xs" />
                            <select id="etnia" name="etnia" v-model="form.etnia"
                                class="block w-full sm:px-4 sm:py-2 p-0 mt-1 text-base text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500">

                                <option class="text-black" v-for="et in etnias" :key="et.id" :value="et.code">
                                    {{ et.nombre }}
                                </option>
                            </select>
                            <InputError class="mt-1" :message="form.errors.etnia" />
                        </div>
                        <!-- nivel estudio -->
                        <div class="mb-4">
                            <InputLabel for="nivel_estudio" value="Nivel de estudio"
                                class="text-neutral-500 sm:text-sm text-xs" />
                            <select id="nivel_estudio" name="nivel_estudio" v-model="form.nivel_estudio"
                                class="block w-full sm:px-4 sm:py-2 p-0 mt-1 text-base text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500">

                                <option class="text-black" v-for="niv in nivel_estudios" :key="niv.id"
                                    :value="niv.code">
                                    {{ niv.nombre }}
                                </option>
                            </select>
                            <InputError class="mt-1" :message="form.errors.nivel_estudio" />
                        </div>
                        <!-- Puntos vive digital -->
                        <div class="mb-4">
                            <InputLabel for="codePunto" value="Punto Vive Digital"
                                class="text-neutral-500 sm:text-sm text-xs" />
                            <select id="codePunto" name="codePunto" v-model="form.codePunto"
                                class="block w-full sm:px-4 sm:py-2 p-0 mt-1 text-base text-gray-900 border border-gray-300 rounded-md bg-gray-50 focus:ring-blue-500 focus:border-blue-500">

                                <option class="text-black" v-for="pun in puntos" :key="pun.id" :value="pun.code">
                                    {{ pun.nombre }}
                                </option>
                            </select>
                            <InputError class="mt-1" :message="form.errors.codePunto" />
                        </div>

                        <!-- ncheck tratamiento datos -->
                        <div class="mb-4 col-span-2">

                            <input type="checkbox" id="consentimiento1" name="consentimiento1" required autofocus>
                            <label for="consentimiento1" class="ps-4 pe-12 sm:text-base text-sm text-gray-500">Acepto el
                                tratamiento de mis datos personales para fines informativos de la Alcaldía de Pereira y
                                la secretaría de las TICs</label>
                            <InputError class="mt-1" :message="form.errors.checked" />
                        </div>



                    </div>

                    <!-- botones -->
                    <div class="pt-4 flex justify-between gap-2">
                        <div class="flex pt-4 justify-end">
                            <Button type="button" @click="prevStep(0)"
                                class="bg-red-700 text-xs sm:text-sm text-white p-2 rounded-md shadow-xl">
                                Atras
                            </Button>
                        </div>
                        <div class="flex pt-4 justify-end">
                            <PrimaryButton class="justify-center !p-2 !mb-0 text-xs sm:text-sm"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Enviar
                            </PrimaryButton>
                        </div>
                    </div>

                </div>
            </div>

        </form>


        <!-- MODAL ENCUESTA -->
        <Dialog v-model:visible="visible" modal position="center" header="REGISTRO REALIZADO"
            class="max-w-xl mx-2 sm:mx-4 flex">

            <div class="m-auto">
                <p class="text-lg">
                    Registro realizado con exito
                </p>

                <div class="flex w-full justify-center">
                    <vue-qrcode
                        :value="route('registrados.index', { identificacion: form.identificacion, origin: 'validation' })" />
                </div>


                <!-- next button -->
                <div class="flex justify-center items-center justify-end mt-6">
                    <primaryButton type="button" @click="visible == false" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        Finalizar
                    </primaryButton>
                </div>

            </div>



        </Dialog>

    </GuestLayout>
</template>

<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm, router } from '@inertiajs/vue3';
import logoViveD from '../../../../public/assets/img/puntoViveDigital.png'
import Steps from 'primevue/steps';
import { ref, watch, inject } from 'vue'
import Dialog from 'primevue/dialog';
import VueQrcode from 'vue-qrcode';
import { useToast } from 'vue-toast-notification';


const $toast = useToast();

const props = defineProps({
    puntos: {
        type: Object,
        default: () => ({}),
    },

    fecha_inicio: {
        type: String,
        default: () => '',
    },
});

const form = useForm({
    nombres: 'jp',
    apellidos: 'suarez',
    edad: 15,
    tipo_documento: 'Cédula Ciudadanía',
    identificacion: 1004734004,
    direccion: 'via armenia',
    sector: 'huertas',
    telefono: 3008634104,
    email: 'jpsuarez40@gmail.com',
    genero: 'Masculino',
    condicion: 'NA',
    etnia: 'NA',
    nivel_estudio: 'universitario',
    codePunto: '',
    checked: '',


});



//ITEMS DEL STEP
const items = ref([
    {
        label: 'Paso 1'
    },
    {
        label: 'Paso 2'
    },
]);

//ITEMS DEL TIPO DE IDENTIFICACION
const tipoIden = ref([
    { id: '0', nombre: "Tarjeta de Identidad", code: 'TI' },
    { id: '1', nombre: "Registro Civil", code: 'R' },
    { id: '2', nombre: "Cédula Ciudadanía", code: 'CC' },
    { id: '3', nombre: "Cédula Extranjería", code: 'CE' },
    { id: '4', nombre: "Pasaporte", code: 'P' },
    { id: '5', nombre: "Otro", code: 'O' },
]);
//ITEMS DE CONDICIONES
const condiciones = ref([
    { id: '0', nombre: 'Sin condición', code: 'NA' },
    { id: '1', nombre: 'Discapacitado', code: 'discapacitado' },
    { id: '2', nombre: 'Desplazados', code: 'desplazados' },
    { id: '3', nombre: 'Victimas conflicto armado interno', code: 'victimasConfArm' },
    { id: '4', nombre: 'Mujer cabeza de hogar', code: 'mujerCabHogar' },
    { id: '5', nombre: 'Diversidad sexual', code: 'diversidadSex' },
    { id: '6', nombre: 'Habitante de calle', code: 'habitanteCalle' },
    { id: '7', nombre: 'Migrante', code: 'migrante' },
]);

//ITEMS DE ETNIAS
const etnias = ref([
    { id: '0', nombre: 'No aplica', code: 'NA' },
    { id: '1', nombre: 'Mestizo', code: 'mestizo' },
    { id: '2', nombre: 'Afrocolombiano', code: 'afro' },
    { id: '3', nombre: 'Indígena', code: 'indigena' },
    { id: '4', nombre: 'Palanquero', code: 'palanquero' },
    { id: '5', nombre: 'Razal', code: 'razal' },
    { id: '6', nombre: 'ROM', code: 'rom' },
]);

//ITEMS DE nivel_estudios
const nivel_estudios = ref([
    { id: '0', nombre: 'Ninguno', code: 'NA' },
    { id: '1', nombre: 'Primaria', code: 'primaria' },
    { id: '2', nombre: 'Secundaria', code: 'secundaria' },
    { id: '3', nombre: 'Tecnico', code: 'tecnico' },
    { id: '4', nombre: 'Tecnologico', code: 'tecnologico' },
    { id: '5', nombre: 'Universitario', code: 'universitario' },
    { id: '6', nombre: 'Postgrado', code: 'postgrado' },
]);

//step activo
const active = ref(0);
//validado
const isValidate = ref(false);
//abrir modal
const visible = ref(false);
//SABER SI SE ACTIVA EL INPUT DE OTROS
const IsNewGenero = ref(false);

watch(IsNewGenero, (value) => {
    if (value) {
        form.genero = '';
    }
});

//STEP PART
//prev
const prevStep = num => {
    active.value = num;
}
//next
const nextStep = num => {


    isValidate.value = false;
    switch (num) {
        case 1:
            if (form.nombres && form.apellidos && form.identificacion && form.edad && form.tipo_documento && form.telefono && form.direccion && form.sector && form.email) {
                isValidate.value = true;
            }
            break;

        default:
            break;
    }

    if (isValidate.value) {
        active.value = num;
    } else {
        if (!form.nombres) {
            form.errors.nombres = 'Este campo es requerido.';
        }
        if (!form.identificacion) {
            form.errors.identificacion = 'Este campo es requerido.';
        }
        if (!form.apellidos) {
            form.errors.apellidos = 'Este campo es requerido.';
        }
        if (!form.edad) {
            form.errors.edad = 'Este campo es requerido.';
        }
        if (!form.tipo_documento) {
            form.errors.tipo_documento = 'Este campo es requerido.';
        }

        if (!form.direccion) {
            form.errors.direccion = 'Este campo es requerido.';
        }
        if (!form.sector) {
            form.errors.sector = 'Este campo es requerido.';
        }
        if (!form.telefono) {
            form.errors.telefono = 'Este campo es requerido.';
        }
        if (!form.email) {
            form.errors.email = 'Este campo es requerido.';
        }

    }

}


const submit = () => {



    form.post(route('registro'), {
        onSuccess: () => {
            // visible.value = true,


            router.get(
                "/registrados",
                { search: form.identificacion, origin: 'validation', fechaCreacion: props.fecha_inicio },

            );
        },

        onError: () => {
            let instance = $toast.open({
                message: "Algo salio mal en el registro, revise los campos o vuelva a intentarlo profavor",
                type: 'warning',
                position: 'top-right',
                duration: 6000,
                pauseOnHover: true,

            });
        }


    });
};
</script>
