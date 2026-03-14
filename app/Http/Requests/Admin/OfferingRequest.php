<?php

namespace App\Http\Requests\Admin;

use App\Enums\OfferingStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OfferingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $offeringId = $this->route('offering')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('offerings')->ignore($offeringId)],
            'tagline' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'featured_image' => ['nullable', 'image', 'max:2048'],
            'overview' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'status' => ['required', Rule::in(array_column(OfferingStatus::cases(), 'value'))],
            'is_highlighted' => ['boolean'],
            'order' => ['integer', 'min:0'],
            
            'features' => ['nullable', 'array'],
            'features.*.title' => ['required_with:features', 'string', 'max:255'],
            'features.*.description' => ['nullable', 'string'],
            'features.*.icon' => ['nullable', 'string', 'max:255'],
            
            'process_steps' => ['nullable', 'array'],
            'process_steps.*.title' => ['required_with:process_steps', 'string', 'max:255'],
            'process_steps.*.description' => ['nullable', 'string'],
            'process_steps.*.icon' => ['nullable', 'string', 'max:255'],
            
            'faqs' => ['nullable', 'array'],
            'faqs.*.question' => ['required_with:faqs', 'string', 'max:500'],
            'faqs.*.answer' => ['required_with:faqs', 'string'],
            
            'technologies' => ['nullable', 'array'],
            'technologies.*.name' => ['required_with:technologies', 'string', 'max:255'],
            'technologies.*.icon' => ['nullable', 'string', 'max:255'],
            
            'pricing_models' => ['nullable', 'array'],
            'pricing_models.*.name' => ['required_with:pricing_models', 'string', 'max:100'],
            'pricing_models.*.description' => ['nullable', 'string'],
            'pricing_models.*.price' => ['nullable', 'numeric', 'min:0'],
            'pricing_models.*.duration' => ['nullable', 'string', 'max:50'],
            'pricing_models.*.features' => ['nullable', 'array'],
            'pricing_models.*.is_popular' => ['boolean'],
            
            'project_ids' => ['nullable', 'array'],
            'project_ids.*' => ['exists:projects,id'],
            
            // Tab tracking (not stored, just for redirect)
            'active_tab' => ['nullable', 'string', 'max:50'],
        ];
    }
}