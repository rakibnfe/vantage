<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Offering;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferingPolicy
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
        return $user->hasPermissionTo('view offerings');
    }

    public function view(User $user, Offering $offering): bool
    {
        return $user->hasPermissionTo('view offerings');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create offerings');
    }

    public function update(User $user, Offering $offering): bool
    {
        if (!$user->hasPermissionTo('edit offerings')) {
            return false;
        }

        return $user->id === $offering->user_id || $user->hasRole('admin');
    }

    public function delete(User $user, Offering $offering): bool
    {
        return $user->hasRole('admin') && $user->hasPermissionTo('delete offerings');
    }

    public function reorder(User $user): bool
    {
        return $user->hasPermissionTo('reorder offerings');
    }

    public function toggleStatus(User $user, Offering $offering): bool
    {
        return $user->hasPermissionTo('publish offerings');
    }

    public function clone(User $user, Offering $offering): bool
    {
        return $user->hasPermissionTo('create offerings');
    }
}