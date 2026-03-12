<div x-data="toast()" 
     x-init="init"
     x-show="show"
     x-cloak
     class="fixed top-4 right-4 z-50 w-full max-w-sm overflow-hidden bg-white dark:bg-gray-800 rounded-lg shadow-lg border-l-4 pointer-events-auto"
     :class="{
         'border-green-500': type === 'success',
         'border-red-500': type === 'error',
         'border-yellow-500': type === 'warning',
         'border-blue-500': type === 'info'
     }"
     x-transition:enter="transform ease-out duration-300 transition"
     x-transition:enter-start="translate-x-full opacity-0"
     x-transition:enter-end="translate-x-0 opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="transform opacity-100"
     x-transition:leave-end="transform -translate-x-full opacity-0">
    
    <div class="flex items-start p-4">
        <div class="flex-shrink-0">
            <template x-if="type === 'success'">
                <x-heroicon-o-check-circle class="h-5 w-5 text-green-500" />
            </template>
            <template x-if="type === 'error'">
                <x-heroicon-o-x-circle class="h-5 w-5 text-red-500" />
            </template>
            <template x-if="type === 'warning'">
                <x-heroicon-o-exclamation-triangle class="h-5 w-5 text-yellow-500" />
            </template>
            <template x-if="type === 'info'">
                <x-heroicon-o-information-circle class="h-5 w-5 text-blue-500" />
            </template>
        </div>
        <div class="ml-3 w-0 flex-1">
            <p class="text-sm font-medium text-gray-900 dark:text-white" x-text="title"></p>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400" x-text="message"></p>
        </div>
        <div class="ml-4 flex-shrink-0 flex">
            <button @click="close" class="inline-flex text-gray-400 hover:text-gray-500 dark:hover:text-gray-300">
                <x-heroicon-o-x-mark class="h-5 w-5" />
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toast() {
    return {
        show: false,
        type: 'success',
        title: '',
        message: '',
        timeout: null,
        
        init() {
            window.addEventListener('toast', (event) => {
                this.type = event.detail.type || 'success';
                this.title = event.detail.title || this.getDefaultTitle(this.type);
                this.message = event.detail.message;
                this.show = true;
                
                if (this.timeout) {
                    clearTimeout(this.timeout);
                }
                
                this.timeout = setTimeout(() => {
                    this.close();
                }, event.detail.duration || 5000);
            });
        },
        
        getDefaultTitle(type) {
            const titles = {
                success: 'Success',
                error: 'Error',
                warning: 'Warning',
                info: 'Information'
            };
            return titles[type] || 'Notification';
        },
        
        close() {
            this.show = false;
            if (this.timeout) {
                clearTimeout(this.timeout);
            }
        }
    }
}
</script>
@endpush