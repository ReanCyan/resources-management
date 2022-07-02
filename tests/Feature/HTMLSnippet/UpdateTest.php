<?php

namespace Tests\Feature\HTMLSnippet;

use Tests\TestCase;
use App\Models\HtmlSnippet;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->snippet = HTMLSnippet::factory()->create();
    }

    public function test_html_snippet_can_be_updated()
    {
        $title       = $this->faker->sentence(10);
        $description = $this->faker->text(100);
        $html        = $this->faker->randomHtml();

        /*
            TrimStrings middleware will filter string in request
            We need to trim string to match the stored string
            Source: \App\Http\Middleware\TrimStrings
        */
        $html = preg_replace('~^[\s﻿]+|[\s﻿]+$~u', '', $html) ?? trim($html);

        $response = $this->put(route('html_snippets.update', ['html_snippet' => $this->snippet->id]), [
            'title'       => $title,
            'description' => $description,
            'html'        => $html,
        ]);

        $response->assertOk();
        $response->assertJson(['success' => true]);

        $htmlSnippet = HtmlSnippet::first();

        $this->assertEquals($title, $htmlSnippet->title);
        $this->assertEquals($description, $htmlSnippet->description);
        $this->assertEquals($html, $htmlSnippet->html);
    }

    public function test_title_is_required()
    {
        $response = $this->put(route('html_snippets.update', ['html_snippet' => $this->snippet->id]), [
            'description' => $this->faker->text(100),
            'html'        => $this->faker->randomHtml(),
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_title_must_not_be_greater_than_255_character()
    {
        $response = $this->put(route('html_snippets.update', ['html_snippet' => $this->snippet->id]), [
            'title'       => $this->faker->sentence(200),
            'description' => $this->faker->text(100),
            'html'        => $this->faker->randomHtml(),
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_description_is_required()
    {
        $response = $this->put(route('html_snippets.update', ['html_snippet' => $this->snippet->id]), [
            'title'       => $this->faker->sentence(10),
            'html'        => $this->faker->randomHtml(),
        ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_html_is_required()
    {
        $response = $this->put(route('html_snippets.update', ['html_snippet' => $this->snippet->id]), [
            'title'       => $this->faker->sentence(10),
            'description' => $this->faker->text(100),
        ]);

        $response->assertSessionHasErrors('html');
    }
}
