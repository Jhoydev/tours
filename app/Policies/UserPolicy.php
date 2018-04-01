<?php

namespace App\Policies;

use App\Company;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function pass(User $user, Company $company)
    {
        if ($user->isRole('insignia')){
            return true;
        }else{
            return $user->company_id == $company->id;
        }

    }
}
