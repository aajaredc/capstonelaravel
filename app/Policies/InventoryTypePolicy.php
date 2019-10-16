<?php

namespace App\Policies;

use App\User;
use App\InventoryType;
use Session;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any inventory types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
      $permission = Session::get('permission');

      if ($permission & 16) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can view the inventory type.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
      $permission = Session::get('permission');

      if ($permission & 16) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can create inventory types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      $permission = Session::get('permission');

      if ($permission & 32) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can update the inventory type.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
      $permission = Session::get('permission');

      if ($permission & 64) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can delete the inventory type.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
      $permission = Session::get('permission');

      if ($permission & 128) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can restore the inventory type.
     *
     * @param  \App\User  $user
     * @param  \App\InventoryType  $inventoryType
     * @return mixed
     */
    public function restore(User $user, InventoryType $inventoryType)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the inventory type.
     *
     * @param  \App\User  $user
     * @param  \App\InventoryType  $inventoryType
     * @return mixed
     */
    public function forceDelete(User $user, InventoryType $inventoryType)
    {
        //
    }
}
