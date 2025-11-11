<?php

namespace App\Policies;

use App\Models\Application;
use App\Models\User;

class ApplicationPolicy
{
    /**
     * @param User $user
     * @param Application $application
     * @return bool
     */
    public function update(User $user, Application $application): bool
    {
        return $user->id === $application->author_id;
    }

    /**
     * @param User $user
     * @param Application $application
     * @return bool
     */
    public function forceDelete(User $user, Application $application): bool
    {
        return $user->hasRole('admin') || $user->id === $application->author_id;
    }
}
