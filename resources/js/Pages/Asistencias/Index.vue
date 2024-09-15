<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ConfirmPopup from "primevue/confirmpopup";
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import Button from 'primevue/button';
// import InputText from 'primevue/inputtext';
// import TriStateCheckbox from 'primevue/tristatecheckbox';
import { useToast } from "primevue/usetoast";
// import Toast from 'primevue/toast';
// import { FilterMatchMode, FilterOperator } from 'primevue/api';
// import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3'
import { useConfirm } from "primevue/useconfirm";
import Tag from 'primevue/tag';
import QrcodeVue from 'qrcode.vue'

defineProps({
    asistentes: Array,
})

// const columnas = [{ field: 'id', header: 'ID' },
// { field: 'tema', header: 'Tema', typeFilter: 'text' },
// { field: 'instructor', header: 'Instructor', typeFilter: 'text' },
// { field: 'lugar', header: 'Lugar', typeFilter: 'text' },
// { field: 'empresa', header: 'Empresa', typeFilter: 'text' },
// { field: 'gerencia', header: 'Gerencia', typeFilter: 'text' },
// { field: 'responsable', header: 'Responsable', typeFilter: 'text' },
// { field: 'fechaInicio', header: 'Fecha Inicio - Hora', typeFilter: 'text' },
// { field: 'fechaFinal', header: 'Fecha Final - Hora', typeFilter: 'text' },
// { field: 'qr', header: 'QR', typeFilter: 'imagen' },
// { field: 'activo', header: 'Activo', dataType: "boolean" },
// ]

// const filterColumnasGen = ['gerencia',
//     'tema',
//     'instructor',
//     'empresa',
//     'lugar',
//     'fechaInicio',
//     'activo'
// ]

// const filtersInd = {
//     'global': { value: null, matchMode: FilterMatchMode.CONTAINS },
//     'gerencia': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
//     'tema': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
//     'instructor': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
//     'empresa': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
//     'lugar': { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] }
// }

const toast = useToast();
const confirm = useConfirm();

const registrar = () => {
    router.get(route('asistentes.create'), {
        onError: (errors) => {
            toast.add({ severity: 'error', summary: 'Error', detail: errors.create, life: 3000 });
        }
    }
    );
}

const editar = (id) => {
    router.get(route('asistentes.edit', id))
};

// const { exporting } = exportExcel(props.model, props.modelName)

const deleted = (event, id) => {
    confirm.require({
        target: event.currentTarget,
        message: "¿Desea eliminar la fila del TEMA ? ",
        icon: "pi pi-info-circle",
        acceptClass: "p-button-danger",
        accept: () => {
            router.delete(route('asistentes.destroy', id), {
                onSuccess: () => {
                    toast.add({ severity: 'success', summary: 'Success Message', detail: 'La Reunión se ha Eliminado(a) ', life: 3000 });
                    // emit('actualizarDatos')
                },
                onError: (errors) => {
                    toast.add({ severity: 'error', summary: 'Al Eliminar la Reunión', detail: errors.delete, life: 3000 });
                }
            })
        },
    });
};

const getSeverity = (asistente) => {
    return asistente.activo ? 'success' : 'danger';
};

</script>

<template>
    <AppLayout title="Asistentes">
        <div class="surface-section px-4 py-5 md:px-6 lg:px-8">
            <ul class="list-none p-0 m-0 flex align-items-center font-medium mb-3">
                <li>
                    <a class="text-500 no-underline line-height-3 cursor-pointer">Inicio</a>
                </li>
                <li class="px-2">
                    <i class="pi pi-angle-right text-500 line-height-3"></i>
                </li>
                <li>
                    <span class="text-900 line-height-3">Asistencias</span>
                </li>
            </ul>
            <div>
                <DataTable :value="asistentes" tableStyle="min-width: 50rem">
                    <template #header>
                        <div class="flex flex-wrap align-items-center justify-content-between gap-2">
                            <span class="text-xl text-900 font-bold">Asistencia</span>
                            <Button icon="pi pi-plus" class="p-button-rounded p-button-primary" title="Agregar"
                                iconPos="right" @click="registrar()" />
                        </div>

                    </template>
                    <Column field="tema" header="Tema"></Column>
                    <Column field="instructor" header="Instructor"></Column>
                    <Column field="empresa" header="Empresa"></Column>
                    <Column field="lugar" header="Lugar"></Column>
                    <Column header="Estado">
                        <template #body="slotProps">
                            <Tag :value="slotProps.data.activo ? 'Activo' : 'Inactivo'"
                                :severity="getSeverity(slotProps.data)" />
                        </template>
                    </Column>
                    <Column header="QR">
                        <template #body="slotProps">
                            <qrcode-vue :value="route('asistencia', [slotProps.data.id_crypt, 0])" :size="100" level="H" />
                        </template>
                    </Column>
                    <Column header="Actions">
                        <template #body="slotProps">
                            <div class="space-x-2">
                                <Button icon="pi pi-pencil" class="p-button-rounded p-button-success"
                                    @click="editar(slotProps.data.id)" />
                                <ConfirmPopup></ConfirmPopup>
                                <Button icon="pi pi-trash" class="p-button-rounded p-button-danger "
                                    @click="deleted($event, slotProps.data.id)" />
                            </div>
                        </template>

                    </Column>
                    <template #footer> En Total hay {{ asistentes ? asistentes.length : 0 }} asistentes. </template>
                </DataTable>
            </div>
        </div>
    </AppLayout>
</template>
