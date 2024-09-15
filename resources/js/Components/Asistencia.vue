<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
</script>

<template>
            <div>
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200 justify-items-center">
                    <ApplicationLogo class="flex h-24 w-auto"/>

                    <div class="bg-white border rounded-lg px-8 py-6 mx-auto my-8 max-w-2xl">
                        <!--TÍTULO GERENCIA-->
                    <h2 class="text-2xl font-medium mb-4">Regístre su Asistencia a la Reunión</h2>
                    <!--EMPIEZA EL FORMULARIO-->
                    <form>
                        <!--CAMPO GERENCIA-->
                        <div class="mb-4">
                            <label for="management-m" class="block text-gray-700 font-medium mb-2">Gerencia</label>
                            <datalist id="management" name="management" 
                                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                                <option>Seleccione la Gerencia</option>
                                <option>VPEXE</option>
                                <option>GECON</option>
                                <option>GEDIN</option>
                                <option>GEBOG</option>
                                <option>VPEXE</option>
                                <option>GECON</option>
                                <option>GEDIN</option>
                                <option>Gerencia</option>
                                <option>VPEXE</option>
                                <option>GECON</option>
                        </datalist>
                        <input id="management" type="text" name="management" list="management" placeholder="Seleccione la gerencia o escriba el nombre del proveedor"
                                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                        </div>
                        <!--CAMPO FECHA-->
                        <div class="mb-4">
                            <label for="date" class="block text-gray-700 font-medium mb-2">Fecha</label>
                            <input type="date" id="date" name="date" value="2023-07-09"
                                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                        </div>
                        <!--CAMPO REGISTRO NO.-->
                        <div class="mb-4">
                            <label for="register" class="block text-gray-700 font-medium mb-2">Registro No.</label>
                            <input type="text" id="register-number" name="register-number"
                                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                        </div>
                        <!--CAMPO TEMA-->
                        <div class="mb-4">
                            <label for="subject" class="block text-gray-700 font-medium mb-2">Tema</label>
                            <input type="text" id="register-number" name="register-number"
                                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                        </div>
                        <!--CAMPO INSTRUCTOR-->
                        <div class="mb-4">
                            <label for="instructor" class="block text-gray-700 font-medium mb-2">Instructor</label>
                            <input type="text" id="register-number" name="register-number"
                                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                        </div>
                        <!--CAMPO EMPRESA-->
                        <div class="mb-4">
                            <label for="company" class="block text-gray-700 font-medium mb-2">Empresa</label>
                            <input type="text" id="register-number" name="register-number"
                                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                        </div>
                        <!--CAMPO LUGAR-->
                        <div class="mb-4">
                            <label for="place" class="block text-gray-700 font-medium mb-2">Lugar</label>
                            <input type="text" id="register-number" name="register-number"
                                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                        </div>
                        <!--CAMPO RESPONSABLE-->
                        <div class="mb-4">
                            <label for="author" class="block text-gray-700 font-medium mb-2">Responsable</label>
                            <input type="text" id="register-number" name="register-number"
                                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                        </div>
                        <!--CAMPO HORA INICIO-->
                        <div class="mb-4">
                            <label for="time-ini" class=" block text-gray-700 font-medium mb-2">Hora De Inicio</label>
                            <input type="time" id="time-init" name="time-init" value="07:00" max="22:30" min="07:00" step="60"
                                class=" border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                        </div>
                        <!--CAMPO HORA FINALIZACIÓN-->
                        <div class="mb-4">
                            <label for="time-finish" class="block text-gray-700 font-medium mb-2">Hora De Finalización</label>
                            <input type="time" id="time-init" name="time-init" value="07:00" max="22:30" min="07:00" step="60"
                                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" required>
                        </div>
                        <!--BOTÓN ENVIAR-->
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Enviar</button>
                        </div>
                    <!--
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">What is your favorite color?</label>
                            <div class="flex flex-wrap -mx-2">
                                <div class="px-2 w-1/3">
                                    <label for="color-red" class="block text-gray-700 font-medium mb-2">
                                        <input type="radio" id="color-red" name="color" value="red" class="mr-2">Red
                                    </label>
                                </div>
                                <div class="px-2 w-1/3">
                                    <label for="color-blue" class="block text-gray-700 font-medium mb-2">
                                        <input type="radio" id="color-blue" name="color" value="blue" class="mr-2">Blue
                                    </label>
                                </div>
                                <div class="px-2 w-1/3">
                                    <label for="color-green" class="block text-gray-700 font-medium mb-2">
                                        <input type="radio" id="color-green" name="color" value="green" class="mr-2">Green
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium mb-2">What is your favorite animal?</label>
                            <div class="flex flex-wrap -mx-2">
                                <div class="px-2 w-1/3">
                                    <label for="animal-cat" class="block text-gray-700 font-medium mb-2">
                                        <input type="checkbox" id="animal-cat" name="animal[]" value="cat" class="mr-2">Cat
                                    </label>
                                </div>
                                <div class="px-2 w-1/3">
                                    <label for="animal-dog" class="block text-gray-700 font-medium mb-2">
                                        <input type="checkbox" id="animal-dog" name="animal[]" value="dog"
                                            class="mr-2">Dog
                                    </label>
                                </div>
                                <div class="px-2 w-1/3">
                                    <label for="animal-bird" class="block text-gray-700 font-medium mb-2">
                                        <input type="checkbox" id="animal-bird" name="animal[]" value="bird" class="mr-2">Bird
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                            <textarea id="message" name="message"
                                class="border border-gray-400 p-2 w-full rounded-lg focus:outline-none focus:border-blue-400" rows="5"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Submit</button>
                        </div> -->
                    
                    </form>
            </div>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->

    <!-- <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 1500
        })
    </script> -->
</template>
