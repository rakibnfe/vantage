@props(['offering' => null])

@php
    $pricingData = old('pricing_models');
    if (empty($pricingData) && $offering && $offering->pricingModels) {
        $pricingData = $offering->pricingModels->toArray();
    }
    if (empty($pricingData)) {
        $pricingData = [];
    }
@endphp

<div x-data="pricingManager({{ json_encode($pricingData) }})">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pricing Models</h3>
        <button type="button" 
                @click="addPricing"
                class="inline-flex items-center px-3 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg">
            <x-heroicon-o-plus class="w-4 h-4 mr-2" />
            Add Pricing Model
        </button>
    </div>
    
    <div class="space-y-4">
        <template x-for="(pricing, index) in pricingModels" :key="index">
            <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg relative">
                <button type="button" 
                        @click="removePricing(index)"
                        class="absolute top-2 right-2 text-gray-400 hover:text-red-500 dark:hover:text-red-400">
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </button>
                
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label :for="'pricing_'+index+'_name'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Plan Name
                            </label>
                            <input type="text" 
                                   :name="'pricing_models['+index+'][name]'"
                                   x-model="pricing.name"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
                                   required>
                        </div>
                        
                        <div>
                            <label :for="'pricing_'+index+'_price'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Price
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">$</span>
                                <input type="number" 
                                       :name="'pricing_models['+index+'][price]'"
                                       x-model="pricing.price"
                                       step="0.01"
                                       min="0"
                                       class="w-full pl-8 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
                            </div>
                        </div>
                        
                        <div>
                            <label :for="'pricing_'+index+'_duration'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Duration
                            </label>
                            <input type="text" 
                                   :name="'pricing_models['+index+'][duration]'"
                                   x-model="pricing.duration"
                                   placeholder="e.g., month, year, one-time"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500">
                        </div>
                        
                        <div class="flex items-center">
                            <label class="flex items-center">
                                <input type="checkbox" 
                                       :name="'pricing_models['+index+'][is_popular]'"
                                       x-model="pricing.is_popular"
                                       value="1"
                                       class="rounded border-gray-300 dark:border-gray-600 text-primary-600 shadow-sm focus:ring-primary-500">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Mark as Popular</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label :for="'pricing_'+index+'_description'" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Description
                        </label>
                        <textarea :name="'pricing_models['+index+'][description]'"
                                  x-model="pricing.description"
                                  rows="2"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"></textarea>
                    </div>
                    
                    <div x-data="featuresList(index, pricing.features || [])">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Features
                        </label>
                        <div class="space-y-2">
                            <template x-for="(feature, fIndex) in features" :key="fIndex">
                                <div class="flex items-center gap-2">
                                    <input type="text" 
                                           :name="'pricing_models['+index+'][features]['+fIndex+']'"
                                           x-model="features[fIndex]"
                                           class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500"
                                           placeholder="Enter feature">
                                    <button type="button" 
                                            @click="removeFeature(fIndex)"
                                            class="text-gray-400 hover:text-red-500">
                                        <x-heroicon-o-x-mark class="w-5 h-5" />
                                    </button>
                                </div>
                            </template>
                            
                            <button type="button" 
                                    @click="addFeature"
                                    class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400">
                                + Add Feature
                            </button>
                        </div>
                    </div>
                    
                    <input type="hidden" :name="'pricing_models['+index+'][order]'" x-model="pricing.order">
                </div>
            </div>
        </template>
        
        <div x-show="pricingModels.length === 0" class="text-center py-12">
            <x-heroicon-o-currency-dollar class="w-12 h-12 mx-auto text-gray-400" />
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">No pricing models added yet. Click "Add Pricing Model" to start.</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
function pricingManager(initialPricing = []) {
    return {
        pricingModels: initialPricing.length ? initialPricing.map((p, index) => ({ 
            ...p, 
            order: index,
            features: p.features || []
        })) : [],
        addPricing() {
            this.pricingModels.push({
                name: '',
                description: '',
                price: null,
                duration: '',
                features: [],
                is_popular: false,
                order: this.pricingModels.length
            });
        },
        removePricing(index) {
            this.pricingModels.splice(index, 1);
            this.pricingModels.forEach((pricing, i) => pricing.order = i);
        }
    }
}

function featuresList(pricingIndex, initialFeatures = []) {
    return {
        features: initialFeatures,
        addFeature() {
            this.features.push('');
        },
        removeFeature(index) {
            this.features.splice(index, 1);
        }
    }
}
</script>
@endpush