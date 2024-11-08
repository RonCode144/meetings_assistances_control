<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Registro Asistentes</title>
</head>
<body>
    <section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
        <header>
            <a href="https://www.cotecmar.com/">
                <img class="w-9 h-9" src="/svg/cotecmar-logo.svg" alt="cotecmar-logo">
            </a>
        </header>

        <main class="mt-8">
            <h2 class="text-gray-700 dark:text-gray-200">Hi Olivia,</h2>

            <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                Alicia has invited you to join the team on <span class="font-semibold ">Meraki UI</span>.
            </p>

            <button class="px-6 py-2 mt-4 text-sm font-medium tracking-wider text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                Enlace de Registro
            </button>

            <p class="mt-8 text-gray-600 dark:text-gray-300">
                Muchas gracias, <br>
                Soporte Cotecmar
            </p>
        </main>


        <footer class="mt-8">
            <p class="text-gray-500 dark:text-gray-400">
                This email was sent to <a href="#" class="text-blue-600 hover:underline dark:text-blue-400" target="_blank">contact@merakiui.com</a>.
                If you'd rather not receive this kind of email, you can <a href="#" class="text-blue-600 hover:underline dark:text-blue-400">unsubscribe</a> or <a href="#" class="text-blue-600 hover:underline dark:text-blue-400">manage your email preferences</a>.
            </p>

            <p class="mt-3 text-gray-500 dark:text-gray-400">©  Cotecmar. Todos los derechos reservados.</p>
            {{-- {{ new Date().getFullYear() }} --}}
        </footer>
    </section>
</body>
</html>