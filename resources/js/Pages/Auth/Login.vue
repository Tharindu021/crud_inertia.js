<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div class="container">
                <div class="row">
                    <!-- <div class="colomn d-flex jusitfy-content-center"> -->
                        <div>
                            <h1 class="text-center text-success display-1 font-monospace fw-bolder p-3"  >
                            Log In page
                        </h1>
                        </div>
                        <div class="d-flex justify-content-center">
                        <form @submit.prevent="submit" >
                            <div>
                                <InputLabel for="email" value="Email" class="m-2"/>

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                
                                />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password" value="Password" class="m-2"/>

                                <TextInput
                                    id="password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="form.password"
                                />

                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>

                            <!-- <div class="block mt-4">
                                <label class="flex items-center">
                                    <Checkbox name="remember" v-model:checked="form.remember" />
                                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                                </label>
                            </div> -->

                            <div class="flex items-center justify-end mt-4">
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Forgot your password?
                                </Link>
                                <br>
                                <div class="form-footer d-flex justify-content-center "></div>
                                   
                                    
                                    <Link type="button" href="/register" class="btn btn-success m-3"  >
                                        Register
                                    </Link>
                                    <button class="btn btn-primary m-3"  :class="{ 'opacity-2': form.processing }" :disabled="form.processing">
                                        Log in
                                    </button>
                                </div>
                                
                                <!-- :class="{ 'opacity-2': form.processing }" -->

                        </form>
                    <!-- </div> -->
                </div>
                </div>
        </div>
    </GuestLayout>
</template>
