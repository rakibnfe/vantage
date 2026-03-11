<?php

namespace App\Services\Admin;

use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceService
{
    public function create(array $data): Service
    {
        return DB::transaction(function () use ($data) {

            $data['slug'] = $this->generateSlug($data['title']);

            $service = Service::create($data);

            return $service;
        });
    }

    public function update(Service $service, array $data): Service
    {
        return DB::transaction(function () use ($service, $data) {

            if (isset($data['title'])) {
                $data['slug'] = $this->generateSlug($data['title'], $service->id);
            }

            $service->update($data);

            return $service;
        });
    }

    public function delete(Service $service): void
    {
        DB::transaction(function () use ($service) {

            $service->features()->delete();
            $service->faqs()->delete();
            $service->processSteps()->delete();
            $service->technologies()->delete();
            $service->pricingModels()->delete();

            $service->delete();
        });
    }

    public function toggleStatus(Service $service): void
    {
        $service->update([
            'is_published' => !$service->is_published
        ]);
    }

    public function clone(Service $service): Service
    {
        return DB::transaction(function () use ($service) {

            $new = $service->replicate();
            $new->title = $service->title . ' (Copy)';
            $new->slug = $this->generateSlug($new->title);
            $new->push();

            foreach ($service->features as $feature) {
                $new->features()->create($feature->toArray());
            }

            foreach ($service->faqs as $faq) {
                $new->faqs()->create($faq->toArray());
            }

            foreach ($service->processSteps as $step) {
                $new->processSteps()->create($step->toArray());
            }

            foreach ($service->technologies as $tech) {
                $new->technologies()->create($tech->toArray());
            }

            foreach ($service->pricingModels as $price) {
                $new->pricingModels()->create($price->toArray());
            }

            return $new;
        });
    }

    public function reorder(array $items)
    {
        foreach ($items as $order => $id) {
            Service::where('id', $id)->update([
                'order' => $order
            ]);
        }
    }

    private function generateSlug(string $title, $ignoreId = null): string
    {
        $slug = Str::slug($title);

        $query = Service::where('slug', 'LIKE', "$slug%");

        if ($ignoreId) {
            $query->where('id', '!=', $ignoreId);
        }

        $count = $query->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}