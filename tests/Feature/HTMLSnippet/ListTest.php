<?php

namespace Tests\Feature\HTMLSnippet;

use Tests\TestCase;
use App\Models\HtmlSnippet;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListTest extends TestCase
{
    use RefreshDatabase;

    public function test_html_snippet_index_route_returns_a_successful_response()
    {
        $response = $this->get(route('html_snippets.index'));
        $response->assertOk();
    }

    public function test_html_snippet_list_can_be_retrieved()
    {
        HTMLSnippet::factory(10)->create();
        $this->assertCount(10, HtmlSnippet::all());

        $response = $this->get(route('html_snippets.index'));
        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'html'
                ]
            ]
        ]);
    }
}
