<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{

    /**
     * Generate a checkout.
     */
    public function buildCheckout(): View
    {

        $globalDiscount = true;
        $globalDiscountPercentage = '0.05';

        $products = [
            [
                'name' => 'Monitor',
                'unitPrice' => '300',
                'amount' => '2',
                'discount' => '0.12',
            ],
            [
                'name' => 'GPU',
                'unitPrice' => '1300',
                'amount' => '1',
                'discount' => '0.20',
            ],
            [
                'name' => 'RAM 8GB',
                'unitPrice' => '75',
                'amount' => '4',
            ],
            [
                'name' => 'NVMe 2GB',
                'unitPrice' => '120',
                'amount' => '2',
            ],
            [
                'name' => 'Moederbord',
                'unitPrice' => '275',
                'amount' => '1',
            ],
            [
                'name' => 'Voeding 1500W',
                'unitPrice' => '120',
                'amount' => '1',
                'discount' => '0.5',
            ],
            [
                'name' => 'CPU',
                'unitPrice' => '375',
                'amount' => '1',
            ],
        ];

        if (count($products) < 5) {
            $globalDiscount = false;
        }

        $totalPrice = '0';
        $totalPriceInclBTW = '0';
        foreach ($products as $key => $product) {
            $totalProductPrice = $product['unitPrice'] * $product['amount'];
            $products[$key]['totalPrice'] = $totalProductPrice;

            if (isset($product['discount'])) {
                $products[$key]['discountAmount'] = $totalProductPrice * $product['discount'];
                $totalProductPrice = $totalProductPrice - $products[$key]['discountAmount'];
                $products[$key]['discount'] = ($product['discount'] * 100) . '%';
            }

            $products[$key]['totalPrice'] = $totalProductPrice;
            $totalPrice += $totalProductPrice;
        }

        if ($globalDiscount) {
            $totalPriceFull = $totalPrice;
            $btwAmount = ($totalPrice * (1 - $globalDiscountPercentage)) * (21 / 100);
            $globalDiscountAmount = $totalPrice - ($totalPrice * (1 - $globalDiscountPercentage));
            $totalPrice *= (1 - $globalDiscountPercentage);
        } else {
            $totalPriceFull = $totalPrice;
            $btwAmount = $totalPrice * (21 / 100);
            $globalDiscountAmount = 0;
        }

        $totalPriceInclBTW = $btwAmount + $totalPrice;

        return view('checkout', [
            'products' => $products,
            'totalPriceFull' => $totalPriceFull,
            'totalPrice' => $totalPrice,
            'btwAmount' => $btwAmount,
            'globalDiscountPercentage' => $globalDiscountPercentage * 100,
            'globalDiscountAmount' => $globalDiscountAmount,
            'totalPriceInclBTW' => $totalPriceInclBTW,
        ]);
    }
}
