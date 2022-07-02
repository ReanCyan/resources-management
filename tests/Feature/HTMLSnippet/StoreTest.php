<?php

namespace Tests\Feature\HTMLSnippet;

use Tests\TestCase;
use App\Models\HtmlSnippet;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_html_snippet_can_be_added()
    {
        $response = $this->post(route('html_snippets.store'), [
            'title'       => $this->faker->sentence(10),
            'description' => $this->faker->text(100),
            'html'        => $this->faker->randomHtml(),
        ]);

        $response->assertOk();
        $response->assertJson(['success' => true]);
        $this->assertCount(1, HtmlSnippet::all());
    }

    public function test_title_is_required()
    {
        $response = $this->post(route('html_snippets.store'), [
            'description' => $this->faker->text(100),
            'html'        => $this->faker->randomHtml(),
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_title_must_not_be_greater_than_255_character()
    {
        $response = $this->post(route('html_snippets.store'), [
            'title'       => $this->faker->sentence(200),
            'description' => $this->faker->text(100),
            'html'        => $this->faker->randomHtml(),
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_description_is_required()
    {
        $response = $this->post(route('html_snippets.store'), [
            'title'       => $this->faker->sentence(10),
            'html'        => $this->faker->randomHtml(),
        ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_html_is_required()
    {
        $response = $this->post(route('html_snippets.store'), [
            'title'       => $this->faker->sentence(10),
            'description' => $this->faker->text(100),
        ]);

        $response->assertSessionHasErrors('html');
    }
}
