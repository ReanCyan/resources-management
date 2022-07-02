<?php

namespace Tests\Feature\Link;

use Tests\TestCase;
use App\Models\Link;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    private $linkModel;

    public function setUp(): void
    {
        parent::setUp();

        $this->linkModel = Link::factory()->create();
    }

    public function test_link_can_be_updated()
    {
        $title        = $this->faker->sentence(10);
        $link         = $this->faker->url();
        $openInNewTab = $this->faker->boolean();

        $response = $this->put(route('links.update', ['link' => $this->linkModel->id]), [
            'title'           => $title,
            'link'            => $link,
            'open_in_new_tab' => $openInNewTab
        ]);

        $response->assertOk();
        $response->assertJson(['success' => true]);

        $this->assertEquals($title, Link::first()->title);
        $this->assertEquals($link, Link::first()->link);
        $this->assertEquals($openInNewTab, Link::first()->open_in_new_tab);
    }

    public function test_title_is_required()
    {
        $response = $this->put(route('links.update', ['link' => $this->linkModel->id]), [
            'link'            => $this->faker->url(),
            'open_in_new_tab' => $this->faker->boolean()
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_title_must_be_255_character_max()
    {
        $response = $this->put(route('links.update', ['link' => $this->linkModel->id]), [
            'title'           => $this->faker->sentence(200),
            'link'            => $this->faker->url(),
            'open_in_new_tab' => $this->faker->boolean()
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_link_is_required()
    {
        $response = $this->put(route('links.update', ['link' => $this->linkModel->id]), [
            'title'           => $this->faker->sentence(10),
            'open_in_new_tab' => $this->faker->boolean()
        ]);

        $response->assertSessionHasErrors('link');
    }

    public function test_link_must_be_255_character_max()
    {
        $domain = str_replace(' ', '', $this->faker->sentence(200));
        $link = "http://www.{$domain}.com";

        $response = $this->put(route('links.update', ['link' => $this->linkModel->id]), [
            'title'           => $this->faker->sentence(10),
            'link'            => $link,
            'open_in_new_tab' => $this->faker->boolean()
        ]);

        $response->assertSessionHasErrors('link');
    }

    public function test_link_must_be_valid_url()
    {
        $response = $this->put(route('links.update', ['link' => $this->linkModel->id]), [
            'title'           => $this->faker->sentence(10),
            'link'            => $this->faker->sentence(10),
            'open_in_new_tab' => $this->faker->boolean()
        ]);

        $response->assertSessionHasErrors('link');
    }

    public function test_open_in_new_tab_is_required()
    {
        $response = $this->put(route('links.update', ['link' => $this->linkModel->id]), [
            'title' => $this->faker->sentence(10),
            'link'  => $this->faker->url()
        ]);

        $response->assertSessionHasErrors('open_in_new_tab');
    }

    public function test_open_in_new_tab_is_boolean()
    {
        $response = $this->put(route('links.update', ['link' => $this->linkModel->id]), [
            'title'           => $this->faker->sentence(10),
            'link'            => $this->faker->url(),
            'open_in_new_tab' => 'true'
        ]);

        $response->assertSessionHasErrors('open_in_new_tab');
    }
}
