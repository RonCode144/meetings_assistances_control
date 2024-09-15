<script setup>
//#region Imports Components
const { toast } = useSweetalert()
import { ref, onMounted } from 'vue'
import { useForm } from "@inertiajs/vue3"
import { useSweetalert } from '@/composable/sweetAlert'
import AppLayout from '@/Layouts/AppLayout.vue'
import Calendar from 'primevue/calendar'
import Combobox from '@/Components/Combobox.vue'
import CustomInput from '@/Components/CustomInput.vue'
import moment from 'moment'
import Toast from 'primevue/toast'
//#endregion

//#region Utilities
// const toast = useToast()
// const createReunion = () => {
//     toast.add({
//         severity: 'success',
//         summary: 'Registro exitoso',
//         detail: '¡Reunión creada con éxito!',
//         life: 3000
//     })

//     if (props.reunion != null) {
//         return form.put(route("reuniones.update", id), {
//             onSuccess: () => {
//                 toast.add({
//                     severity: 'success',
//                     summary: 'Información de Registro',
//                     detail: '¡Reunión actualizada con éxito!',
//                     life: 3000
//                 })
//             },
//             onError: (error) => {
//                 toast.add({
//                     severity: 'error',
//                     summary: 'Información de Registro',
//                     detail: 'No se ha actualizado el registro de la reunión.',
//                     error,
//                     life: 3000
//                 })
//             }
//         })
//     } else {
//         form.post(route("reuniones.store"), {
//             onSuccess: () => {
//                 console.log('creada')
//                 toast.add({
//                     severity: 'success',
//                     summary: 'Información de Registro',
//                     detail: '¡Reunión creada con éxito!',
//                     life: 3000
//                 })
//             },
//             onError: (error) => {
//                 toast.add({
//                     severity: 'error',
//                     summary: 'Información de Registro',
//                     detail: 'No se ha podido crear la reunión.',
//                     error,
//                     life: 3000
//                 })
//             }
//         })
//     }
// }
//#endregion

//#region defineProps
const props = defineProps({
    reunion: Object,
    gerencias: Array
})
//#endregion

//#region UseForm
/**El operador ?? se utiliza para verificar si props.contracts?.id es null o undefined.
 * Si es así, se asigna el valor '0' como valor predeterminado.
 * Esto es útil cuando deseas proporcionar un valor por defecto solo si el valor original
 * es nulo o indefinido, pero no si es falsy (por ejemplo, 0, false, '', etc.). */
const form = useForm({
    id: props.reunion?.id ?? '0', //Operador Ternario de Fusión Nula ??
    tema: props.reunion?.tema ?? '',
    instructor: props.reunion?.instructor ?? '',
    lugar: props.reunion?.lugar ?? '',
    empresa: props.reunion?.empresa ?? '',
    gerencia: props.reunion?.gerencia ?? [''],
    responsable: props.reunion?.responsable ?? '',
    fechaInicio: props.reunion?.fechaInicio ?? '',
    fechaFinal: props.reunion?.fechaFinal ?? '',
    qr: props.reunion?.qr ?? '',
    activo: props.reunion != null ? (props.reunion.activo ? true : false) : true,
})

const selectedGerencia = ref([''])

onMounted(() => {
    setDataOnEdit()
})

const setDataOnEdit = () => {
    form.fechaInicio != null ? moment(form.fechaInicio).format('DD/MM/YYYY - HH:mm') : ''
    // console.log(form.fechaInicio)
    form.fechaFinal != null ? moment(form.fechaFinal).format('DD/MM/YYYY - HH:mm') : ''
    // console.log(form.fechaFinal)

    //Cargar la gerencia guardada en BD y renderizarla en el Combobox
    // Verificar que haya una reunión y una gerencia antes de intentar cargarla
    if (props.reunion && props.gerencias) {
        // Buscar la gerencia que coincide con la reunión
        selectedGerencia.value = props.gerencias.filter(gerencia => gerencia.name == props.reunion.gerencia)[0]
    }

}
//#endregion

//#region Submit
const submit = () => {
    try {
        form.gerencia = selectedGerencia.value ? selectedGerencia.value : '';
        form.fechaInicio = String(formatUTCOffset(form.fechaInicio))
        form.fechaFinal = String(formatUTCOffset(form.fechaFinal))

        if (props.reunion != null) {
            form.put(route('reuniones.update', {
                ...form,
                fechaInicio: form.fechaInicio,
                fechaFinal: form.fechaFinal
            }), {
                onSuccess: () => {
                    console.log(form.gerencia)
                    toast('¡Reunión actualizada con éxito!', 'success')
                },
                onError: (error) => {
                    toast(error.message)
                }
            })
        } else {
            form.post(route('reuniones.store', {
                ...form,
                fechaInicio: form.fechaInicio,
                fechaFinal: form.fechaFinal
            }), {
                onSuccess: () => {
                    toast('¡Reunión creada con éxito!', 'success')
                },
                onError: (error) => {
                    toast('Por favor diligencie todos los datos del formulario', 'error')
                }
            })
        }
    } catch (error) {
        toast(error.message)
    }
}
//#endregion

// Este código es una función llamada `formatUTCOffset` que toma una `dateString` como entrada.
// Crea un nuevo objeto `Date` usando `dateString`. Luego resta 5 horas de las horas de la fecha usando
// `date.setHours(date.getHours() - 5)`. Finalmente, convierte la fecha de modificación a un formato de
// cadena ISO usando `date.toISOString()` y devuelve la fecha formateada.
const formatUTCOffset = (dateString) => {
    const date = new Date(dateString)
    date.setHours(date.getHours() - 5)
    const formattedDate = date.toISOString()
    return formattedDate
}

