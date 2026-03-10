import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './Router/index.js';
import PublicLayout from './Layouts/PublicLayout.vue';

const app = createApp(PublicLayout);

app.use(createPinia());
app.use(router);

app.mount('#app');
