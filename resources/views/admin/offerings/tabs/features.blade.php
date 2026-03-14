@props(['offering' => null])

@php
    // Get features data - prefer old input if available (after validation error), otherwise use offering relationship
    $featuresData = old('features');
    if (empty($featuresData) && $offering && $offering->features) {
        $featuresData = $offering->features->toArray();
    }
    if (empty($featuresData)) {
        $featuresData = [];
    }
@endphp

<div x-data="featuresManager({{ json_encode($featuresData) }})">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Offering Features</h3>
        <button type="button" 
                @click="addFeature"
                class="inline-flex items-center px-3 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
            Add Feature
        </button>
    </div>
    
    <div class="space-y-4">
        <template x-for="(feature, index) in features" :key="index">
            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg relative">
                <button type="button" 
                        @click="removeFeature(index)"
                        class="absolute top-2 right-2 text-gray-400 hover:text-red-500 dark:hover:text-red-400">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </button>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label :for="'features_'+index+'_title'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Title
                        </label>
                        <input type="text" 
                               :name="'features['+index+'][title]'"
                               x-model="feature.title"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
                               required>
                    </div>
                    
                    <div>
                        <label :for="'features_'+index+'_icon'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Icon
                        </label>
                        <input type="text" 
                               :name="'features['+index+'][icon]'"
                               x-model="feature.icon"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label :for="'features_'+index+'_description'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea :name="'features['+index+'][description]'"
                                  x-model="feature.description"
                                  rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"></textarea>
                    </div>
                    
                    <input type="hidden" :name="'features['+index+'][order]'" x-model="feature.order">
                </div>
            </div>
        </template>
        
        <div x-show="features.length === 0" class="text-center py-12">
            <x-heroicon-o-plus-circle class="w-12 h-12 mx-auto text-gray-400" />
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No features added yet. Click "Add Feature" to start.</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
function featuresManager(initialFeatures = []) {
    return {
        features: initialFeatures.length ? initialFeatures.map((f, index) => ({ ...f, order: index })) : [],
        addFeature() {
            this.features.push({
                title: '',
                description: '',
                icon: '',
                order: this.features.length
            });
        },
        removeFeature(index) {
            this.features.splice(index, 1);
            this.features.forEach((feature, i) => feature.order = i);
        }
    }
}
</script>
@endpush