<?php

namespace App\Policies;

use App\User;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function pass(User $user)
    {
        return $user->isInsignia();
    }
}
