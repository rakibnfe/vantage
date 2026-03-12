@props(['service' => null])

<div x-data="processManager({{ json_encode(old('process_steps', $service->processSteps ?? [])) }})">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Process Steps</h3>
        <button type="button" 
                @click="addStep"
                class="inline-flex items-center px-3 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
            Add Step
        </button>
    </div>
    
    <div class="space-y-4">
        <template x-for="(step, index) in steps" :key="index">
            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg relative">
                <button type="button" 
                        @click="removeStep(index)"
                        class="absolute top-2 right-2 text-gray-400 hover:text-red-500 dark:hover:text-red-400">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </button>
                
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900-30 text-primary-600 dark:text-primary-400 flex items-center justify-center font-semibold" x-text="index + 1"></div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">Process Step</span>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label :for="'process_'+index+'_title'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Title
                        </label>
                        <input type="text" 
                               :name="'process_steps['+index+'][title]'"
                               x-model="step.title"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
                               required>
                    </div>
                    
                    <div>
                        <label :for="'process_'+index+'_icon'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Icon
                        </label>
                        <input type="text" 
                               :name="'process_steps['+index+'][icon]'"
                               x-model="step.icon"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label :for="'process_'+index+'_description'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea :name="'process_steps['+index+'][description]'"
                                  x-model="step.description"
                                  rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"></textarea>
                    </div>
                    
                    <input type="hidden" :name="'process_steps['+index+'][order]'" x-model="step.order">
                </div>
            </div>
        </template>
        
        <div x-show="steps.length === 0" class="text-center py-12">
            <x-heroicon-o-arrow-path class="w-12 h-12 mx-auto text-gray-400" />
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No process steps added yet. Click "Add Step" to start.</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
function processManager(initialSteps = []) {
    return {
        steps: initialSteps.length ? initialSteps.map((s, index) => ({ ...s, order: index })) : [],
        addStep() {
            this.steps.push({
                title: '',
                description: '',
                icon: '',
                order: this.steps.length
            });
        },
        removeStep(index) {
            this.steps.splice(index, 1);
            this.steps.forEach((step, i) => step.order = i);
        }
    }
}
</script>
@endpush