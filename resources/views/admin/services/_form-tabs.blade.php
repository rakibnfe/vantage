@props(['service' => null])

<div x-data="{ activeTab: 'basic' }">
    <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
        <nav class="flex flex-wrap -mb-px">
            <button @click="activeTab = 'basic'" 
                    :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'basic', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'basic' }"
                    class="mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Basic Information
            </button>
            
            <button @click="activeTab = 'features'" 
                    :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'features', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'features' }"
                    class="mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Features
            </button>
            
            <button @click="activeTab = 'process'" 
                    :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'process', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'process' }"
                    class="mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Process Steps
            </button>
            
            <button @click="activeTab = 'faqs'" 
                    :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'faqs', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'faqs' }"
                    class="mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                FAQs
            </button>
            
            <button @click="activeTab = 'technologies'" 
                    :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'technologies', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'technologies' }"
                    class="mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Technologies
            </button>
            
            <button @click="activeTab = 'pricing'" 
                    :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'pricing', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'pricing' }"
                    class="mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Pricing
            </button>
            
            <button @click="activeTab = 'projects'" 
                    :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'projects', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'projects' }"
                    class="mr-8 py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Related Projects
            </button>
            
            <button @click="activeTab = 'seo'" 
                    :class="{ 'border-primary-600 text-primary-600 dark:text-primary-400': activeTab === 'seo', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300': activeTab !== 'seo' }"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                SEO Settings
            </button>
        </nav>
    </div>

    <div>
        <div x-show="activeTab === 'basic'">
            @include('admin.services.tabs.basic', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'features'">
            @include('admin.services.tabs.features', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'process'">
            @include('admin.services.tabs.process', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'faqs'">
            @include('admin.services.tabs.faqs', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'technologies'">
            @include('admin.services.tabs.technologies', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'pricing'">
            @include('admin.services.tabs.pricing', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'projects'">
            @include('admin.services.tabs.projects', ['service' => $service])
        </div>
        
        <div x-show="activeTab === 'seo'">
            @include('admin.services.tabs.seo', ['service' => $service])
        </div>
    </div>
</div>