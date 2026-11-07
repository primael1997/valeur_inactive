import './bootstrap';
import '../css/app.css';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
// Bootstrap 5
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

// Vue et Inertia
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';

import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
    title: (title) => `${title} - Mon Projet`,

    resolve: (name) => resolvePageComponent(
        `./Pages/${name}.vue`,
        import.meta.glob('./Pages/**/*.vue')
    ),

    setup({ el, App, props, plugin }) {
        createApp({
            render: () => h(App, props),
        })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },

    progress: {
        color: '#198754',
    },
});

