@extends('admin.layouts.app')

@section('title', 'Create Offering')
@section('page-title', 'Create New Offering')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Offering Information</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Fill in the details below to create a new offering</p>
        </div>

        <form method="POST" 
              action="{{ route('dashboard.offerings.store') }}" 
              enctype="multipart/form-data">
            @csrf
            
            @if($errors->any())
                <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg dark:bg-red-900 dark:text-red-300">
                    <p class="font-medium">Please fix the following errors:</p>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <div class="p-6">
                @include('admin.offerings._form-tabs', ['offering' => null, 'activeTab' => 'basic'])
            </div>
            
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" 
                               name="is_highlighted" 
                               value="1"
                               class="w-4 h-4 rounded border-gray-300 dark:border-gray-600 text-primary-600 shadow-sm focus:ring-primary-500">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Mark as Highlighted</span>
                    </label>
                </div>
                
                <div class="flex items-center gap-3">
                    <a href="{{ route('dashboard.offerings.index') }}" 
                       class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 flex items-center gap-2">
                        <x-heroicon-o-plus class="w-5 h-5" />
                        Create Offering
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection