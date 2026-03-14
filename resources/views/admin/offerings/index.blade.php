@extends('admin.layouts.app')

@section('title', 'Offerings')
@section('page-title', 'Offerings')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Offering Management</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Manage your offering offerings and their details</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard.offerings.create') }}" 
               class="inline-flex items-center px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                New Offering
            </a>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-6">
        <form method="GET" action="{{ route('dashboard.offerings.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search by title, tagline, or overview..." 
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                    <select name="status" 
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                        <option value="">All Status</option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <!-- Highlighted Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Highlighted</label>
                    <select name="is_highlighted" 
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all">
                        <option value="">All</option>
                        <option value="1" {{ request('is_highlighted') === '1' ? 'selected' : '' }}>Highlighted</option>
                        <option value="0" {{ request('is_highlighted') === '0' ? 'selected' : '' }}>Not Highlighted</option>
                    </select>
                </div>
            </div>

            <!-- Filter Actions -->
            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('dashboard.offerings.index') }}" 
                   class="px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition-colors">
                    Clear Filters
                </a>
                <button type="submit" 
                        class="px-6 py-2.5 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                    Apply Filters
                </button>
            </div>
        </form>
    </div>

    <!-- Offerings Table -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Offering</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Projects</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Features</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Highlighted</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="sortable" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($offerings as $offering)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group" data-id="{{ $offering->id }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center cursor-move">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                </svg>
                                <span class="ml-2 text-sm text-gray-500 dark:text-gray-400">#{{ $offering->order }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($offering->icon)
                                    <div class="w-8 h-8 rounded-lg bg-primary-100 dark:bg-primary-900-30 flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <div>
                                    <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $offering->title }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ Str::limit($offering->tagline, 50) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-blue-100 dark:bg-blue-900-30 text-blue-800 dark:text-blue-300">
                                {{ $offering->projects_count }} Projects
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-1.5">
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs bg-purple-100 dark:bg-purple-900-30 text-purple-800 dark:text-purple-300">
                                    {{ $offering->features_count }} Feat
                                </span>
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs bg-indigo-100 dark:bg-indigo-900-30 text-indigo-800 dark:text-indigo-300">
                                    {{ $offering->process_steps_count }} Steps
                                </span>
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs bg-pink-100 dark:bg-pink-900-30 text-pink-800 dark:text-pink-300">
                                    {{ $offering->faqs_count }} FAQs
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($offering->is_published)
                                <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-green-100 dark:bg-green-900-30 text-green-800 dark:text-green-300">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                    Published
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-yellow-100 dark:bg-yellow-900-30 text-yellow-800 dark:text-yellow-300">
                                    <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full mr-1.5"></span>
                                    Draft
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($offering->is_highlighted)
                                <span class="inline-flex items-center px-2.5 py-1.5 rounded-lg text-xs font-medium bg-amber-100 dark:bg-amber-900-30 text-amber-800 dark:text-amber-300">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    Highlighted
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button type="button" 
                                        onclick="toggleStatus({{ $offering->id }})"
                                        class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-all"
                                        title="{{ $offering->is_published ? 'Unpublish' : 'Publish' }}">
                                    @if($offering->is_published)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    @endif
                                </button>
                                
                                <a href="{{ route('dashboard.offerings.show', $offering) }}" 
                                   class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-all"
                                   title="View">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                
                                <a href="{{ route('dashboard.offerings.edit', $offering) }}" 
                                   class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-all"
                                   title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                
                                <button type="button" 
                                        onclick="cloneOffering({{ $offering->id }})"
                                        class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-all"
                                        title="Clone">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </button>
                                
                                <button type="button" 
                                        onclick="confirmDelete({{ $offering->id }}, '{{ $offering->title }}')"
                                        class="p-2 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 rounded-lg hover:bg-red-50 dark:hover:bg-red-900-20 transition-all"
                                        title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No offerings found</h3>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Get started by creating your first offering.</p>
                            <a href="{{ route('dashboard.offerings.create') }}" class="inline-flex items-center mt-6 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-xl shadow-sm hover:shadow-md transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Create First Offering
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($offerings->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $offerings->withQueryString()->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Initialize Sortable
    const sortable = new Sortable(document.getElementById('sortable'), {
        handle: '.cursor-move',
        animation: 200,
        ghostClass: 'opacity-50',
        dragClass: 'shadow-lg',
        onEnd: function() {
            const items = [];
            document.querySelectorAll('#sortable tr').forEach((row, index) => {
                items.push({
                    id: row.dataset.id,
                    order: index
                });
            });
            
            fetch('{{ route("dashboard.offerings.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ items })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success(data.message);
                } else {
                    toastr.error(data.message);
                }
            })
            .catch(error => {
                toastr.error('Failed to reorder offerings');
            });
        }
    });

    function confirmDelete(id, title) {
        Swal.fire({
            title: 'Delete Offering',
            html: `
                <p class="text-gray-600 dark:text-gray-400 mb-2">Are you sure you want to delete <span class="font-semibold text-gray-900 dark:text-white">"${title}"</span>?</p>
                <p class="text-sm text-red-500">This action cannot be undone. All associated data will be permanently removed.</p>
            `,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel',
            reverseButtons: true,
            background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff',
            customClass: {
                title: 'text-gray-900 dark:text-white',
                htmlContainer: 'text-gray-600 dark:text-gray-400'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('dashboard/offerings') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success(data.message);
                        setTimeout(() => window.location.href = data.redirect, 1500);
                    } else {
                        toastr.error(data.message);
                    }
                })
                .catch(error => {
                    toastr.error('Failed to delete offering');
                });
            }
        });
    }

    function toggleStatus(id) {
        Swal.fire({
            title: 'Change Status',
            text: 'Are you sure you want to change the status of this offering?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, change it',
            cancelButtonText: 'Cancel',
            background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('dashboard/offerings') }}/${id}/toggle-status`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success(data.message);
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        toastr.error(data.message);
                    }
                })
                .catch(error => {
                    toastr.error('Failed to change status');
                });
            }
        });
    }

    function cloneOffering(id) {
        Swal.fire({
            title: 'Clone Offering',
            text: 'Are you sure you want to clone this offering? A copy will be created.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3b82f6',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Yes, clone it',
            cancelButtonText: 'Cancel',
            background: document.documentElement.classList.contains('dark') ? '#1f2937' : '#ffffff'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`{{ url('dashboard/offerings') }}/${id}/clone`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.redirect) {
                        toastr.success(data.message);
                        setTimeout(() => window.location.href = data.redirect, 1500);
                    } else {
                        toastr.error(data.message);
                    }
                })
                .catch(error => {
                    toastr.error('Failed to clone offering');
                });
            }
        });
    }
</script>
@endpush