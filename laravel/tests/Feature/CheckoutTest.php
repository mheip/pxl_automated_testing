<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Contains a feature integration test for the checkout.
 */
class CheckoutTest extends TestCase
{

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/checkout');
        $response->assertStatus(200);
    }

    /**
     * Tests the total price of the products.
     */
    public function testTotalPrice(): void
    {
        $response = $this->get('/checkout');
        $response->assertSee('2818');
    }

    /**
     * Test the discount percentage.
     */
    public function testDiscountPercentage(): void
    {
        $response = $this->get('/checkout');
        $response->assertSee('5%');
    }

    /**
     * Tests the discount amount.
     */
    public function testDiscountAmount(): void
    {
        $response = $this->get('/checkout');
        $response->assertSee('140.9');
    }

    /**
     * Tests the total price without vat.
     */
    public function testPriceWithoutVat(): void
    {
        $response = $this->get('/checkout');
        $response->assertSee('2677.1');
    }

    /**
     * Tests the amount of VAT to be added to the price.
     */
    public function testVatAmount(): void
    {
        $response = $this->get('/checkout');
        $response->assertSee('562.191');
    }

    /**
     * Tests the price with VAT.
     */
    public function testPriceWithVat(): void
    {
        $response = $this->get('/checkout');
        $response->assertSee('3239.291');
    }
}
