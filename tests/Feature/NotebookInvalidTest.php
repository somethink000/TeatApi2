<?php

namespace Tests\Feature;

use App\Models\Notebook;
use Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class NotebookInvalidTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Storage::fake();
    }


    /**
     * @dataProvider invalidNotebookFieldsProvider
     */
    public function testNotebookCreateInvalid(string $field, mixed $value): void
    {
        $notebook = Notebook::factory()->make();
        $response = $this->post(
            route('notebook.store'),
            array_merge(
                [
                    'image' => UploadedFile::fake()->image('avatar.jpg')
                ],
                $notebook->getAttributes(),
                [
                    $field => $value
                ]
            )
        )
            ->assertInvalid();
    }

    /**
     * @dataProvider invalidNotebookFieldsProvider
     */
    public function testNotebookUpdateInvalid(string $field, mixed $value): void
    {

        $notebook = Notebook::factory()->create();
        $response = $this->patch(
            route('notebook.update', $notebook->getKey()),
            array_merge(
                [
                    'image' => UploadedFile::fake()->image('avatar.jpg')
                ],
                $notebook->getAttributes(),
                [
                    $field => $value
                ]
            )
        )
            ->assertInvalid();
    }

    public static function invalidNotebookFieldsProvider(): Generator
    {
        yield 'invalid name' => ['name', 212];
        yield 'invalid company' => ['company', 'a'];
        yield 'invalid phone' => ['phone', '112121'];
        yield 'invalid email' => ['email', 'some11212e11212'];
        yield 'invalid birthday' => ['birthday', '212'];
        yield 'invalid file' => ['image', UploadedFile::fake()->create('avatar.txt', 1, 'text/csv')];
    }
}
