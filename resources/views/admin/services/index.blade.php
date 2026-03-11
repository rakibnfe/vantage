@extends('admin.layouts.app')

@section('title', 'Services')
@section('page-title', 'Services')

@section('content')
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
    <div class="p-6">
        <!-- Header with actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Manage Services</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Create and manage your service offerings</p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.services.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Service
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="mb-6">
            <form method="GET" action="{{ route('admin.services.index') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" 
                               name="search" 
                               value="{{ $filters['search'] ?? '' }}"
                               placeholder="Search services..." 
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <select name="is_published" 
                            class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
                        <option value="">All Status</option>
                        <option value="1" {{ ($filters['is_published'] ?? '') === '1' ? 'selected' : '' }}>Published</option>
                        <option value="0" {{ ($filters['is_published'] ?? '') === '0' ? 'selected' : '' }}>Draft</option>
                    </select>
                    
                    <button type="submit" 
                            class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        Filter
                    </button>
                    
                    <a href="{{ route('admin.services.index') }}" 
                       class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Services Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Service</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Projects</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Features</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Featured</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700" id="sortable">
                    @forelse($services as $service)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors" data-id="{{ $service->id }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center cursor-move">
                                <x-heroicon-o-bars-3 class="w-5 h-5 text-gray-400" />
                                <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">{{ $service->order }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($service->icon)
                                    <x-dynamic-component :component="'heroicon-o-' . $service->icon" class="w-5 h-5 text-gray-500 dark:text-gray-400 mr-3" />
                                @endif
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $service->title }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $service->tagline }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-gray-900 dark:text-white">{{ $service->projects_count }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-gray-900 dark:text-white" title="Features">{{ $service->features_count }}</span>
                                <span class="text-gray-400">|</span>
                                <span class="text-sm text-gray-900 dark:text-white" title="Process Steps">{{ $service->process_steps_count }}</span>
                                <span class="text-gray-400">|</span>
                                <span class="text-sm text-gray-900 dark:text-white" title="FAQs">{{ $service->faqs_count }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($service->is_published)
                                <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900-30 text-green-800 dark:text-green-300 rounded-full">Published</span>
                            @else
                                <span class="px-2 py-1 text-xs font-medium bg-yellow-100 dark:bg-yellow-900-30 text-yellow-800 dark:text-yellow-300 rounded-full">Draft</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($service->is_featured)
                                <x-heroicon-o-star class="w-5 h-5 text-yellow-400" />
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" 
                                        onclick="toggleStatus({{ $service->id }})"
                                        class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors"
                                        title="{{ $service->is_published ? 'Unpublish' : 'Publish' }}">
                                    @if($service->is_published)
                                        <x-heroicon-o-eye-slash class="w-5 h-5" />
                                    @else
                                        <x-heroicon-o-eye class="w-5 h-5" />
                                    @endif
                                </button>
                                
                                <a href="{{ route('admin.services.show', $service) }}" 
                                   class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors"
                                   title="View">
                                    <x-heroicon-o-eye class="w-5 h-5" />
                                </a>
                                
                                <a href="{{ route('admin.services.edit', $service) }}" 
                                   class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors"
                                   title="Edit">
                                    <x-heroicon-o-pencil class="w-5 h-5" />
                                </a>
                                
                                <button type="button" 
                                        onclick="cloneService({{ $service->id }})"
                                        class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 transition-colors"
                                        title="Clone">
                                    <x-heroicon-o-document-duplicate class="w-5 h-5" />
                                </button>
                                
                                <button type="button" 
                                        onclick="deleteService({{ $service->id }}, '{{ $service->title }}')"
                                        class="p-2 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition-colors"
                                        title="Delete">
                                    <x-heroicon-o-trash class="w-5 h-5" />
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <x-heroicon-o-cube class="w-12 h-12 mx-auto text-gray-400" />
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No services</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new service.</p>
                            <div class="mt-6">
                                <a href="{{ route('admin.services.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg">
                                    <x-heroicon-o-plus class="w-5 h-5 mr-2" />
                                    Add New Service
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $services->withQueryString()->links() }}
        </div>
    </div>
</div>

<!-- JavaScript for actions -->
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
    // Initialize sortable for drag-drop reordering
    const sortable = new Sortable(document.getElementById('sortable'), {
        handle: '.cursor-move',
        animation: 150,
        onEnd: function(evt) {
            const items = [];
            document.querySelectorAll('#sortable tr').forEach((row, index) => {
                items.push({
                    id: row.dataset.id,
                    order: index
                });
            });
            
            fetch('{{ route("admin.services.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ items })
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    // Update displayed order numbers
                    document.querySelectorAll('#sortable tr .order-number').forEach((el, index) => {
                        el.textContent = index;
                    });
                }
            });
        }
    });

    function toggleStatus(id) {
        if (confirm('Are you sure you want to toggle this service status?')) {
            fetch(`{{ url('admin/services') }}/${id}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    window.location.reload();
                } else {
                    alert(data.message);
                }
            });
        }
    }

    function cloneService(id) {
        if (confirm('Are you sure you want to clone this service?')) {
            fetch(`{{ url('admin/services') }}/${id}/clone`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json()).then(data => {
                if (data.success && data.redirect) {
                    window.location.href = data.redirect;
                } else {
                    alert(data.message);
                }
            });
        }
    }

    function deleteService(id, title) {
        if (confirm(`Are you sure you want to delete "${title}"? This action cannot be undone.`)) {
            fetch(`{{ url('admin/services') }}/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => response.json()).then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    alert(data.message);
                }
            });
        }
    }
</script>
@endpush
@endsection