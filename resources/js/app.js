import './bootstrap';
import '../css/app.css';
import '@mdi/font/css/materialdesignicons.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import { aliases, fa } from 'vuetify/iconsets/fa'
import { mdi } from 'vuetify/iconsets/mdi'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const app = createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const vuetify = createVuetify({
            components,
            directives,
            theme: {
                defaultTheme: 'dark'
            },
            icons: {
                defaultSet: 'mdi',
                aliases,
                sets: {
                    fa,
                    mdi,
                },
            },
        });

        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(vuetify)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

