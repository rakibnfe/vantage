@props(['offering' => null])

<div class="space-y-6">
    <div>
        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Offering Title <span class="text-red-500">*</span>
        </label>
        <input type="text" 
               id="title" 
               name="title" 
               value="{{ old('title', $offering->title ?? '') }}"
               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
               required>
        @error('title')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <div>
        <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            URL Slug
        </label>
        <input type="text" 
               id="slug" 
               name="slug" 
               value="{{ old('slug', $offering->slug ?? '') }}"
               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Leave empty to auto-generate from title</p>
        @error('slug')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <div>
        <label for="tagline" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Tagline <span class="text-red-500">*</span>
        </label>
        <input type="text" 
               id="tagline" 
               name="tagline" 
               value="{{ old('tagline', $offering->tagline ?? '') }}"
               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
               required>
        @error('tagline')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <div>
        <label for="icon" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Icon Name
        </label>
        <input type="text" 
               id="icon" 
               name="icon" 
               value="{{ old('icon', $offering->icon ?? '') }}"
               placeholder="e.g., rocket-launch, computer-desktop"
               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Heroicon name without the prefix</p>
    </div>
    
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Highlighted Image
        </label>
        <div class="flex items-center space-x-4">
            @if(isset($offering) && $offering->getFirstMedia('highlighted_image'))
                <div class="relative w-24 h-24 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 group">
                    <img src="{{ $offering->getFirstMedia('highlighted_image')->getUrl('thumb') }}" 
                         alt="{{ $offering->title }}"
                         class="w-full h-full object-cover">
                    <button type="button" 
                            onclick="document.getElementById('highlighted_image').value = ''; this.closest('.relative').remove()"
                            class="absolute top-1 right-1 w-6 h-6 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <x-heroicon-o-x-mark class="w-4 h-4" />
                    </button>
                </div>
            @endif
            <div class="flex-1">
                <input type="file" 
                       id="highlighted_image" 
                       name="highlighted_image" 
                       accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
            </div>
        </div>
        @error('highlighted_image')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <div>
        <label for="overview" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Overview <span class="text-red-500">*</span>
        </label>
        <textarea id="overview" 
                  name="overview" 
                  rows="4"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
                  required>{{ old('overview', $offering->overview ?? '') }}</textarea>
        @error('overview')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Full Description
        </label>
        <textarea id="description" 
                  name="description" 
                  rows="8"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">{{ old('description', $offering->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <div>
        <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Display Order
        </label>
        <input type="number" 
               id="order" 
               name="order" 
               value="{{ old('order', $offering->order ?? 0) }}"
               min="0"
               class="w-32 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
    </div>
    
    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Status
        </label>
        <div class="flex items-center gap-4">
            <label class="flex items-center">
                <input type="radio" 
                       name="status" 
                       value="published"
                       {{ old('status', isset($offering) && $offering->is_published ? 'published' : 'draft') === 'published' ? 'checked' : '' }}
                       class="rounded-full border-gray-300 dark:border-gray-600 text-primary-600 shadow-sm focus:ring-primary-500">
                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Published</span>
            </label>
            <label class="flex items-center">
                <input type="radio" 
                       name="status" 
                       value="draft"
                       {{ old('status', isset($offering) && !$offering->is_published ? 'draft' : 'draft') === 'draft' ? 'checked' : '' }}
                       class="rounded-full border-gray-300 dark:border-gray-600 text-primary-600 shadow-sm focus:ring-primary-500">
                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Draft</span>
            </label>
        </div>
    </div>
</div>