<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      x-data="{ 
        sidebarOpen: localStorage.getItem('sidebarOpen') === 'true',
        darkMode: localStorage.getItem('darkMode') === 'true'
      }"
      x-init="$watch('darkMode', val => { 
        localStorage.setItem('darkMode', val); 
        if (val) {
          document.documentElement.classList.add('dark');
        } else {
          document.documentElement.classList.remove('dark');
        }
      }); 
      $watch('sidebarOpen', val => localStorage.setItem('sidebarOpen', val))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }} Admin</title>
    
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    @vite(['resources/css/app.css'])
    
    @stack('styles')
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900" x-cloak>
    
    <div class="min-h-screen">
        @include('admin.partials.sidebar')
        
        <div class="fixed inset-0 bg-black-50 lg:hidden z-30 transition-opacity"
             x-show="sidebarOpen"
             @click="sidebarOpen = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             style="display: none;"></div>
        
        <div class="transition-all duration-300"
             :class="{ 'lg:pl-64': sidebarOpen, 'lg:pl-24': !sidebarOpen }">
            
            @include('admin.partials.topbar')
            
            <main class="p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 dark:bg-green-900-20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg flex items-center justify-between animate-fade-in">
                        <div class="flex items-center gap-2">
                            <x-heroicon-o-check-circle class="w-5 h-5" />
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" class="hover:opacity-75" onclick="this.parentElement.remove()">
                            <x-heroicon-o-x-mark class="w-4 h-4" />
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 dark:bg-red-900-20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg flex items-center justify-between animate-fade-in">
                        <div class="flex items-center gap-2">
                            <x-heroicon-o-exclamation-triangle class="w-5 h-5" />
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" class="hover:opacity-75" onclick="this.parentElement.remove()">
                            <x-heroicon-o-x-mark class="w-4 h-4" />
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 bg-red-100 dark:bg-red-900-20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg animate-fade-in">
                        <div class="flex items-center gap-2 mb-2">
                            <x-heroicon-o-exclamation-circle class="w-5 h-5" />
                            <span class="font-semibold">Please fix the following errors:</span>
                        </div>
                        <ul class="list-disc list-inside text-sm space-y-1 ml-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        @yield('page-title')
                    </h1>
                    @hasSection('breadcrumb')
                        <div class="mt-1">
                            @yield('breadcrumb')
                        </div>
                    @endif
                </div>

                @yield('content')
            </main>
            
            @include('admin.partials.footer')
        </div>
    </div>

    <!-- Global Modals -->
    <x-confirmation-modal id="delete-confirmation" />
    <x-confirmation-modal 
        id="status-confirmation" 
        title="Change Status" 
        confirmText="Yes, Change" 
        icon="heroicon-o-arrow-path"
        confirmButtonClass="bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-500" />
    <x-toast />

    @vite(['resources/js/app.js'])
    
    @stack('scripts')
</body>
</html>