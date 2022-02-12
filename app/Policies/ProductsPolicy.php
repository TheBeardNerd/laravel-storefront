<?php

namespace App\Policies;

use App\Models\Product\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can manage the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function manage(User $user, Product $product)
    {
        return $user->email === env('ADMIN_EMAIL');
    }
}
