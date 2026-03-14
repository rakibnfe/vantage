@extends('admin.layouts.app')

@section('title', 'Edit Offering')
@section('page-title', 'Edit Offering: ' . $offering->title)

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
    <form method="POST" 
          action="{{ route('dashboard.offerings.update', $offering) }}" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        @if(session('success'))
            <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-300" role="alert">
                <span class="font-medium">Success!</span> {{ session('success') }}
            </div>
        @endif
        
        <div class="p-6">
            @include('admin.offerings._form-tabs', ['offering' => $offering, 'activeTab' => $activeTab ?? 'basic'])
        </div>
        
        <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 rounded-b-lg flex items-center justify-between">
            <div class="flex items-center gap-4">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_highlighted" 
                           value="1"
                           {{ $offering->is_highlighted ? 'checked' : '' }}
                           class="rounded border-gray-300 dark:border-gray-600 text-primary-600 shadow-sm focus:ring-primary-500">
                    <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Highlighted</span>
                </label>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('dashboard.offerings.index') }}" 
                   class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors flex items-center gap-2">
                    <x-heroicon-o-check class="w-5 h-5" />
                    Update Offering
                </button>
            </div>
        </div>
    </form>
</div>
@endsection