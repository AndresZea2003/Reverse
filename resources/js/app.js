import './bootstrap';
import {createApp} from "vue";
import App from '../vue/App.vue'
import VueButton from '../vue/components/VueButton.vue'

const app = createApp({
    components: {
        'vue-button': VueButton,
    },
});
app.mount('#app');

