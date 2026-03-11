<header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-20" x-cloak>
    <div class="px-6 py-3 flex items-center justify-between">
        
        <!-- Left Side -->
        <div class="flex items-center gap-4">
            <!-- Sidebar Toggle -->
            <button @click="sidebarOpen = !sidebarOpen" 
                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            
            <!-- Page Title (Mobile) -->
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white lg:hidden">
                @yield('page-title')
            </h2>
        </div>

        <!-- Right Side -->
        <div class="flex items-center gap-3">
            
            <!-- Dark Mode Toggle -->
            <button @click="darkMode = !darkMode" 
                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 transition-colors"
                    title="Toggle dark mode">
                <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                </svg>
                <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </button>

            <!-- Notifications -->
            <div class="relative" x-data="{ notifOpen: false }" @click.away="notifOpen = false">
                <button @click="notifOpen = !notifOpen" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 relative transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                    </svg>
                    @php $unreadCount = \App\Models\Contact::where('status', 'new')->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    @endif
                </button>
                
                <!-- Dropdown -->
                <div x-show="notifOpen"
                     class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 py-2 z-50"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95">>
                    
                    <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Notifications</h3>
                    </div>
                    
                    <div class="max-h-96 overflow-y-auto">
                        @php $recentContacts = \App\Models\Contact::where('status', 'new')->latest()->take(5)->get(); @endphp
                        
                        @forelse($recentContacts as $contact)
                            <a href="{{ route('admin.contacts.show', $contact) }}" 
                               class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $contact->name }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 line-clamp-2">
                                    {{ $contact->subject }}
                                </p>
                                <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                    {{ $contact->created_at->diffForHumans() }}
                                </p>
                            </a>
                        @empty
                            <div class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                                <p>No new notifications</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('admin.contacts.index') }}" class="text-sm text-primary-600 hover:text-primary-700">
                            View all inquiries
                        </a>
                    </div>
                </div>
            </div>

            <!-- User Menu -->
            <div class="relative" x-data="{ userOpen: false }" @click.away="userOpen = false">
                <button @click="userOpen = !userOpen" class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-primary-500 to-purple-500 flex items-center justify-center text-white font-semibold text-sm">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ auth()->user()->role }}
                        </p>
                    </div>
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="userOpen"
                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 py-1 z-50"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95">
                    
                    <a href="{{ route('admin.profile.edit') }}" 
                       class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        Profile
                    </a>
                    
                    <a href="{{ route('admin.settings.index') }}" 
                       class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        Settings
                    </a>
                    
                    <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                    
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" 
                                class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>