<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Service;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
{
    use HandlesAuthorization;

    public function before(User $user): ?bool
    {
        if ($user->hasRole('admin')) {
            return true;
        }
        
        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view services');
    }

    public function view(User $user, Service $service): bool
    {
        return $user->hasPermissionTo('view services');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create services');
    }

    public function update(User $user, Service $service): bool
    {
        if (!$user->hasPermissionTo('edit services')) {
            return false;
        }

        return $user->id === $service->user_id || $user->hasRole('admin');
    }

    public function delete(User $user, Service $service): bool
    {
        return $user->hasRole('admin') && $user->hasPermissionTo('delete services');
    }

    public function reorder(User $user): bool
    {
        return $user->hasPermissionTo('reorder services');
    }

    public function toggleStatus(User $user, Service $service): bool
    {
        return $user->hasPermissionTo('publish services');
    }

    public function clone(User $user, Service $service): bool
    {
        return $user->hasPermissionTo('create services');
    }
}