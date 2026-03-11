@php
    use App\Helpers\AdminMenuHelper;
    $menuItems = AdminMenuHelper::getMenuItems();
@endphp

<aside class="fixed left-0 top-0 h-full bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 transition-all duration-300 z-40 flex flex-col overflow-hidden"
       :class="{ 'w-64': sidebarOpen, 'w-24': !sidebarOpen }"
       x-cloak>
    
    <div class="h-16 flex items-center px-4 border-b border-gray-200 dark:border-gray-800 flex-shrink-0" :class="{ 'justify-center': !sidebarOpen, 'justify-between': sidebarOpen }">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center" :class="{ 'justify-center': !sidebarOpen }">
            <div class="w-8 h-8 bg-gradient-to-r from-primary-600 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                <span class="text-white font-bold text-xl">V</span>
            </div>
            <span x-show="sidebarOpen" x-cloak class="ml-2 text-xl font-bold text-gray-900 dark:text-white">
                Vantage
            </span>
        </a>
    </div>

    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-4 space-y-1 scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-700">
        @foreach($menuItems as $key => $item)
            @if(isset($item['type']) && $item['type'] === 'section')
                <x-admin-menu-section :label="$item['label']" />
            @else
                <x-admin-menu-item :item="$item" />
            @endif
        @endforeach
    </nav>

    <div class="p-4 border-t border-gray-200 dark:border-gray-800 flex-shrink-0">
        <div class="flex items-center" :class="{ 'justify-center': !sidebarOpen, 'space-x-3': sidebarOpen }">
            <div class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-500 to-purple-500 flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                {{ substr(auth()->user()->name, 0, 2) }}
            </div>
            <div x-show="sidebarOpen" x-cloak class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                    {{ auth()->user()->role }}
                </p>
            </div>
            
            <template x-if="!sidebarOpen">
                <a href="{{ route('admin.logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="absolute left-1-2 transform -translate-x-1-2 bottom-16 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-600 dark:text-gray-300 transition-colors"
                   x-data="{ tooltip: false }"
                   @mouseenter="tooltip = true"
                   @mouseleave="tooltip = false">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    
                    <template x-if="tooltip">
                        <div class="fixed left-[88px] px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-sm rounded whitespace-nowrap z-100 pointer-events-none shadow-lg"
                             :style="{
                                top: $el.parentElement.parentElement.getBoundingClientRect().top + 'px',
                                transform: 'translateY(-50%)'
                             }">
                            Logout
                        </div>
                    </template>
                </a>
            </template>
        </div>
        
        <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
            @csrf
        </form>
    </div>
</aside>