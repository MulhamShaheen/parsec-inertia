import { createApp, h } from "vue";
import { createInertiaApp, Link, Head } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";

import { Ziggy } from "./ziggy";
import { ZiggyVue } from "ziggy";

import Layout from "./Shared/Layouts/Layout"
import MyModal from "./Shared/Components/MyModal"


InertiaProgress.init();

createInertiaApp({
    resolve: async (name) => {
        console.log(name)
        const page = require(`./Pages/${name}`).default

        if(page.layout === undefined){
            page.layout = Layout
        }
        return page

    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .component("Link", Link)
            .component("Head", Head)
            .component("MyModal", MyModal)
            .mixin({ methods: { route } })
            .mount(el);

    },
});

