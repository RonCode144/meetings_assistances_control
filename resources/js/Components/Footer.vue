<script setup>
import moment from "moment";
</script>

<template>
    <div class="w-full mt-2 text-center">
        <footer>
            © Cotecmar {{ moment().format('DD-MM-YYYY') }} - Todos los derechos reservados.
            <div class="inline-block w-40 bg-blue-800">
                <i class="text-white ">#Seguimos </i>
                <i><strong class="text-yellow-300 ">Avante</strong></i>
            </div>
        </footer>
    </div>
</template>