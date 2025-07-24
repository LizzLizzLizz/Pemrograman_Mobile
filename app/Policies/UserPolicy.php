<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return $user->role === 'Admin';
    }

    public function view(User $user, User $targetUser)
    {
        return $user->role === 'Admin' || $user->id === $targetUser->id;
    }

    public function update(User $user, User $targetUser)
    {
        return $user->role === 'Admin' || $user->id === $targetUser->id;
    }

    public function delete(User $user, User $targetUser)
    {
        return $user->role === 'Admin';
    }

    public function viewTestimonials(User $user, User $targetUser)
    {
        return $user->role === 'Admin' || $user->id === $targetUser->id;
    }

    public function viewReservations(User $user, User $targetUser)
    {
        return $user->role === 'Admin' || $user->id === $targetUser->id;
    }

    /**
     * Only Admins can create users.
     */
    public function create(User $user)
    {
        return $user->role === 'Admin';
    }
}
