@props(['service' => null])

<div class="space-y-6">
    <!-- Title -->
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Service Title <span class="text-red-500">*</span>
        </label>
        <input type="text" 
               id="title" 
               name="title" 
               value="{{ old('title', $service->title ?? '') }}"
               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
               required>
        @error('title')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Slug -->
    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            URL Slug
        </label>
        <input type="text" 
               id="slug" 
               name="slug" 
               value="{{ old('slug', $service->slug ?? '') }}"
               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to auto-generate from title</p>
        @error('slug')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Tagline -->
    <div>
        <label for="tagline" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Tagline <span class="text-red-500">*</span>
        </label>
        <input type="text" 
               id="tagline" 
               name="tagline" 
               value="{{ old('tagline', $service->tagline ?? '') }}"
               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
               required>
        @error('tagline')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Icon -->
    <div>
        <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Icon Name
        </label>
        <input type="text" 
               id="icon" 
               name="icon" 
               value="{{ old('icon', $service->icon ?? '') }}"
               placeholder="e.g., rocket-launch, computer-desktop"
               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Heroicon name without the prefix (e.g., rocket-launch)</p>
    </div>
    
    <!-- Featured Image -->
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Featured Image
        </label>
        <div class="flex items-center space-x-4">
            @if(isset($service) && $service->featured_image)
                <div class="relative w-24 h-24 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                    <img src="{{ Storage::url($service->featured_image) }}" 
                         alt="{{ $service->title }}"
                         class="w-full h-full object-cover">
                </div>
            @endif
            <div class="flex-1">
                <input type="file" 
                       id="featured_image" 
                       name="featured_image" 
                       accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
            </div>
        </div>
        @error('featured_image')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Overview -->
    <div>
        <label for="overview" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Overview <span class="text-red-500">*</span>
        </label>
        <textarea id="overview" 
                  name="overview" 
                  rows="4"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
                  required>{{ old('overview', $service->overview ?? '') }}</textarea>
        @error('overview')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Full Description
        </label>
        <textarea id="description" 
                  name="description" 
                  rows="8"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">{{ old('description', $service->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <!-- Order -->
    <div>
        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Display Order
        </label>
        <input type="number" 
               id="order" 
               name="order" 
               value="{{ old('order', $service->order ?? 0) }}"
               min="0"
               class="w-32 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
    </div>
</div>