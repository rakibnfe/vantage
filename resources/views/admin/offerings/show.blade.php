@extends('admin.layouts.app')

@section('title', $offering->title)
@section('page-title', $offering->title)

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-4">
            @if($offering->icon)
                <x-dynamic-component :component="'heroicon-o-' . $offering->icon" class="w-8 h-8 text-primary-600 dark:text-primary-400" />
            @endif
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $offering->tagline }}</p>
                <div class="flex items-center gap-2 mt-1">
                    @if($offering->is_published)
                        <span class="px-2 py-1 text-xs font-medium bg-green-100 dark:bg-green-900-30 text-green-800 dark:text-green-300 rounded-full">Published</span>
                    @else
                        <span class="px-2 py-1 text-xs font-medium bg-yellow-100 dark:bg-yellow-900-30 text-yellow-800 dark:text-yellow-300 rounded-full">Draft</span>
                    @endif
                    @if($offering->is_highlighted)
                        <span class="px-2 py-1 text-xs font-medium bg-purple-100 dark:bg-purple-900-30 text-purple-800 dark:text-purple-300 rounded-full">Highlighted</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard.offerings.edit', $offering) }}" 
               class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg">
                <x-heroicon-o-pencil class="w-4 h-4 mr-2" />
                Edit Offering
            </a>
            <a href="{{ route('dashboard.offerings.index') }}" 
               class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                Back to List
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Overview</h3>
                <p class="text-gray-700 dark:text-gray-300">{{ $offering->overview }}</p>
                
                @if($offering->description)
                    <h4 class="text-md font-semibold text-gray-900 dark:text-white mt-6 mb-3">Description</h4>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($offering->description)) !!}
                    </div>
                @endif
            </div>

            @if($offering->features && $offering->features->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Features</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($offering->features as $feature)
                        <div class="flex items-start gap-3">
                            @if($feature->icon)
                                <x-dynamic-component :component="'heroicon-o-' . $feature->icon" class="w-5 h-5 text-primary-600 dark:text-primary-400 mt-1" />
                            @endif
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">{{ $feature->title }}</h4>
                                @if($feature->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $feature->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($offering->processSteps && $offering->processSteps->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Process</h3>
                <div class="space-y-4">
                    @foreach($offering->processSteps as $index => $step)
                        <div class="flex items-start gap-4">
                            <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900-30 text-primary-600 dark:text-primary-400 flex items-center justify-center font-semibold flex-shrink-0">
                                {{ $index + 1 }}
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">{{ $step->title }}</h4>
                                @if($step->description)
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $step->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if($offering->faqs && $offering->faqs->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">FAQs</h3>
                <div class="space-y-4">
                    @foreach($offering->faqs as $faq)
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">{{ $faq->question }}</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $faq->answer }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <div class="space-y-6">
            @if($offering->projects && $offering->projects->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Related Projects</h3>
                <div class="space-y-3">
                    @foreach($offering->projects as $project)
                        <a href="{{ route('dashboard.projects.show', $project) }}" class="block p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                            <div class="font-medium text-gray-900 dark:text-white">{{ $project->title }}</div>
                            @if($project->slug)
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $project->slug }}</div>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            @if($offering->technologies && $offering->technologies->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Technologies</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($offering->technologies as $tech)
                        <span class="px-3 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm">
                            {{ $tech->name }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

            @if($offering->pricingModels && $offering->pricingModels->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pricing</h3>
                <div class="space-y-3">
                    @foreach($offering->pricingModels as $pricing)
                        <div class="p-3 border border-gray-200 dark:border-gray-700 rounded-lg {{ $pricing->is_popular ? 'border-primary-500 dark:border-primary-400' : '' }}">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-gray-900 dark:text-white">{{ $pricing->name }}</span>
                                @if($pricing->is_popular)
                                    <span class="px-2 py-1 text-xs bg-primary-100 dark:bg-primary-900-30 text-primary-800 dark:text-primary-300 rounded-full">Popular</span>
                                @endif
                            </div>
                            @if($pricing->price)
                                <div class="mt-2">
                                    <span class="text-xl font-bold text-gray-900 dark:text-white">${{ number_format($pricing->price, 2) }}</span>
                                    @if($pricing->duration)
                                        <span class="text-sm text-gray-500 dark:text-gray-400">/{{ $pricing->duration }}</span>
                                    @endif
                                </div>
                            @endif
                            @if($pricing->description)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">{{ $pricing->description }}</p>
                            @endif
                            @if(!empty($pricing->features))
                                <ul class="mt-3 space-y-1">
                                    @foreach($pricing->features as $feature)
                                        <li class="text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                                            <x-heroicon-o-check class="w-4 h-4 text-green-500" />
                                            {{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Meta Information</h3>
                <dl class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-gray-500 dark:text-gray-400">Created</dt>
                        <dd class="text-gray-900 dark:text-white">{{ $offering->created_at?->format('M d, Y H:i') ?? 'N/A' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-500 dark:text-gray-400">Last Updated</dt>
                        <dd class="text-gray-900 dark:text-white">{{ $offering->updated_at?->format('M d, Y H:i') ?? 'N/A' }}</dd>
                    </div>
                    @if($offering->published_at)
                    <div class="flex justify-between">
                        <dt class="text-gray-500 dark:text-gray-400">Published</dt>
                        <dd class="text-gray-900 dark:text-white">{{ $offering->published_at->format('M d, Y H:i') }}</dd>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <dt class="text-gray-500 dark:text-gray-400">Display Order</dt>
                        <dd class="text-gray-900 dark:text-white">{{ $offering->order }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection