<?php


namespace App\View\Composers;


use App\Models\Cart;
use App\Models\User;
use Illuminate\View\View;

class CartComposer
{
    public function compose(View $view)
    {
        $carts = collect();

        if (auth()->isUser()) {
            $carts = Cart::memberCarts()->get();
        }

        $view->with('carts', $carts);
    }
}
