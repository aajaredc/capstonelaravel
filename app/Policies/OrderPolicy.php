<?php

namespace App\Policies;

use App\User;
use App\Order;
use Illuminate\Auth\Access\HandlesAuthorization;
use Session;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
      $permission = Session::get('permission');

      if ($permission | 4096) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can view the order.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
      $permission = Session::get('permission');

      if ($permission | 4096) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can create orders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
      $permission = Session::get('permission');

      if ($permission | 8192) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can update the order.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
      $permission = Session::get('permission');

      if ($permission | 16384) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can delete the order.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
      $permission = Session::get('permission');

      if ($permission | 32768) {
        return true;
      } else {
        return false;
      }
    }

    /**
     * Determine whether the user can restore the order.
     *
     * @param  \App\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function restore(User $user, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the order.
     *
     * @param  \App\User  $user
     * @param  \App\Order  $order
     * @return mixed
     */
    public function forceDelete(User $user, Order $order)
    {
        //
    }
}
