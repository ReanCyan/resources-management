<?php

namespace Tests\Feature;

use Tests\TestCase;

class VisitorTest extends TestCase
{
    public function test_visitor_route_returns_a_successful_response()
    {
        $response = $this->get(route('visitor'));
        $response->assertOk();
    }
}
