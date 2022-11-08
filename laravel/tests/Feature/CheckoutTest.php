<?php

namespace Tests\Feature;

use Tests\TestCase;

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
}