// defineEmits(['update:modelValue'])

</script>

<template>
    <AppLayout title="Reuniones">
        <Toast />
        <div class="py-2">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-lg rounded-xl">
                    <div class="p-4 border-b border-gray-200">
                        <div class="p-2 space-x-2 text-left w-96">
                            <span class="mx-2 mt-1 font-bold uppercase text-slate-900">
                                {{ props.reunion == null ? 'crear' : 'editar' }}
                                Reunión
                            </span>
                        </div>

                        <!--FORMULARIO-->
                        <form class="w-full" @submit.prevent="submit(form.id)">
                            <div class="grid grid-cols-1 gap-4 p-2 md:grid-cols-2">
                                <div>
                                    <!-- CAMPO TEMA -->
                                    <CustomInput label="Tema" placeholder="Tema de la reunión" v-model:input="form.tema"
                                        :showEmailDomain="false" :error="form.errors.tema">
                                    </CustomInput>
                                </div>

                                <div>
                                    <!-- CAMPO INSTRUCTOR -->
                                    <CustomInput label="Preside/Instructor" placeholder="Instructor de la reunión"
                                        v-model:input="form.instructor" :showEmailDomain="false"
                                        :error="form.errors.instructor">
                                    </CustomInput>
                                </div>
                                <div>
                                    <!-- CAMPO LUGAR -->
                                    <CustomInput label="Lugar" placeholder="Lugar de la reunión"
                                        v-model:input="form.lugar" :showEmailDomain="false" :error="form.errors.lugar">
                                    </CustomInput>
                                </div>

                                <div>
                                    <!-- CAMPO EMPRESA -->
                                    <CustomInput label="Empresa" placeholder="Nombre de la empresa"
                                        v-model:input="form.empresa" :showEmailDomain="false"
                                        :error="form.errors.empresa">
                                    </CustomInput>
                                </div>

                                <div>
                                    <!-- CAMPO GERENCIA -->
                                    <CustomInput type="dropdown" label="Gerencias" placeholder="Seleccione la gerencia"
                                        option-value="id" option-label="name" :options="gerencias"
                                        v-model:input="selectedGerencia" :error="form.errors.gerencias">
                                    </CustomInput>
                                    <!-- {{ selectedGerencia }} -->
                                    <!-- {{ props.gerencias }} -->
                                    <!-- {{ Object.values(props.gerencias) }} -->
                                </div>

                                <div>
                                    <!-- CAMPO RESPONSABLE -->
                                    <CustomInput label="Responsable" placeholder="Nombre del Responsable"
                                        v-model:input="form.responsable" :showEmailDomain="false"
                                        :error="form.errors.responsable">
                                    </CustomInput>
                                </div>

                                <div>
                                    <!-- CAMPO FECHA INICIO -->
                                    <div>
                                        <label class="font-semibold text-md">Fecha Inicio</label>
                                        <Calendar class="w-full" id="calendar-24h" v-model="form.fechaInicio"
                                            showTime showIcon :manualInput="true" hourFormat="24"
                                            placeholder="Fecha Inicio de Reunión" :class="form.errors.fechaInicio != null ? 'p-invalid' : ''" />

                                        <!-- <input type="datetime-local" v-model="form.fechaFinal"> -->
                                        <!-- <CustomInput type="datetime" label="Fecha Inicio"
                                            v-model:input="form.fechaInicio" placeholder="Fecha Inicio de Reunión"
                                            :class="form.errors.fechaInicio != null ? 'p-invalid' : ''"
                                            @input="$emit('update:fechaInicio', $event.target.value)" /> -->
                                        <!-- <small id="fechaInicio-help" class="p-error">
                                            {{ form.errors.fechaInicio }}
                                        </small> -->
                                    </div>
                                    <!-- <input type="datetime-local" v-model="form.fechaInicio"> -->
                                </div>

                                <div>
                                    <!-- CAMPO FECHA FECHA FINAL -->
                                    <div>
                                        <label class="font-semibold text-md">Fecha Fin</label>
                                        <Calendar class="w-full" id="calendar-24h" v-model="form.fechaFinal"
                                            showTime showIcon :manualInput="true" hourFormat="24"
                                            placeholder="Fecha Fin de Reunión" :class="form.errors.fechaFinal != null ? 'p-invalid' : ''" />
                                        <!-- <CustomInput type="datetime" label="Fecha Fin" v-model:input="form.fechaFinal"
                                            placeholder="Fecha Finalización de Reunión"
                                            :class="form.errors.fechaFinal != null ? 'p-invalid' : ''"
                                            @input="$emit('update:fechaFinal', $event.target.value)" />
                                        <small id="fechaFinal-help" class="p-error">
                                            {{ form.errors.fechaFinal }}
                                        </small> -->
                                    </div>
                                </div>
                            </div>

                            <!-- BOTÓN CREAR REUNIÓN -->
                            <div class="flex justify-end w-full py-4">
                                <Toast />
                                <Button icon="fa-solid fa-save" size="small" severity="success"
                                    :label="props.reunion != null ? 'Actualizar' : 'Guardar'" @click="submit()"
                                    class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm"
                                    :disabled="form.processing" :class="{ 'opacity-25': form.processing }" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
