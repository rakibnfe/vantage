import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './Router/index.js';
import App from './App.vue';

// Only mount Vue app for public pages (when #app exists)
const appElement = document.getElementById('app');
if (appElement) {
    const app = createApp(App);
    app.use(createPinia());
    app.use(router);
    app.mount('#app');
} else {
    // For admin pages, initialize Alpine
    import('alpinejs').then(Alpine => {
        window.Alpine = Alpine.default;
        Alpine.default.start();
    });
}