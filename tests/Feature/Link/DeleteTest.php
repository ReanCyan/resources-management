<?php

namespace Tests\Feature\Link;

use Tests\TestCase;
use App\Models\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_link_can_be_deleted()
    {
        Link::factory()->create();
        $this->assertCount(1, Link::all());

        $link = Link::first();

        $response = $this->delete(route('links.destroy', [ 'link' => $link->id ]));
        $response->assertOk();

        $this->assertCount(0, Link::all());
    }
}
