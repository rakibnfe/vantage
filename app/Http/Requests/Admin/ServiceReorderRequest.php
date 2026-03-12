<?php

namespace App\Http\Requests\Admin;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;

class ServiceReorderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('reorder', Service::class);
    }

    public function rules(): array
    {
        return [
            'items' => ['required', 'array'],
            'items.*.id' => ['required', 'exists:services,id'],
            'items.*.order' => ['required', 'integer', 'min:0'],
        ];
    }
}