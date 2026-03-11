@props(['service' => null, 'projects'])

<!-- Tab Navigation -->
<div class="border-b border-gray-200 dark:border-gray-700 mb-6">
    <nav class="flex flex-wrap -mb-px" x-data="{ activeTab: 'basic' }">
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

<!-- Tab Content -->
<div>
    <!-- Basic Information Tab -->
    <div x-show="activeTab === 'basic'" x-cloak>
        @include('admin.services.tabs.basic', ['service' => $service])
    </div>
    
    <!-- Features Tab -->
    <div x-show="activeTab === 'features'" x-cloak>
        @include('admin.services.tabs.features', ['service' => $service])
    </div>
    
    <!-- Process Steps Tab -->
    <div x-show="activeTab === 'process'" x-cloak>
        @include('admin.services.tabs.process', ['service' => $service])
    </div>
    
    <!-- FAQs Tab -->
    <div x-show="activeTab === 'faqs'" x-cloak>
        @include('admin.services.tabs.faqs', ['service' => $service])
    </div>
    
    <!-- Technologies Tab -->
    <div x-show="activeTab === 'technologies'" x-cloak>
        @include('admin.services.tabs.technologies', ['service' => $service])
    </div>
    
    <!-- Pricing Tab -->
    <div x-show="activeTab === 'pricing'" x-cloak>
        @include('admin.services.tabs.pricing', ['service' => $service])
    </div>
    
    <!-- Projects Tab -->
    <div x-show="activeTab === 'projects'" x-cloak>
        @include('admin.services.tabs.projects', ['projects' => $projects, 'service' => $service])
    </div>
    
    <!-- SEO Tab -->
    <div x-show="activeTab === 'seo'" x-cloak>
        @include('admin.services.tabs.seo', ['service' => $service])
    </div>
</div>