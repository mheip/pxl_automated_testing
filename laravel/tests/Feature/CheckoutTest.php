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
        $response = $this->get('/checkout/123');
        $response->assertStatus(200);

        $response->assertSee('Hello world');
        $response->assertSee('123');
    }
}
