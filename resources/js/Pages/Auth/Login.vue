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
    username: '',
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
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">

                <div class="card">
                    <div class="card-body">
                        <div id="auth-left">
                            <h1 class="auth-title text-center mb-2">
                                Connexion
                            </h1>

                            <p class="auth-subtitle text-center mb-5">
                                Connectez-vous à votre espace d'administration.
                            </p>

                            <form @submit.prevent="submit">
                                
                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="text" class="form-control form-control-xl"
                                        :class="{ 'is-invalid': form.errors.username }" placeholder="Nom d'utilisateur"
                                        v-model="form.username" autocomplete="username" required autofocus>

                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>

                                    <div v-if="form.errors.username" class="invalid-feedback">
                                        {{ form.errors.username }}
                                    </div>
                                </div>

                                <div class="form-group position-relative has-icon-left mb-4">
                                    <input type="password" class="form-control form-control-xl"
                                        :class="{ 'is-invalid': form.errors.password }" placeholder="Mot de passe"
                                        v-model="form.password" autocomplete="current-password" required>

                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>

                                    <div v-if="form.errors.password" class="invalid-feedback">
                                        {{ form.errors.password }}
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-4"
                                    :disabled="form.processing">
                                    {{ form.processing ? 'Connexion...' : 'Valider' }}
                                </button>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
