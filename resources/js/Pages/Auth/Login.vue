<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import Footer from '@/Components/Footer.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const password = ref('');

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    username: '',
    password: '',
    remember: false,
});

const loginText = computed(() => (form.processing ? 'Iniciando Sesión' : 'Iniciar Sesión'));

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <!--
    This example requires updating your template:

    ```
    <html class="h-full bg-white">
    <body class="h-full">
    ```
    -->
    <div class="flex min-h-screen flex-1">
        <div class="flex flex-1 flex-col justify-center px-4 py-6 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div class="flex flex-col justify-center items-center text-center">
                    <AuthenticationCardLogo />
                    <h2 class="mt-8 text-2xl font-bold leading-9 tracking-tight text-gray-900">Iniciar Sesión</h2>
                    <p class="mt-2 text-sm text-centerleading-6 text-gray-500">
                        Bienvenidos al Portal de Reuniones de
                        <span class="text-blue-600"><strong>Cotecmar</strong></span>
                    </p>
                </div>

                <div class="mt-4">
                    <div>
                        <form @submit.prevent="submit()" class="space-y-6">
                            <div class="mt-2">
                                <TextInput id="username" v-model="form.username" type="text" label="Nombre de Usuario"
                                    :showSup="false" :showEmailDomain="true" class="font-semibold block w-full mt-1"
                                    placeholder="Escriba su nombre de usuario" required autofocus autocomplete="username" />
                                <InputError class="mt-2" :message="form.errors.username" />
                            </div>

                            <div class="mt-2">
                                <TextInput id="password" v-model="form.password" type="password" :name="password"
                                    label="Contraseña" :showSup="false" :showEmailDomain="false"
                                    class="font-semibold block w-full mt-1" placeholder="Escriba su conraseña" required
                                    autocomplete="current-password" />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>

                            <div class="block mt-4">
                                <label class="flex items-center">
                                    <Checkbox v-model:checked="form.remember" name="remember"
                                        class="hover:border-blue-500" />
                                    <span class="ml-2 text-sm text-gray-600">Recuérdame</span>
                                </label>
                            </div>

                            <div>
                                <PrimaryButton
                                    class="flex w-full space-x-3 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-900 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                    :disabled="form.processing">
                                    <p :class="{ 'pointer-events-none': form.processing }">
                                        {{ loginText }}
                                    </p>
                                    <transition name="slide-fade" v-if="form.processing">
                                        <svg aria-hidden="true"
                                            class="flex justify-center items-center w-6 h-6 mr-2 text-gray-200 animate-spin dark:text-gray-50 fill-primary"
                                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="currentColor" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentFill" />
                                        </svg>
                                    </transition>
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
                <Footer class="mt-4 text-sm" />
            </div>
        </div>
        <div class="relative hidden w-0 flex-1 lg:block">
            <img class="absolute inset-0 h-full w-full object-cover"
                src="https://images.unsplash.com/photo-1590649917466-06e6e1c3e92d?q=80&w=1374&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                alt="" />
        </div>
    </div>
</template>