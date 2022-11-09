<?php

namespace Tests\Feature\Models;

use App\Models\Product;
use Tests\TestCase;

class ModelProductTest extends TestCase
{
    /**
     * Product we test.
     *
     * @var \App\Models\Product
     */
    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();
        $this->product = new Product('Motherboard', 100);
    }

    /**
     * Test if we can get the name of the product.
     */
    public function testProductName(): void
    {
        $this->assertEquals('Motherboard', $this->product->getName());
    }

    /**
     * Test if we can get the price of the product.
     */
    public function testProductPrice(): void
    {
        $this->assertEquals(100, $this->product->getUnitPrice());
    }
}
