<?php

namespace App\View;

use Illuminate\View\View;
use Cart;

class CartComposer
{
    public function compose(View $view)
    {
        $view->with('cartHeader', Cart::getContent()->splice(0, 2));
        $view->with('cartHeaderCount', Cart::getContent()->count());
        $view->with('cartHeaderTotal', Cart::getTotal());
    }
}
