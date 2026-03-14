@props(['offering' => null])

<div class="space-y-6">
    <div>
        <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Meta Title
        </label>
        <input type="text" 
               id="meta_title" 
               name="meta_title" 
               value="{{ old('meta_title', $offering->meta_title ?? '') }}"
               maxlength="255"
               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Recommended: 50-60 characters</p>
        @error('meta_title')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <div>
        <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
            Meta Description
        </label>
        <textarea id="meta_description" 
                  name="meta_description" 
                  rows="3"
                  maxlength="500"
                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">{{ old('meta_description', $offering->meta_description ?? '') }}</textarea>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Recommended: 150-160 characters</p>
        @error('meta_description')
            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror
    </div>
    
    <div class="bg-yellow-50 dark:bg-yellow-900-20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <x-heroicon-o-information-circle class="h-5 w-5 text-yellow-400" />
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-300">SEO Preview</h3>
                <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-200">
                    <div class="text-lg text-blue-600 dark:text-blue-400 font-medium" id="preview-title">{{ $offering->title ?? 'Offering Title' }}</div>
                    <div class="text-sm text-green-700 dark:text-green-500" id="preview-url">{{ url('/offerings/') }}/{{ $offering->slug ?? 'offering-slug' }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400" id="preview-description">{{ Str::limit($offering->meta_description ?? $offering->overview ?? 'Offering description will appear here...', 160) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('title')?.addEventListener('input', function(e) {
    document.getElementById('preview-title').textContent = e.target.value || 'Offering Title';
});

document.getElementById('slug')?.addEventListener('input', function(e) {
    document.getElementById('preview-url').textContent = '{{ url('/offerings/') }}/' + (e.target.value || 'offering-slug');
});

document.getElementById('meta_description')?.addEventListener('input', function(e) {
    document.getElementById('preview-description').textContent = e.target.value.substring(0, 160) || '{{ $offering->overview ?? 'Offering description will appear here...' }}';
});
</script>
@endpush