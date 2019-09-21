<?php

namespace App\Policies;

use App\User;
use App\InventoryItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class InventoryItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any inventory items.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can view the inventory item.
     *
     * @param  \App\User  $user
     * @param  \App\InventoryItem  $inventoryItem
     * @return mixed
     */
    public function view(User $user, InventoryItem $inventoryItem)
    {
        //
    }

    /**
     * Determine whether the user can create inventory items.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the inventory item.
     *
     * @param  \App\User  $user
     * @param  \App\InventoryItem  $inventoryItem
     * @return mixed
     */
    public function update(User $user, InventoryItem $inventoryItem)
    {
        //
    }

    /**
     * Determine whether the user can delete the inventory item.
     *
     * @param  \App\User  $user
     * @param  \App\InventoryItem  $inventoryItem
     * @return mixed
     */
    public function delete(User $user, InventoryItem $inventoryItem)
    {
        //
    }

    /**
     * Determine whether the user can restore the inventory item.
     *
     * @param  \App\User  $user
     * @param  \App\InventoryItem  $inventoryItem
     * @return mixed
     */
    public function restore(User $user, InventoryItem $inventoryItem)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the inventory item.
     *
     * @param  \App\User  $user
     * @param  \App\InventoryItem  $inventoryItem
     * @return mixed
     */
    public function forceDelete(User $user, InventoryItem $inventoryItem)
    {
        //
    }
}
