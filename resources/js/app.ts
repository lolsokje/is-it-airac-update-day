import '../css/app.css';
import './bootstrap';

import { createInertiaApp, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, DefineComponent, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Default from "@/Layouts/Default.vue";
import Profile from "@/Layouts/Profile.vue";

// @ts-ignore
const appName = import.meta.env.VITE_APP_NAME;

createInertiaApp({
    title: (title) => `${ title } - ${ appName }`,
    // @ts-ignore
    resolve: (name: string) => {
        const page = resolvePageComponent(
            `./Pages/${ name }.vue`,
            // @ts-ignore
            import.meta.glob<DefineComponent>('./Pages/**/*.vue'),
        );

        page.then(module => {
            if (name.startsWith('Profile')) {
                // @ts-ignore
                module.default.layout = Profile;
            } else {
                // @ts-ignore
                module.default.layout = Default;
            }
        });

        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('InertiaLink', Link)
            .mount(el);
    },
});
