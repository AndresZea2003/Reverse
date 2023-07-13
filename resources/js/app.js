import './bootstrap';
import {createApp} from "vue/dist/vue.esm-bundler.js";
import MyComponent from "../vue/components/MyComponent.vue"

createApp({
    components: {
        'my-component': MyComponent,
    }
}).mount("#app");
