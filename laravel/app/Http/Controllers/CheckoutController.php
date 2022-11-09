<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\CheckoutProduct;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{

    /**
     * Generate a checkout.
     */
    public function buildCheckout(): View
    {

        $checkoutProducts = [
            new CheckoutProduct(new Product('Monitor', 300), 2, 0.12),
            new CheckoutProduct(new Product('GPU', 1300), 1, 0.2),
            new CheckoutProduct(new Product('RAM 8GB', 75), 4),
            new CheckoutProduct(new Product('NVMe 2GB', 120), 2),
        ];

        $checkoutProducts[] = new CheckoutProduct(new Product('Moederbord', 275), 1);
        $checkoutProducts[] = new CheckoutProduct(new Product('Voeding 1500W', 120), 1, 0.5);
        $checkoutProducts[] = new CheckoutProduct(new Product('CPU', 375), 1);

        $checkout = new Checkout($checkoutProducts);

        return view('checkout', [
            'products' => $checkout->getProducts(),
            'totalPriceFull' => $checkout->calculatePriceWithoutGlobalDiscount(),
            'totalPrice' => $checkout->calculatePriceWithoutVat(),
            'btwAmount' => $checkout->calculateVat(),
            'globalDiscountPercentage' => $checkout->getDisplayGlobalDiscountPercentage(),
            'globalDiscountAmount' => $checkout->calculateDiscount(),
            'totalPriceInclBTW' => $checkout->calculatePriceWithVat(),
        ]);
    }
}
