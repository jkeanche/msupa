<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return bool
     */
    public function view(User $user, Product $product)
    {
        // User can view the product if they own the store
        return $user->store && $user->store->id === $product->store_id;
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return bool
     */
    public function update(User $user, Product $product)
    {
        // User can update the product if they own the store
        return $user->store && $user->store->id === $product->store_id;
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return bool
     */
    public function delete(User $user, Product $product)
    {
        // User can delete the product if they own the store
        return $user->store && $user->store->id === $product->store_id;
    }
}
