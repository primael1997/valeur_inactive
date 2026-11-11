<script setup>
    import { Link, usePage } from '@inertiajs/vue3';

    defineProps({
        open: {
            type: Boolean,
            default: true,
        },
    });

    const emit = defineEmits(['close']);

    const page = usePage();

    const isActive = (url) => page.url === url || page.url.startsWith(url + '/');

    const can = (permission) => {
        return page.props.auth?.permissions?.includes(permission) ?? false;
    };

    const canAny = (permissions) => {
        return permissions.some(permission => can(permission));
    };
</script>

<template>
    <div id="sidebar" :class="{ active: open }">
        <div class="sidebar-wrapper" :class="{ active: open }">

            <!-- Logo -->
            <div class="sidebar-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <Link :href="route('admin.dashboard')">
                            <img
                                src="/assets/images/logo/logo1.png"
                                alt="Logo"
                                style="height: 60px"
                            >
                        </Link>
                    </div>

                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"
                           @click.prevent="emit('close')">
                            <i class="bi bi-x bi-middle"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Menu -->
            <div class="sidebar-menu">
                <ul class="menu">

                    <li class="sidebar-title">Général</li>

                    <li class="sidebar-item"
                        :class="{ active: isActive('/admin/dashboard') }">
                        <Link  class="sidebar-link">
                            <i class="bi bi-grid-fill"></i>
                            <span>Tableau de bord</span>
                        </Link>
                    </li>

                    <li class="sidebar-title">Gestion du stock</li>

                    <li class="sidebar-item" v-if="can('products.view')"
                        :class="{ active: isActive('/admin/products') }">
                        <Link class="sidebar-link">
                            <i class="bi bi-box-seam"></i>
                            <span>Produits</span>
                        </Link>
                    </li>

                    <li class="sidebar-item" v-if="can('supplies.view')"
                        :class="{ active: isActive('/admin/supplies') }">
                        <Link class="sidebar-link">
                            <i class="bi bi-truck"></i>
                            <span>Approvisionnements</span>
                        </Link>
                    </li>

                    <li class="sidebar-item" v-if="can('inventory.view')"
                        :class="{ active: isActive('/admin/inventory') }">
                        <Link class="sidebar-link">
                            <i class="bi bi-clipboard-check"></i>
                            <span>Inventaire</span>
                        </Link>
                    </li>

                    <li class="sidebar-title">Opérations</li>

                    <li class="sidebar-item" v-if="can('sales.daily_report')"
                        :class="{ active: isActive('/admin/daily-sales') }">
                        <Link class="sidebar-link">
                            <i class="bi bi-receipt"></i>
                            <span>Ventes journalières</span>
                        </Link>
                    </li>

                    <li class="sidebar-item" v-if="canAny(['corrections.create', 'corrections.process'])"
                        :class="{ active: isActive('/admin/correction-requests') }">
                        <Link class="sidebar-link">
                            <i class="bi bi-arrow-left-right"></i>
                            <span>Demandes de correction</span>
                        </Link>
                    </li>

                    <li class="sidebar-title" v-if="can('users.manage')">Administration</li>

                    <li class="sidebar-item" v-if="can('users.manage')"
                        :class="{ active: isActive('/admin/users') }">
                        <Link class="sidebar-link">
                            <i class="bi bi-people"></i>
                            <span>Utilisateurs</span>
                        </Link>
                    </li>

                    <li class="sidebar-item" v-if="can('users.manage')"
                        :class="{ active: isActive('/admin/audit') }">
                        <Link class="sidebar-link">
                            <i class="bi bi-journal-text"></i>
                            <span>Journal d'audit</span>
                        </Link>
                    </li>

                    <li class="sidebar-title">Compte</li>

                    <li class="sidebar-item"
                        :class="{ active: isActive('/admin/profile') }">
                        <Link class="sidebar-link">
                            <i class="bi bi-person-badge-fill"></i>
                            <span>Mon profil</span>
                        </Link>
                    </li>

                    <li class="sidebar-item">
                        <Link :href="route('logout')" method="post" as="button"
                              class="sidebar-link border-0 bg-transparent w-100 text-start">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Déconnexion</span>
                        </Link>
                    </li>

                </ul>
            </div>

            <button class="sidebar-toggler btn x" @click="emit('close')">
                <i class="bi bi-x"></i>
            </button>

        </div>
    </div>
</template>

<style>

    #sidebar .sidebar-menu .sidebar-link {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
    }

    #sidebar .sidebar-menu .sidebar-link i {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 24px;
        width: 24px;
        font-size: 1.15rem;
        line-height: 1;
    }

    #sidebar .sidebar-menu .sidebar-link span {
        display: inline-block;
        line-height: 1.4;
    }

</style>
