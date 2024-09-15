<script setup>
//#region Lista de Importaciones de Componentes
//! NOTA: SE ESTÁ UTILIZANDO PRIMEVUE COMO LIBRERÍA DE COMPONENTES
import { useForm } from "@inertiajs/vue3"
import Button from 'primevue/button'
import AppLayout from '@/Layouts/AppLayout.vue'
import InputSwitch from 'primevue/inputswitch'
import InputText from "primevue/inputtext"
import Toast from 'primevue/toast'
import { useToast } from "primevue/usetoast"
import ToastService from 'primevue/toastservice'
import Dropdown from 'primevue/dropdown'
import Calendar from 'primevue/calendar'
import Card from 'primevue/card'
import Textarea from 'primevue/textarea'
import moment from "moment"
import { reactive, ref } from 'vue'
//#endregion

//#region Vue3Signature Scripts
const state = reactive({
    count: 0,
    option: {
        penColor: "rgb(0, 0, 0)",
    },
    disabled: false
})

const signature1 = ref(null)

const save = (t) => {
    return signature1.value.save(t)
}

const clear = () => {
    signature1.value.clear()
}
//#endregion

//! Utilidad necesaria del componente Toast.
// (ver documentación oficial de Primevue para el uso correcto: https://primevue.org/toast/).
const toast = useToast({
    position: 'top-right',
    dismissible: true,
    duration: 3000,
});

//! Comunicación de VUE3 con los controladores de Laravel
const props = defineProps({
    asistente: Object, //Instancia del Controlador ReuAsistentesController
    reureunion: Object //Instancia del Controlador ReuReunionController
});

//! Actualización de datos del formulario (Bindings and properties)
//! de acuerdo a los campos del modelo de la base de datos.
const form = useForm({
    identificacion: props.asistente?.identificacion ?? '',
    name: props.asistente?.name ?? '',
    email: props.asistente?.email ?? '',
    firma: null,
    reureunion_id: props.reureunion.id
});

//#region Lógica del Submit
const submit = () => {
    form.firma = save('image/jpeg')
    // console.log(form.firma)
    form.post(route("asistencia.store"), {
        onSuccess: () => {
            toast.add({
                severity: 'success',
                summary: 'Información',
                detail: 'Asistencia Registrada',
                life: 3000
            })
            form.reset()
        },
        onError: (error) => {
            toast.add({
                severity: 'error',
                summary: 'Error',
                detail: error.message == undefined ? 'Diligencia todos los datos' : error.message,
                life: 3000
            })
            // form.reset()
        }
    })
};
//#endregion

// defineEmits(['update:modelValue']);
</script>

