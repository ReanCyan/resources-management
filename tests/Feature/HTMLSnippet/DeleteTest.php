<?php

namespace Tests\Feature\HTMLSnippet;

use Tests\TestCase;
use App\Models\HtmlSnippet;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_html_snippet_can_be_deleted()
    {
        HtmlSnippet::factory()->create();
        $this->assertCount(1, HtmlSnippet::all());

        $htmlSnippet = HtmlSnippet::first();

        $response = $this->delete(route('html_snippets.destroy', [ 'html_snippet' => $htmlSnippet->id ]));
        $response->assertOk();

        $this->assertCount(0, HtmlSnippet::all());
    }
}
