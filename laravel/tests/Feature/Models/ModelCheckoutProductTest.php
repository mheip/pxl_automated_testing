<?php

namespace Tests\Feature\Models;

use App\Models\CheckoutProduct;
use App\Models\Product;
use Tests\TestCase;

class ModelCheckoutProductTest extends TestCase
{
    /**
     * Product we test.
     *
     * @var \App\Models\Product
     */
    protected Product $product;
    /**
     * Checkout product with no discount.
     *
     * @var \App\Models\CheckoutProduct
     */
    protected CheckoutProduct $checkoutProduct;
    /**
     * Checkout product with discount.
     *
     * @var \App\Models\CheckoutProduct
     */
    protected CheckoutProduct $checkoutProductDiscount;

    protected function setUp(): void
    {
        parent::setUp();
        $product = new Product('Motherboard', 100);
        $this->checkoutProduct = new CheckoutProduct($product, 2);
        $this->checkoutProductDiscount = new CheckoutProduct($product, 2, 0.5);
    }

    /**
     * Test if we can get the name of the product.
     */
    public function testDiscount(): void
    {
        $this->assertEquals(0, $this->checkoutProduct->getDiscountAmount());
        $this->assertEquals(100, $this->checkoutProductDiscount->getDiscountAmount());
    }

    /**
     * Test if we can get the price of the product.
     */
    public function testTotalPrices(): void
    {
        // Check prices on a checkout product with no discount.
        $this->assertEquals(
            $this->checkoutProduct->getTotalPriceWithoutDiscount(),
            $this->checkoutProduct->getTotalPriceWithDiscount()
        );

        // Check prices on a checkout product with discount.
        $this->assertEquals(200, $this->checkoutProductDiscount->getTotalPriceWithoutDiscount());
        $this->assertEquals(100, $this->checkoutProductDiscount->getTotalPriceWithDiscount());
    }
}
