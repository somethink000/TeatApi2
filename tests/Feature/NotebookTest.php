<?php

namespace Tests\Feature;

use App\Models\Notebook;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class NotebookTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testNotebookCreate(): void
    {
        Storage::fake();

        $notebook = Notebook::factory()->make();
        $response = $this->postJson(
            route('notebook.store'),
            [
                'image' => UploadedFile::fake()->image('avatar.jpg')
            ] +
                $notebook->getAttributes()
        )
            ->assertCreated()
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'company',
                    'phone',
                    'email',
                    'birthday',
                    'image'
                ]
            ]);

        Notebook::findOrFail($response->json('data.id'));
    }
}
