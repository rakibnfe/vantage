@props(['item', 'isActive', 'iconComponent', 'pendingCount', 'pendingColor'])

<a href="{{ route($item['route']) }}" 
   class="flex items-center px-4 py-3 rounded-xl transition-all relative group hover:bg-gray-100 dark:hover:bg-gray-800 overflow-visible"
   :class="{ 'justify-center': !sidebarOpen, 'space-x-3': sidebarOpen }"
   x-data="{ 
        tooltip: false,
        active: {{ $isActive ? 'true' : 'false' }}
   }"
   @mouseenter="if(!sidebarOpen) tooltip = true"
   @mouseleave="tooltip = false">
    
    <div class="relative flex-shrink-0">
        <x-dynamic-component :component="$iconComponent" 
            class="w-6 h-6"
            ::class="active ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400'" />
        
        @if($pendingCount > 0)
            <span class="absolute -top-1 -right-1 w-4 h-4 bg-{{ $pendingColor }}-500 text-white text-xs rounded-full flex items-center justify-center">
                {{ $pendingCount }}
            </span>
        @endif
    </div>
    
    <span x-show="sidebarOpen" 
          x-cloak 
          class="font-medium text-sm truncate text-gray-700 dark:text-white"
          ::class="active ? 'text-primary-600 dark:text-primary-400' : 'text-gray-700 dark:text-white'">
        {{ $item['label'] }}
    </span>
    
    @if($pendingCount > 0)
        <span class="ml-auto bg-{{ $pendingColor }}-100 dark:bg-{{ $pendingColor }}-900 text-{{ $pendingColor }}-600 dark:text-{{ $pendingColor }}-300 text-xs px-2 py-0.5 rounded-full" 
              x-show="sidebarOpen">
            {{ $pendingCount }}
        </span>
    @endif
    
    <template x-if="tooltip">
        <div class="fixed left-[88px] px-2 py-1 bg-gray-900 dark:bg-gray-700 text-white text-sm rounded whitespace-nowrap z-100 pointer-events-none shadow-lg"
             :style="{
                top: $el.parentElement.getBoundingClientRect().top + 'px',
                transform: 'translateY(-50%)'
             }">
            {{ $item['label'] }} @if($pendingCount > 0)({{ $pendingCount }} pending)@endif
        </div>
    </template>
</a>