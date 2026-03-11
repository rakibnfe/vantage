import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './Router/index.js';
import App from './App.vue';

const app = createApp(App);

app.use(createPinia());
app.use(router);

// Only mount Vue app if the target element exists (for SPA mode)
const appElement = document.getElementById('app');
if (appElement) {
    app.mount('#app');
}
