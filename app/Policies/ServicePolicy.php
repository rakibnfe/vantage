<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Service;

class ServicePolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Service $service)
    {
        return true;
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, Service $service)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, Service $service)
    {
        return $user->hasRole('admin');
    }

    public function toggleStatus(User $user)
    {
        return $user->hasRole('admin');
    }

    public function clone(User $user)
    {
        return $user->hasRole('admin');
    }

    public function reorder(User $user)
    {
        return $user->hasRole('admin');
    }
}