<?php

namespace App\Policies;

use App\User;
use App\Location;
use Illuminate\Auth\Access\HandlesAuthorization;
use Session;

class LocationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any locations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
      $permission = Session::get('permission');

      if ($permission & 65536) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can view the location.
     *
     * @param  \App\User  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function view(User $user)
    {
      $permission = Session::get('permission');

      if ($permission & 65536) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can create locations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      $permission = Session::get('permission');

      if ($permission & 131072) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can update the location.
     *
     * @param  \App\User  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function update(User $user)
    {
      $permission = Session::get('permission');

      if ($permission & 262144) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can delete the location.
     *
     * @param  \App\User  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function delete(User $user)
    {
      $permission = Session::get('permission');

      if ($permission & 524288) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can restore the location.
     *
     * @param  \App\User  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function restore(User $user, Location $location)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the location.
     *
     * @param  \App\User  $user
     * @param  \App\Location  $location
     * @return mixed
     */
    public function forceDelete(User $user, Location $location)
    {
        //
    }
}
