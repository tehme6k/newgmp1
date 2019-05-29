<?php

namespace App\Policies;

use App\User;
use App\Box;
use Illuminate\Auth\Access\HandlesAuthorization;

class BoxPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the box.
     *
     * @param  \App\User  $user
     * @param  \App\Box  $box
     * @return mixed
     */
    public function view(User $user, Box $box)
    {
        //
    }

    /**
     * Determine whether the user can create boxes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return in_array($user->hasPermission('add_boxes'));
    }

    /**
     * Determine whether the user can update the box.
     *
     * @param  \App\User  $user
     * @param  \App\Box  $box
     * @return mixed
     */
    public function update(User $user, Box $box)
    {
        //
    }

    /**
     * Determine whether the user can delete the box.
     *
     * @param  \App\User  $user
     * @param  \App\Box  $box
     * @return mixed
     */
    public function delete(User $user, Box $box)
    {
        //
    }

    /**
     * Determine whether the user can restore the box.
     *
     * @param  \App\User  $user
     * @param  \App\Box  $box
     * @return mixed
     */
    public function restore(User $user, Box $box)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the box.
     *
     * @param  \App\User  $user
     * @param  \App\Box  $box
     * @return mixed
     */
    public function forceDelete(User $user, Box $box)
    {
        //
    }
}
