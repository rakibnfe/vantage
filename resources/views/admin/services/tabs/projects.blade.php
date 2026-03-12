@props(['service' => null])

<div class="space-y-4">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Related Projects</h3>
    <p class="text-sm text-gray-600 dark:text-gray-400">Select projects that showcase this service</p>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($projects as $project)
        <label class="relative flex items-start p-4 bg-gray-50 dark:bg-gray-700 rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-600 transition border-2 hover:border-primary-500 dark:hover:border-primary-400"
               :class="{ 'border-primary-500 dark:border-primary-400': $el.querySelector('input').checked }">
            <div class="flex items-center h-5">
                <input type="checkbox" 
                       name="project_ids[]" 
                       value="{{ $project->id }}"
                       {{ $service && $service->projects && $service->projects->contains($project->id) ? 'checked' : '' }}
                       class="rounded border-gray-300 dark:border-gray-600 text-primary-600 shadow-sm focus:ring-primary-500">
            </div>
            <div class="ml-3 text-sm flex-1">
                <span class="font-medium text-gray-900 dark:text-white">{{ $project->title }}</span>
                @if($project->category)
                    <span class="block text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $project->category }}</span>
                @endif
            </div>
        </label>
        @empty
        <div class="col-span-full text-center py-12">
            <x-heroicon-o-folder class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600" />
            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No Projects Available</h3>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Create projects first to associate with this service.</p>
            <a href="{{ route('dashboard.projects.create') }}" class="inline-flex items-center mt-4 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg">
                <x-heroicon-o-plus class="w-4 h-4 mr-2" />
                Create Project
            </a>
        </div>
        @endforelse
    </div>
</div>