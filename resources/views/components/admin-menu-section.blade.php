@props(['label'])

<div x-show="sidebarOpen" x-cloak class="pt-4">
    <p class="px-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
        {{ $label }}
    </p>
</div>