<script>
    import { ref } from 'vue';

    const message = ref('Bienvenue dans Laravel + Inertia + Vue !');
</script>

<template>
    <div class="container py-5">

        <div class="card shadow-sm">
            <div class="card-body text-center">

                <h1 class="text-success">
                    {{ message }}
                </h1>

                <p class="text-muted">
                    Ton environnement est maintenant configuré.
                </p>

                <button
                    class="btn btn-success"
                    @click="message = 'Bootstrap fonctionne parfaitement !'"
                >
                    Tester Bootstrap et Vue
                </button>

            </div>
        </div>

    </div>
</template>
