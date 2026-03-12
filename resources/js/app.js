import './bootstrap';

import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from './Router/index.js'
import App from './App.vue'

import Alpine from 'alpinejs'
import Sortable from 'sortablejs'
import Swal from 'sweetalert2'
import toastr from 'toastr'

import 'toastr/build/toastr.min.css'

window.Alpine = Alpine
window.Sortable = Sortable
window.Swal = Swal
window.toastr = toastr

toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-right",
    timeOut: "3000"
}

Alpine.start()

const appElement = document.getElementById('app')

if (appElement) {
    const app = createApp(App)

    app.use(createPinia())
    app.use(router)

    app.mount('#app')
}