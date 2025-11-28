<?php

namespace App\Policies;

use App\Models\Cake;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CakePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // All authenticated users and guests can view cakes
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Cake $cake): bool
    {
        // All users (including guests) can view individual cakes
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only authenticated users can create cakes
        return $user !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Cake $cake): bool
    {
        // Users can update their own cakes, admins can update any cake
        return $user->isAdmin() || $user->id === $cake->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Cake $cake): bool
    {
        // Only admins can delete cakes
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Cake $cake): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Cake $cake): bool
    {
        return false;
    }
}
