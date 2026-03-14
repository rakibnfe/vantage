@props(['service' => null, 'activeTab' => 'basic'])

<div x-data="{ activeTab: '{{ $activeTab }}' }">
    <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
        <nav class="flex flex-wrap -mb-px">
            <div @click.prevent="activeTab = 'basic'" 
                 :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'basic', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'basic' }"
                 class="cursor-pointer mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Basic Information
            </div>
            
            <div @click.prevent="activeTab = 'features'" 
                 :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'features', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'features' }"
                 class="cursor-pointer mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Features
            </div>
            
            <div @click.prevent="activeTab = 'process'" 
                 :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'process', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'process' }"
                 class="cursor-pointer mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Process Steps
            </div>
            
            <div @click.prevent="activeTab = 'faqs'" 
                 :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'faqs', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'faqs' }"
                 class="cursor-pointer mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                FAQs
            </div>
            
            <div @click.prevent="activeTab = 'technologies'" 
                 :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'technologies', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'technologies' }"
                 class="cursor-pointer mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Technologies
            </div>
            
            <div @click.prevent="activeTab = 'pricing'" 
                 :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'pricing', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'pricing' }"
                 class="cursor-pointer mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Pricing
            </div>
            
            <div @click.prevent="activeTab = 'projects'" 
                 :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'projects', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'projects' }"
                 class="cursor-pointer mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Related Projects
            </div>
            
            <div @click.prevent="activeTab = 'seo'" 
                 :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'seo', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'seo' }"
                 class="cursor-pointer py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                SEO Settings
            </div>
        </nav>
    </div>

    <!-- Hidden input to track active tab for form submission -->
    <input type="hidden" name="active_tab" x-model="activeTab">
    
    <div>
        <div x-show="activeTab === 'basic'" x-cloak>
            @include('admin.services.tabs.basic', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'features'" x-cloak>
            @include('admin.services.tabs.features', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'process'" x-cloak>
            @include('admin.services.tabs.process', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'faqs'" x-cloak>
            @include('admin.services.tabs.faqs', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'technologies'" x-cloak>
            @include('admin.services.tabs.technologies', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'pricing'" x-cloak>
            @include('admin.services.tabs.pricing', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'projects'" x-cloak>
            @include('admin.services.tabs.projects', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'seo'" x-cloak>
            @include('admin.services.tabs.seo', ['service' => $service])
        </div>
    </div>
</div>