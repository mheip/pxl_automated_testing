<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class CheckoutController extends Controller
{

    /**
     * Generate a checkout.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function buildCheckout(): View
    {
        $products = [
            [
                'name' => 'Monitor',
                'unitPrice' => '300',
                'amount' => '2',
            ],
            [
                'name' => 'GPU',
                'unitPrice' => '1300',
                'amount' => '1',
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
            ],
            [
                'name' => 'CPU',
                'unitPrice' => '375',
                'amount' => '1',
            ],
        ];

        $totalPrice = '0';
        $totalPriceInclBTW = '0';
        foreach ($products as $key => $product) {
            $totalProductPrice = $product['unitPrice'] * $product['amount'];
            $products[$key]['totalPrice'] = $totalProductPrice;
            $totalPrice += $totalProductPrice;
        }

        $btwAmount = $totalPrice * (21 / 100);
        $totalPriceInclBTW = $btwAmount + $totalPrice;

        return view('checkout', [
            'products' => $products,
            'totalPrice' => $totalPrice,
            'btwAmount' => $btwAmount,
            'totalPriceInclBTW' => $totalPriceInclBTW,
        ]);
    }
}
