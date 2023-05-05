<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        $image = $this->faker->image(storage_path('app/public/articles'), 300, 300);
        $image = basename($image);

        return [
            'title' => $title,
            'slug' => str_replace(' ','-',$title),
            'author_id' => User::factory(),
            'article_group_id' => ArticleGroup::factory(),
            'picture' => 'public/articles/'.$image,
            'content' => $this->faker->paragraphs(5, true),
            'status' => Article::STATUS_PUBLISHED
        ];
    }
}
