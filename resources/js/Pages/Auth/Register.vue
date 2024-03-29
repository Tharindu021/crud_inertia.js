<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <div class="container">
                <div class="row">
                    <!-- <div class="colomn d-flex jusitfy-content-center"> -->
                        <div>
                            <h1 class="text-center text-success display-1 font-monospace fw-bolder p-3"  >
                            Registration Page
                        </h1>
                        </div>
                        <div class="d-flex justify-content-center">

                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Name" class="m-2" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="email" value="Email" class="m-2" />

                                <TextInput
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                                    autocomplete="username"
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
                                    required
                                    autocomplete="new-password"
                                />

                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="password_confirmation" value="Confirm Password" class="m-2"/>

                                <TextInput
                                    id="password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="form.password_confirmation"
                                    required
                                    autocomplete="new-password"
                                />

                                <InputError class="mt-2" :message="form.errors.password_confirmation"  />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <Link
                                class="btn btn-success m-3"
                                    :href="route('login')"
                        
                                >
                                    Already registered?
                                </Link>
                                

                                <PrimaryButton class="btn btn-primary m-3" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Register
                                </PrimaryButton>
                            </div>
                        </form>
                        </div>
                </div>
        </div>
    </GuestLayout>
</template>
