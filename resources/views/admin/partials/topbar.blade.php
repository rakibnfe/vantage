<header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-20" x-cloak>
    <div class="px-6 py-3 flex items-center justify-between">
        
        <div class="flex items-center gap-4">
            <button @click="sidebarOpen = !sidebarOpen" 
                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-300 transition-colors"
                    :title="sidebarOpen ? 'Collapse sidebar' : 'Expand sidebar'">
                <template x-if="sidebarOpen">
                    <x-heroicon-o-bars-3-center-left class="w-5 h-5" />
                </template>
                <template x-if="!sidebarOpen">
                    <x-heroicon-o-bars-3 class="w-5 h-5" />
                </template>
            </button>
            
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white lg:hidden">
                @yield('page-title')
            </h2>
        </div>

        <div class="flex items-center gap-3">
            
            <button @click="darkMode = !darkMode" 
                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-300 transition-colors"
                    :title="darkMode ? 'Switch to light mode' : 'Switch to dark mode'">
                <template x-if="!darkMode">
                    <x-heroicon-o-moon class="w-5 h-5" />
                </template>
                <template x-if="darkMode">
                    <x-heroicon-o-sun class="w-5 h-5" />
                </template>
            </button>

            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-300 relative transition-colors">
                    <x-heroicon-o-bell class="w-5 h-5" />
                    @php $unreadCount = \App\Models\Contact::where('status', 'new')->count(); @endphp
                    @if($unreadCount > 0)
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    @endif
                </button>
                
                <div x-show="open"
                     x-cloak
                     class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 py-2 z-50"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95">
                    
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
                                <x-heroicon-o-inbox class="w-12 h-12 mx-auto mb-3 text-gray-400" />
                                <p>No new notifications</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="px-4 py-2 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('admin.contacts.index') }}" class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400">
                            View all inquiries
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-r from-primary-500 to-purple-500 flex items-center justify-center text-white font-semibold text-sm">
                        {{ substr(auth()->user()->name, 0, 2) }}
                    </div>
                    <div class="hidden md:block text-left">
                        <p class="text-sm font-medium text-gray-700 dark:text-white">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">
                            {{ auth()->user()->role }}
                        </p>
                    </div>
                    <x-heroicon-o-chevron-down class="w-4 h-4 text-gray-500 dark:text-gray-400" />
                </button>

                <div x-show="open"
                     x-cloak
                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 py-1 z-50"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95">
                    
                    <a href="{{ route('admin.profile.edit') }}" 
                       class="block px-4 py-2 text-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        Profile
                    </a>
                    
                    <a href="{{ route('admin.settings.index') }}" 
                       class="block px-4 py-2 text-sm text-gray-700 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
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