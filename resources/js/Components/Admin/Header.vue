<script setup>
    import { usePage } from '@inertiajs/vue3';

    defineEmits(['toggle-sidebar']);

    const page = usePage();
</script>

<template>
    <header class="mb-3">
        <div class="d-flex justify-content-between align-items-center">

            <a href="#" class="burger-btn d-block d-xl-none"
               @click.prevent="$emit('toggle-sidebar')">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <div class="ms-auto d-flex align-items-center gap-3">
                <span class="text-muted">
                    {{ page.props.auth?.user?.name ?? 'Administrateur' }}
                </span>

                <i class="bi bi-person-circle fs-4"></i>
            </div>

        </div>
    </header>
</template>
