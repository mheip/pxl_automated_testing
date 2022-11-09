<?php

namespace Tests\Feature;

use App\Models\Checkout;
use App\Models\CheckoutProduct;
use App\Models\Product;
use Tests\TestCase;

/**
 * Contains a feature integration test for the checkout.
 */
class CheckoutTest extends TestCase
{
    /**
     * Checkout we want to test for global discount.
     *
     * @var \App\Models\Checkout
     */
    protected Checkout $checkoutWithDiscount;

    /**
     * Checkout we want to test for no global discount.
     *
     * @var \App\Models\Checkout
     */
    protected Checkout $checkoutNoDiscount;

    /**
     * Setup our test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $checkoutProducts = [
            new CheckoutProduct(new Product('Monitor', 300), 2, 0.12),
            new CheckoutProduct(new Product('GPU', 1300), 1, 0.20),
            new CheckoutProduct(new Product('RAM 8GB', 75), 4),
            new CheckoutProduct(new Product('NVMe 2GB', 120), 2),
        ];
        $this->checkoutNoDiscount = new Checkout($checkoutProducts);

        $checkoutProducts[] = new CheckoutProduct(new Product('Moederbord', 275), 1);
        $checkoutProducts[] = new CheckoutProduct(new Product('Voeding 1500W', 120), 1, 0.50);
        $checkoutProducts[] = new CheckoutProduct(new Product('CPU', 375), 1);
        $this->checkoutWithDiscount = new Checkout($checkoutProducts);
    }

    /**
     * Test out view with a discount.
     */
    public function testCheckoutWithDiscountView(): void
    {
        $view = $this->view('checkout', [
            'products' => $this->checkoutWithDiscount->getProducts(),
            'totalPriceFull' => $this->checkoutWithDiscount->calculatePriceWithoutGlobalDiscount(),
            'totalPrice' => $this->checkoutWithDiscount->calculatePriceWithoutVat(),
            'btwAmount' => $this->checkoutWithDiscount->calculateVat(),
            'globalDiscountPercentage' => $this->checkoutWithDiscount->getDisplayGlobalDiscountPercentage(),
            'globalDiscountAmount' => $this->checkoutWithDiscount->calculateDiscount(),
            'totalPriceInclBTW' => $this->checkoutWithDiscount->calculatePriceWithVat(),
        ]);
        $view->assertSee('2818');
        $view->assertSee('5%');
        $view->assertSee('140.9');
        $view->assertSee('2677.1');
        $view->assertSee('562.191');
        $view->assertSee('3239.291');
    }

    /**
     * Test out view with no discount.
     */
    public function testCheckoutNoDiscountView(): void
    {
        $view = $this->view('checkout', [
            'products' => $this->checkoutNoDiscount->getProducts(),
            'totalPriceFull' => $this->checkoutNoDiscount->calculatePriceWithoutGlobalDiscount(),
            'totalPrice' => $this->checkoutNoDiscount->calculatePriceWithoutVat(),
            'btwAmount' => $this->checkoutNoDiscount->calculateVat(),
            'globalDiscountPercentage' => $this->checkoutNoDiscount->getDisplayGlobalDiscountPercentage(),
            'globalDiscountAmount' => $this->checkoutNoDiscount->calculateDiscount(),
            'totalPriceInclBTW' => $this->checkoutNoDiscount->calculatePriceWithVat(),
        ]);
        $view->assertSee('528');
        $view->assertSee('20%');
        $view->assertDontSee('Global discount percentage');
        $view->assertDontSee('Global discount amount');
        $view->assertSee('2108');
        $view->assertSee('442.68');
        $view->assertSee('2550.68');
    }

    /**
     * A basic test to see if the checkout works.
     */
    public function testCheckoutResponse(): void
    {
        $response = $this->get('/checkout');
        $response->assertStatus(200);
    }
}
