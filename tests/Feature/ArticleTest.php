<?php

namespace Tests\Feature;

use App\Models\ArticleGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Article;
use Illuminate\Http\UploadedFile;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $group;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->group = ArticleGroup::factory()->create();
    }

    /**
     * A basic feature test example.
     * @ return void
     */
    public function testCreateArticle()
    {
        $response = $this->actingAs($this->user)->post('api/articles', [
            'title' => 'Test Article',
            'picture' => UploadedFile::fake()->image('test-picture.jpg'),
            'content' => 'This is a test article.',
            'article_group_id' => $this->group->id,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('articles', [
            'title' => 'Test Article',
            'content' => 'This is a test article.',
        ]);

        $response->assertStatus(200);
    }

    /**
     * @ return void
     */
    public function testUpdateArticle()
    {
        $article = Article::factory()->create([
            'title' => 'Test Article',
            'picture' => uploadFile(UploadedFile::fake()->image('test-picture.jpg'),'public/articles'),
            'content' => 'This is a test article.',
            'article_group_id' => $this->group->id,
            'slug' => str_replace(' ','-','Test Article'),
            'author_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->put('api/articles/' . $article->id, [
            'title' => 'Updated Article',
            'content' => 'This is an updated article.',
            'article_group_id' => $this->group->id,
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('articles', [
            'id' => $article->id,
            'title' => 'Updated Article',
            'content' => 'This is an updated article.',
        ]);
    }

    /**
     * Test reading an article.
     *
     * @ return void
     */
    public function testReadArticle()
    {
        $article = Article::factory()->create([
            'title' => 'Test Article',
            'picture' => uploadFile(UploadedFile::fake()->image('test-picture.jpg'),'public/articles'),
            'content' => 'This is a test article.',
            'article_group_id' => $this->group->id,
            'slug' => str_replace(' ','-','Test Article'),
            'author_id' => $this->user->id
        ]);

        $response = $this->get('api/articles/' . $article->slug);

        $response->assertStatus(200)
            ->assertSee($article->title)
            ->assertSee($article->content);
    }

    /**
     * Test reading an article.
     *
     * @ return void
     */
    public function testDeleteArticle()
    {
        $article = Article::factory()->create([
            'title' => 'Test Article',
            'picture' => uploadFile(UploadedFile::fake()->image('test-picture.jpg'),'public/articles'),
            'content' => 'This is a test article.',
            'article_group_id' => $this->group->id,
            'slug' => str_replace(' ','-','Test Article'),
            'author_id' => $this->user->id
        ]);

        $response = $this->actingAs($this->user)->delete('api/articles/' . $article->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('articles', [
            'id' => $article->id,
        ]);
    }
}
