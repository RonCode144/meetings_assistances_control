<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Formulario Registro Reunión</title>
</head>
<body>
    <div>
        <div class="p-6 bg-white border-b border-gray-200 lg:p-8">
            {{-- <ApplicationLogo class="flex w-auto h-24"/> --}}

            <div class="max-w-2xl px-8 py-6 mx-auto my-8 bg-white border rounded-lg">
                <!--TÍTULO GERENCIA-->
            <h2 class="mb-4 text-2xl font-medium">Registro de Reunión</h2>
            <!--EMPIEZA EL FORMULARIO-->
            <form method="POST">
                <!--CAMPO GERENCIA-->
                <div class="mb-4">
                    <label for="management-m" class="block mb-2 font-medium text-gray-700">Gerencia</label>
                    <datalist id="management" name="management" 
                        class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-400" required>
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
                        class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-400" required>
                </div>
                <!--CAMPO FECHA-->
                <div class="mb-4">
                    <label for="date" class="block mb-2 font-medium text-gray-700">Fecha</label>
                    <input type="date" id="date" name="date" value="2023-07-09"
                        class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-400" required>
                </div>
                <!--CAMPO REGISTRO NO.-->
                <div class="mb-4">
                    <label for="register" class="block mb-2 font-medium text-gray-700">Registro No.</label>
                    <input type="text" id="register-number" name="register-number" placeholder="Registro No."
                        class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-400" required>
                </div>
                <!--CAMPO TEMA-->
                <div class="mb-4">
                    <label for="subject" class="block mb-2 font-medium text-gray-700">Tema</label>
                    <input type="text" id="register-number" name="register-number" placeholder="Tema general de la reunión"
                        class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-400" required>
                </div>
                <!--CAMPO INSTRUCTOR-->
                <div class="mb-4">
                    <label for="instructor" class="block mb-2 font-medium text-gray-700">Instructor</label>
                    <input type="text" id="register-number" name="register-number" placeholder="Nombre del Instructor"
                        class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-400" required>
                </div>
                <!--CAMPO EMPRESA-->
                <div class="mb-4">
                    <label for="company" class="block mb-2 font-medium text-gray-700">Empresa</label>
                    <input type="text" id="register-number" name="register-number" placeholder="Nombre de la empresa o proveedor"
                        class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-400" required>
                </div>
                <!--CAMPO LUGAR-->
                <div class="mb-4">
                    <label for="place" class="block mb-2 font-medium text-gray-700">Lugar</label>
                    <input type="text" id="register-number" name="register-number" placeholder="Lugar de la reunión"
                        class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-400" required>
                </div>
                <!--CAMPO RESPONSABLE-->
                <div class="mb-4">
                    <label for="author" class="block mb-2 font-medium text-gray-700">Responsable</label>
                    <input type="text" id="register-number" name="register-number" placeholder="Nombre del responsable de la reunión"
                        class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-400" required>
                </div>
                <!--CAMPO HORA INICIO-->
                <div class="mb-4">
                    <label for="time-ini" class="block mb-2 font-medium text-gray-700">Hora De Inicio</label>
                    <input type="time" id="time-init" name="time-init" value="07:00" max="22:30" min="07:00" step="1"
                        class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-400" required>
                </div>
                <!--CAMPO HORA FINALIZACIÓN-->
                <div class="mb-4">
                    <label for="time-finish" class="block mb-2 font-medium text-gray-700">Hora De Finalización</label>
                    <input type="time" id="time-init" name="time-init" value="07:00" max="22:30" min="07:00" step="1"
                        class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-400" required>
                </div>
                <!--BOTÓN ENVIAR-->
                <div>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                        Guardar
                    </button>
                </div>
            <!--
                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">What is your favorite color?</label>
                    <div class="flex flex-wrap -mx-2">
                        <div class="w-1/3 px-2">
                            <label for="color-red" class="block mb-2 font-medium text-gray-700">
                                <input type="radio" id="color-red" name="color" value="red" class="mr-2">Red
                            </label>
                        </div>
                        <div class="w-1/3 px-2">
                            <label for="color-blue" class="block mb-2 font-medium text-gray-700">
                                <input type="radio" id="color-blue" name="color" value="blue" class="mr-2">Blue
                            </label>
                        </div>
                        <div class="w-1/3 px-2">
                            <label for="color-green" class="block mb-2 font-medium text-gray-700">
                                <input type="radio" id="color-green" name="color" value="green" class="mr-2">Green
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block mb-2 font-medium text-gray-700">What is your favorite animal?</label>
                    <div class="flex flex-wrap -mx-2">
                        <div class="w-1/3 px-2">
                            <label for="animal-cat" class="block mb-2 font-medium text-gray-700">
                                <input type="checkbox" id="animal-cat" name="animal[]" value="cat" class="mr-2">Cat
                            </label>
                        </div>
                        <div class="w-1/3 px-2">
                            <label for="animal-dog" class="block mb-2 font-medium text-gray-700">
                                <input type="checkbox" id="animal-dog" name="animal[]" value="dog"
                                    class="mr-2">Dog
                            </label>
                        </div>
                        <div class="w-1/3 px-2">
                            <label for="animal-bird" class="block mb-2 font-medium text-gray-700">
                                <input type="checkbox" id="animal-bird" name="animal[]" value="bird" class="mr-2">Bird
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="message" class="block mb-2 font-medium text-gray-700">Message</label>
                    <textarea id="message" name="message"
                        class="w-full p-2 border border-gray-400 rounded-lg focus:outline-none focus:border-blue-400" rows="5"></textarea>
                </div>
                <div>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Submit</button>
                </div> -->
            
            </form>
    </div>
</div>
</div>
</body>
</html>