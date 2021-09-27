<?php

namespace Tests\Feature\Api\Controller;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        $this->json('GET', route('categories.index'))->assertStatus(200);
    }

    public function testShow(): void
    {
        $category = Category::factory()->create();

        $this->json('GET', route('categories.show', $category->id))->assertStatus(200);
    }


    public function testStore(): void
    {
        $data = [
            'title' => 'test title cat store',
        ];
        $this->json('POST', route('categories.store'), $data)->assertStatus(201);

    }

    public function testStoreInvalidArgument(): void
    {
        $data = [
            'test' => 'test title cat store',
        ];
        $this->json('POST', route('categories.store'), $data)->assertStatus(422);

    }

    public function testUpdate(): void
    {
        $category = Category::factory()->create();

        $data = [
            'title' => 'test title cat update',
        ];

        $this->json('PUT', route('categories.update', $category->id), $data)->assertStatus(200);
    }

    public function testUpdateWrongId(): void
    {
        $data = [
            'title' => 'test title cat update',
        ];

        $this->json('PUT', route('categories.update', 3), $data)->assertStatus(400);
    }

    public function testDelete(): void
    {
        $category = Category::factory()->create();

        $this->json('DELETE', route('categories.destroy', $category->id))->assertStatus(204);

    }
}
