<?php

namespace Tests\Feature\Api\Controller;

use App\Models\Blood;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BloodControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex(): void
    {
        $this->json('GET', route('bloods.index'))->assertStatus(200);
    }

    public function testShow(): void
    {
        $blood = Blood::factory()->create();

        $this->json('GET', route('bloods.show', $blood->id))->assertStatus(200);
    }


    public function testStore(): void
    {
        $category = Category::factory()->create();

        $data = [
            'title' => 'test title store',
            'code' => 'test code store',
            'codeICD' => 'test code icd store',
            'categories' => [$category->id]
        ];
        $this->json('POST', route('bloods.store'), $data)->assertStatus(201);

    }

    public function testStoreInvalidArgument(): void
    {
        $data = [
            'test' => 'test title store',
            'code' => 'test code store',
            'codeICD' => 'test code icd store'
        ];
        $this->json('POST', route('bloods.store'), $data)->assertStatus(422);

    }

    public function testUpdate(): void
    {
        $blood = Blood::factory()->create();

        $data = [
            'title' => 'test title update',
            'code' => 'test code update',
            'codeICD' => 'test code icd update'
        ];

        $this->json('PUT', route('bloods.update', $blood->id), $data)->assertStatus(200);
    }

    public function testUpdateWrongId(): void
    {
        $data = [
            'title' => 'test title update',
            'code' => 'test code update',
            'codeICD' => 'test code icd update'
        ];

        $this->json('PUT', route('bloods.update', 3), $data)->assertStatus(400);
    }

    public function testDelete(): void
    {
        $blood = Blood::factory()->create();

        $this->json('DELETE', route('bloods.destroy', $blood->id))->assertStatus(204);

    }
}
