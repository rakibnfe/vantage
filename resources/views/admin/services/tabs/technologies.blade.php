@props(['service' => null])

<div x-data="technologiesManager({{ json_encode(old('technologies', $service->technologies ?? [])) }})">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Technologies Used</h3>
        <button type="button" 
                @click="addTechnology"
                class="inline-flex items-center px-3 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
            Add Technology
        </button>
    </div>
    
    <div class="space-y-4">
        <template x-for="(tech, index) in technologies" :key="index">
            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg relative">
                <button type="button" 
                        @click="removeTechnology(index)"
                        class="absolute top-2 right-2 text-gray-400 hover:text-red-500 dark:hover:text-red-400">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </button>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label :for="'technologies_'+index+'_name'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Name
                        </label>
                        <input type="text" 
                               :name="'technologies['+index+'][name]'"
                               x-model="tech.name"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
                               required>
                    </div>
                    
                    <div>
                        <label :for="'technologies_'+index+'_icon'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Icon
                        </label>
                        <input type="text" 
                               :name="'technologies['+index+'][icon]'"
                               x-model="tech.icon"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
                    </div>
                    
                    <input type="hidden" :name="'technologies['+index+'][order]'" x-model="tech.order">
                </div>
            </div>
        </template>
        
        <div x-show="technologies.length === 0" class="text-center py-12">
            <x-heroicon-o-cpu-chip class="w-12 h-12 mx-auto text-gray-400" />
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No technologies added yet. Click "Add Technology" to start.</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
function technologiesManager(initialTechs = []) {
    return {
        technologies: initialTechs.length ? initialTechs.map((t, index) => ({ ...t, order: index })) : [],
        addTechnology() {
            this.technologies.push({
                name: '',
                icon: '',
                order: this.technologies.length
            });
        },
        removeTechnology(index) {
            this.technologies.splice(index, 1);
            this.technologies.forEach((tech, i) => tech.order = i);
        }
    }
}
</script>
@endpush