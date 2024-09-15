<script setup>
import moment from "moment"
import Footer from "@/Components/Footer.vue"

defineProps({
    empleados: Array,
})
</script>

<template>
    <!--
This example requires updating your template:

```
<html class="h-full">
<body class="h-full">
```
-->
    <div class="flex flex-col justify-center items-center bg-gray-100 min-h-screen">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden max-w-lg w-full">
            <img src="https://www.eltiempo.com/uploads/2020/07/17/5f120a1fb3748.jpeg" alt="Cotecmar Background"
                class="w-full h-auto object-cover">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Equipo de Soporte Cotecmar</h2>
                <p class="text-gray-700 leading-tight mb-4">
                    Para mayor información por favor comuníquese con el encargado de la reunión para que
                    que pueda visualizar el contenido de la plataforma, muchas gracias.
                </p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <img src="https://seaonet.com/wp-content/uploads/2019/07/Captura-de-Pantalla-2019-07-15-a-las-6.40.50-a.-m..png"
                            alt="Avatar" class="w-8 h-8 rounded-full mr-2 object-cover">
                        <span class="text-gray-800 font-semibold">Soporte Cotecmar</span>
                    </div>
                    <span class="text-gray-600"> Fecha de ingreso: {{ moment().format('DD-MM-YYYY') }}</span>
                </div>
            </div>
        </div>
        <Footer class="mt-4" />
    </div>
</template>