@extends('admin.layouts.app')

@section('title', 'Create Service')
@section('page-title', 'Create New Service')

@section('breadcrumb')
<nav class="flex" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2 text-sm">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">Dashboard</a>
        </li>
        <li>
            <span class="text-gray-400 dark:text-gray-500 mx-2">/</span>
        </li>
        <li>
            <a href="{{ route('admin.services.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300">Services</a>
        </li>
        <li>
            <span class="text-gray-400 dark:text-gray-500 mx-2">/</span>
        </li>
        <li>
            <span class="text-gray-700 dark:text-gray-300">Create</span>
        </li>
    </ol>
</nav>
@endsection

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
    <form method="POST" 
          action="{{ route('admin.services.store') }}" 
          enctype="multipart/form-data"
          x-data="serviceForm()"
          @submit.prevent="submitForm">
        @csrf
        
        <div class="p-6">
            @include('admin.services._form-tabs', ['service' => null, 'projects' => $projects])
        </div>
        
        <!-- Form Actions -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 rounded-b-lg flex items-center justify-between">
            <div>
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_published" 
                           value="1"
                           class="rounded border-gray-300 dark:border-gray-600 text-primary-600 shadow-sm focus:ring-primary-500">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Publish immediately</span>
                </label>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.services.index') }}" 
                   class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors flex items-center"
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