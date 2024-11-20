<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    
        return [
            'blog_id' => \App\Models\Blog::factory(), // Automatically create a related Blog
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'image_url' => $this->faker->imageUrl(640, 480, 'post', true),
        ];
    }
}
