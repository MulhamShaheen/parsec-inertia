<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Employer;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployerPolicy
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

    public function update(User $user, Employer $employer){

        if($user->role == 1){
            return $user->aboutEmployer()->get() == $employer;
        }

        return false;
    }
}
