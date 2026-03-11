<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update services');
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'slug' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('services')->ignore($this->service)],
            'tagline' => ['sometimes', 'required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'featured_image' => ['nullable', 'image', 'max:2048'],
            'overview' => ['sometimes', 'required', 'string'],
            'description' => ['nullable', 'string'],
            
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            
            'is_published' => ['boolean'],
            'is_featured' => ['boolean'],
            
            'features' => ['nullable', 'array'],
            'features.*.id' => ['nullable', 'exists:service_features,id'],
            'features.*.title' => ['required_with:features', 'string', 'max:255'],
            'features.*.description' => ['nullable', 'string'],
            'features.*.icon' => ['nullable', 'string', 'max:255'],
            
            'process_steps' => ['nullable', 'array'],
            'process_steps.*.id' => ['nullable', 'exists:service_process_steps,id'],
            'process_steps.*.title' => ['required_with:process_steps', 'string', 'max:255'],
            'process_steps.*.description' => ['nullable', 'string'],
            'process_steps.*.icon' => ['nullable', 'string', 'max:255'],
            
            'faqs' => ['nullable', 'array'],
            'faqs.*.id' => ['nullable', 'exists:service_faqs,id'],
            'faqs.*.question' => ['required_with:faqs', 'string', 'max:500'],
            'faqs.*.answer' => ['required_with:faqs', 'string'],
            
            'technologies' => ['nullable', 'array'],
            'technologies.*.id' => ['nullable', 'exists:service_technologies,id'],
            'technologies.*.name' => ['required_with:technologies', 'string', 'max:255'],
            'technologies.*.icon' => ['nullable', 'string', 'max:255'],
            
            'pricing_models' => ['nullable', 'array'],
            'pricing_models.*.id' => ['nullable', 'exists:service_pricing_models,id'],
            'pricing_models.*.name' => ['required_with:pricing_models', 'string', 'max:100'],
            'pricing_models.*.description' => ['nullable', 'string'],
            'pricing_models.*.price' => ['nullable', 'numeric', 'min:0'],
            'pricing_models.*.duration' => ['nullable', 'string', 'max:50'],
            'pricing_models.*.features' => ['nullable', 'array'],
            'pricing_models.*.is_popular' => ['boolean'],
            
            'project_ids' => ['nullable', 'array'],
            'project_ids.*' => ['exists:projects,id'],
        ];
    }
}