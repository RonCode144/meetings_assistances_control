<!--DASHBOARD POR DEFECTO-->
<script setup>
//#region Importaciones de Componentes y Composables
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from 'primevue/datatable';
import '../../sass/dataTableCustomized.scss'
import Dropdown from 'primevue/dropdown';
import ConfirmPopup from 'primevue/confirmpopup';
import Column from 'primevue/column';
// import Button from 'primevue/button';
import Button from '../Components/Button.vue';
import Fieldset from 'primevue/fieldset';
import Tag from 'primevue/tag'
import Footer from '@/Components/Footer.vue';
import Dialog from 'primevue/dialog';
import { useSweetalert } from '@/composable/sweetAlert'
const { toast } = useSweetalert();
import { ref } from "vue";
import { router } from '@inertiajs/vue3'
import { useConfirm } from "primevue/useconfirm";
import { FilterMatchMode, FilterOperator } from 'primevue/api';
import { MagnifyingGlassIcon, PencilIcon, TrashIcon, PlusIcon, UserPlusIcon } from '@heroicons/vue/24/outline';

//#endregion

//#region Referencias, v-models
const visible = ref(false) //Manejo del modal (abrir o cerrar)
const idUser = ref()
const roles = ref([])
const rolSelect = ref() //v-model
// const toast = useToast()
const confirm = useConfirm()
//#endregion

//#region Funcionalidades
defineProps({
    users: Array,
    roles: Array,
})

const asignarRol = () => {
    if (!rolSelect.value) {
        toast('Seleccione un rol para asignar', 'error');
        return;
    }
    //Estructura del uso de router(Inertia): router.post('url', @param.value), $request{}, onSuccess: onError;
    router.post(route('usuarios.update', idUser.value), {
        rol: rolSelect.value
    },
        {
            onSuccess: () => {
                toast('Se ha agregado el rol satisfactoriamente.', 'success');
                visible.value = false
            },
            onError: (error) => {
                toast.add('No se ha podido asignar el rol.', 'success');
                visible.value = false
            }
        });
}

const getRoles = (id) => {
    idUser.value = id;
    axios.get(route('getRolesVue'))
        .then((res) => {
            roles.value = res.data.roles
            visible.value = true
        })
}

const deleted = (event, id) => {
    confirm.require({
        target: event.currentTarget,
        message: "¿Desea eliminar este usuario?",
        icon: "pi pi-info-circle",
        acceptClass: "p-button-danger",
        accept: () => {
            router.delete(route('usuarios.destroy', id), {
                onSuccess: () => {
                    toast('El usuario se ha eliminado satisfactoriamente.', 'success');
                    // emit('actualizarDatos')
                },
                onError: (errors) => {
                    toast('A ocurrido un error al eliminar el usuario.', 'error');
                }
            })
        },
    });
};
//#endregion

//#region Propiedades de Filtros
const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS }
})

const initFilters = () => {
    filters.value = {
        global: { value: null, matchMode: FilterMatchMode.CONTAINS },
        name: { operator: FilterOperator.AND, constraints: [{ value: null, matchMode: FilterMatchMode.STARTS_WITH }] },
    }
};

const clearFilter = () => {
    initFilters();
};
//#endregion
</script>

<template>
    <AppLayout title="Usuarios Administradores">
        <div class="flex flex-row justify-center h-96 flex-nowrap ">
            <!-- <Sidebar /> -->
            <div
                class="w-full p-4 px-auto sm:w-full sm:px-4 sm:px-auto md:w-full md:px-4 md:px-auto lg:w-full lg:px-4 lg:px-auto">
                <DataTable class="shadow-lg" :value="users" v-model:filters="filters" tableStyle="min-width: 50rem;"
                    dataKey="id" filterDisplay="menu" :globalFilterFields="['id', 'name', 'username', 'email']"
                    currentPageReportTemplate=" {first} al {last} de {totalRecords}"
                    paginatorTemplate="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
                    :paginator="true" :rows="3" :rowsPerPageOptions="[10, 25, 50, 100]">

                    <template #header>
                        <div class="flex justify-between w-full h-8 mb-2">
                            <div class="flex space-x-4">
                                <div class="w-8">
                                    <Button @click="clearFilter()" severity="primary" class="hover:bg-primary" size="small"
                                        raised outlined>
                                        <i class="pi pi-filter-slash" style="color: 'var(--primary-color)'"></i>
                                    </Button>
                                </div>

                                <div class="flex pl-4 rounded-md shadow-sm">
                                    <input type="search"
                                        class="py-4 pr-10 text-gray-900 border-0 rounded-md ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                        v-model="filters.global.value" placeholder="Filtrar..." />
                                </div>
                            </div>
                        </div>
                    </template>

                    <!--Columnas-->
                    <Column field="id" header="Id" class="id"></Column>
                    <Column field="name" header="Nombre" class="name"></Column>
                    <Column field="username" header="Username" class="username"></Column>
                    <Column field="email" header="Correo" class="email"></Column>
                    <Column header="Rol" class="w-40">
                        <template #body="slotProps">
                            <!-- <Tag icon="pi pi-verified" :value="slotProps.data.role_names" :getSeverity="RoleStatus" /> -->
                            <Tag icon="pi pi-verified" v-if="hasRole = 'Super-Admin'" :value="slotProps.data.role_names"
                                class="p-mr-2 p-mb-2" severity="info" />
                            <Tag icon="pi pi-verified" v-else-if="hasRole = 'Administrador'"
                                :value="slotProps.data.role_names" class="p-mr-2 p-mb-2" severity="success" />
                            <Tag icon="pi pi-verified" v-else :value="slotProps.data.role_names" class="p-mr-2 p-mb-2"
                                severity="warning" />
                        </template>
                    </Column>

                    <Column header="Acciones">
                        <template #body="slotProps">
                            <div class="flex h-auto space-x-1">
                                <Button severity="blue-500" class="hover:bg-primary">
                                    <PencilIcon class="h-4 w-4 " aria-hidden="true" @click=getRoles(slotProps.data.id) />
                                </Button>
                                <ConfirmPopup></ConfirmPopup>

                                <Toast />
                                <Button severity="red-500" @click="deleted($event, slotProps.data.id)"
                                    class="hover:bg-danger">
                                    <TrashIcon class="h-4 w-4 " aria-hidden="true" />
                                </Button>
                            </div>
                        </template>
                    </Column>
                    <template #empty> No se encuentran resultados. </template>
                    <template #footer> En total hay
                        {{ users ? users.length : 0 }} usuarios.
                    </template>
                </DataTable>

                <!--MODAL ASIGNACIÓN DE ROLES-->
                <Dialog v-model:visible="visible" modal header="Asignación de Roles y Permisos" :style="{ width: '50vw' }">
                    <Fieldset legend="Asignar Rol">
                        <Dropdown v-model="rolSelect" editable :options="roles" optionLabel="name"
                            placeholder="Seleccione Rol para asignar " class="w-full md:w-14rem" />
                        <Button severity="green-500 hover:bg-green-500 mt-2 left-3/4" icon="pi pi-user-edit"
                            @click="asignarRol()">Asignar Rol
                            <UserPlusIcon class="h-4 w-4 mx-2" aria-hidden="true" />
                        </Button>
                    </Fieldset>
                </Dialog>
                <Footer />
            </div>
        </div>
    </AppLayout>
</template>
