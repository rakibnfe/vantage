@extends('admin.layouts.app')

@section('title', 'Create Service')
@section('page-title', 'Create New Service')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Service Information</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Fill in the details below to create a new service</p>
        </div>

        <form method="POST" 
              action="{{ route('dashboard.services.store') }}" 
              enctype="multipart/form-data"
              x-data="serviceForm()"
              @submit.prevent="submitForm">
            @csrf
            
            <div class="p-6">
                @include('admin.services._form-tabs', ['service' => null])
            </div>
            
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" 
                               name="is_featured" 
                               value="1"
                               class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-primary-600 shadow-sm focus:ring-primary-500">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Mark as Featured</span>
                    </label>
                </div>
                
                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard.services.index') }}" 
                       class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 flex items-center"
                            :disabled="loading">
                        <svg x-show="loading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="loading ? 'Creating...' : 'Create Service'"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
function serviceForm() {
    return {
        loading: false,
        submitForm($event) {
            this.loading = true;
            $event.target.submit();
        }
    }
}
</script>
@endpush
@endsection