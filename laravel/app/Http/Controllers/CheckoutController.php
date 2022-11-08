<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{

    /**
     * Generate a checkout.
     *
     * @param  int  $productId
     * @return \Illuminate\Contracts\View\View
     */
    public function buildCheckout(int $productId): View
    {
        return view('checkout', [
            'product_id' => $productId,
        ]);
    }
}
