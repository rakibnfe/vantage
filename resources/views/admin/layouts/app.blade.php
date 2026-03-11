<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      x-data="{ 
        sidebarOpen: true,
        darkMode: localStorage.getItem('darkMode') === 'true'
      }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Dashboard') - {{ config('app.name') }} Admin</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Styles -->
    @vite(['resources/css/app.css'])
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900">
    
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        @include('admin.partials.sidebar')
        
        <!-- Overlay for mobile -->
        <div class="fixed inset-0 bg-black/50 lg:hidden z-10 transition-opacity"
             x-show="sidebarOpen"
             @click="sidebarOpen = false"
             style="display: none;"></div>
        
        <!-- Main Content -->
        <div class="flex-1 transition-all duration-300 w-full"
             :class="{ 'lg:ml-64': sidebarOpen }">
            
            <!-- Top Navigation -->
            @include('admin.partials.topbar')
            
            <!-- Page Content -->
            <main class="p-6">
                <!-- Alerts -->
                @if(session('success'))
                    <div class="mb-4 bg-green-100 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 px-4 py-3 rounded-lg flex items-center justify-between animate-fade-in">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" class="hover:opacity-75" onclick="this.parentElement.remove()">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-100 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg flex items-center justify-between animate-fade-in">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" class="hover:opacity-75" onclick="this.parentElement.remove()">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 bg-red-100 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-700 dark:text-red-300 px-4 py-3 rounded-lg animate-fade-in">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <span class="font-semibold">Please fix the following errors:</span>
                        </div>
                        <ul class="list-disc list-inside text-sm space-y-1 ml-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Page Title -->
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

                <!-- Main Content -->
                @yield('content')
            </main>
            
            <!-- Footer -->
            @include('admin.partials.footer')
        </div>
    </div>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    
    @stack('scripts')
    
    <script>
        // Alpine.js initialization
        document.addEventListener('alpine:init', () => {
            Alpine.data('dropdown', () => ({
                open: false,
                toggle() {
                    this.open = !this.open
                },
                close() {
                    this.open = false
                }
            }))
        })
    </script>
</body>
</html>