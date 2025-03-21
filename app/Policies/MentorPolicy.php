<?php

namespace App\Policies;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class MentorPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Mentor $mentor): bool
    {
        return $user->is_admin;
    }

}
