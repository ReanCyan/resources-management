<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HtmlSnippet>
 */
class HtmlSnippetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->sentence(10),
            'description' => $this->faker->text(100),
            'html'        => $this->faker->randomHtml(),
        ];
    }
}
