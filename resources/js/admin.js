import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import './bootstrap';            // file bootstrap JS custom Laravel (axios, etc)
import 'bootstrap/dist/css/bootstrap.min.css'; // <-- Bootstrap CSS
import 'bootstrap-icons/font/bootstrap-icons.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js'; // <-- Bootstrap JS bundle
import '../css/app.css';          // CSS global
import 'font-awesome/css/font-awesome.min.css'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    defaults: {
        future: {
            useDialogForErrorModal: true,
        },
    },
    title: (title) => title ? `${title} - ${appName}` : appName,
    resolve: (name) => {
        const pages = import.meta.glob(
            [
                './Pages/Admin/**/*.vue',
            ],
            { eager: false } // lazy load = lebih ringan
        );
        return resolvePageComponent(`./Pages/${name}.vue`, pages);
    },
    setup({ el, App, props, plugin }) {
        return createApp({
            render: () => h(App, {
                ...props,
                key: props.initialPage.component, // 🔑 Tambahkan ini
            }),
        })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#008996ff',
    },
});