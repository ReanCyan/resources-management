<?php

namespace Tests\Feature\Link;

use Tests\TestCase;
use App\Models\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListTest extends TestCase
{
    use RefreshDatabase;

    public function test_link_index_route_returns_successful_response()
    {
        $response = $this->get(route('links.index'));
        $response->assertOk();
    }

    public function test_link_list_can_be_retrieved()
    {
        Link::factory(10)->create();
        $this->assertCount(10, Link::all());

        $response = $this->get(route('links.index'));
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'link',
                    'open_in_new_tab'
                ]
            ]
        ]);
    }
}
