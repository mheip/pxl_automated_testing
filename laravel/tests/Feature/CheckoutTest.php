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
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/checkout');
        $response->assertStatus(200);
    }

    /**
     * Tests the total price of the products.
     *
     * @return void
     */
    public function testTotalPrice()
    {
        $response = $this->get('/checkout');
        $response->assertSee('2818');
    }

    /**
     * Test the discount percentage.
     *
     * @return void
     */
    public function testDiscountPercentage()
    {
        $response = $this->get('/checkout');
        $response->assertSee('5%');
    }

    /**
     * Tests the discount amount.
     *
     * @return void
     */
    public function testDiscountAmount()
    {
        $response = $this->get('/checkout');
        $response->assertSee('140.9');
    }

    /**
     * Tests the total price without vat.
     *
     * @return void
     */
    public function testPriceWithoutVat()
    {
        $response = $this->get('/checkout');
        $response->assertSee('2677.1');
    }

    /**
     * Tests the amount of VAT to be added to the price.
     *
     * @return void
     */
    public function testVatAmount()
    {
        $response = $this->get('/checkout');
        $response->assertSee('562.191');
    }

    /**
     * Tests the price with VAT.
     *
     * @return void
     */
    public function testPriceWithVat()
    {
        $response = $this->get('/checkout');
        $response->assertSee('3239.291');
    }
}