<template>
    <!-- <AppLayout title="Asistencia"> -->
    <Toast />
    <!--CABECERA REGISTRO DE ASISTENCIA-->
    <div class="py-4">
        <div class="max-w-3xl p-2 mx-auto shadow-lg rounded-lg">
            <div class="overflow-hidden bg-white shadow-sm rounded-xl ">
                <div class="p-1 border-b border-gray-200 ">
                    <div class="p-2  mb-2 space-x-2 text-center text-white bg-blue-700 border-b-2 rounded-md">

                        <span class="mx-2 mt-1 text-2xl font-bold capitalize">
                            Registro de Asistencia
                        </span>
                    </div>

                    <!--VISUALIZAR DATOS DE REUNIÓN-->
                    <Card style="background-color: #D3F0EC;">
                        <!-- <template #title> Simple Card </template> -->
                        <template #content>
                            <div class="col-span-1 bg md:col-span-4 p-fluid">
                                <div class="space-y-2 border-0 p-fluid">

                                    <div class="flex justify-center font-sans font-bold text-center align-middle">
                                        Información General de la Reunión
                                    </div>

                                    <span class="flex justify-center mt-12 font-sans text-center align-middle">
                                        <strong>Fecha Inicio: &nbsp;</strong>
                                        {{ moment(reureunion.fechaInicio).format('DD-MM-YYYY, H:mm') }}</span>
                                    <span class="flex justify-center mt-12 font-sans text-center align-middle">
                                        <strong>Tema: &nbsp;</strong>
                                        {{ reureunion.tema }}</span>
                                    <span class="flex justify-center mt-12 font-sans text-center align-middle">
                                        <strong>Instructor: &nbsp;</strong>
                                        {{ reureunion.instructor }}</span>
                                    <!-- <span class="flex justify-center mt-12 font-sans text-center align-middle">
                                        <strong>Estado: &nbsp;</strong>
                                        {{ reureunion.activo }}</span> -->
                                </div>
                            </div>
                        </template>
                    </Card>

                    <!--FORMULARIO-->
                    <form @submit.prevent="submit()" enctype="multipart/form-data">
                        <div class="w-full gap-2 my-8 p-6 rounded-lg space-y-4 shadow-md">

                            <!--CAMPO IDENTIFICACIÓN-->
                            <div class="p-fluid" :class="asistente != null ? 'hidden' : ''">
                                <div class="space-y-2 border-0 p-fluid">
                                    <span>Número de Identificación</span>
                                    <InputText :disabled="asistente != null" v-model="form.identificacion" type="number"
                                        placeholder="Escriba su número de identificación"
                                        :class="form.errors.identificacion != null ? 'p-invalid' : ''">
                                    </InputText>
                                    <small id="identificacion-help" class="p-error">
                                        {{ form.errors.identificacion }}
                                    </small>
                                </div>
                            </div>

                            <!--CAMPO NOMBRE-->
                            <div class="p-fluid ">
                                <div class="space-y-2 border-0 p-fluid">
                                    <div class="flex justify-between">
                                        <span>Nombre Completo</span>
                                    </div>
                                    <InputText :disabled="asistente != null" v-model="form.name"
                                        placeholder="Escriba su nombre completo"
                                        :class="form.errors.name != null ? 'p-invalid' : ''">
                                    </InputText>
                                    <smal id=" name-help" class="p-error">
                                        {{ form.errors.name }}
                                    </smal>
                                </div>
                            </div>

                            <!--CAMPO CORREO-->
                            <div class="p-fluid ">
                                <div class="space-y-2 border-0 p-fluid">
                                    <span>Correo</span>
                                    <InputText :disabled="asistente != null" v-model="form.email"
                                        placeholder="Escriba su correo electrónico"
                                        :class="form.errors.email != null ? 'p-invalid' : ''">
                                    </InputText>
                                    <small id="email-help" class="p-error">
                                        {{ form.errors.email }}
                                    </small>
                                </div>
                            </div>

                            <!--PANEL VUE3SIGNATURE-->
                            <div class="w-full h-96">
                                <!-- {{ signature1.value }} -->
                                <label class="text-2xl font-medium" for="">Firma:</label>
                                <Vue3Signature h="80%" w="99%" id="signature" name="img_data" ref="signature1"
                                    :sigOption="state.option" class="m-1 shadow-md">
                                </Vue3Signature>
                                <!-- <Button @click="save('image/jpeg')" severity="success" raised>Guardar</Button> -->
                                <Button @click="clear" label="Borrar" severity="danger" raised class="mt-2" />
                            </div>
                        </div>

                        <!--BOTÓN GUARDAR-->
                        <div class="w-full mt-6">
                            <Toast />
                            <!-- <button type="submit" value="Submit" name="submit" id="submit" style="visibility:hidden">Enviar</button>  -->
                            <Button type="submit" severity="info"
                                class="w-full text-2xl font-bold text-white justify-center bg-blue-700  focus:outline-none rounded-lg  px-5 py-2.5 hover:bg-blue-950"
                                :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
                                Firmar
                            </Button>
                        </div>

                        <!--FOOTER DEL FORMULARIO-->
                        <div class="flex justify-center mt-12 font-sans text-center text-gray-400 align-middle">
                            Todos los derechos reservados © Copyright COTECMAR<br>
                            Cartagena de Indias Colombia, 2023
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- </AppLayout> -->
</template>
