<?php

namespace Tests\Feature;

use Tests\TestCase;

class AdminTest extends TestCase
{
    public function test_admin_route_returns_a_successful_response()
    {
        $response = $this->get(route('admin'));
        $response->assertOk();
    }
}
