<script setup>
    import { ref } from 'vue';
    import Sidebar from '@/Components/Admin/Sidebar.vue';
    import Header from '@/Components/Admin/Header.vue';

    const sidebarOpen = ref(true);
</script>

<template>

    <div id="app">

        <Sidebar
            :open="sidebarOpen"
            @close="sidebarOpen = false"
        />

        <div id="main">

            <Header @toggle-sidebar="sidebarOpen = !sidebarOpen" />

            <slot />

        </div>
    </div>
</template>
