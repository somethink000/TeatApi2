<?php

namespace Tests\Feature;

use App\Models\Notebook;
use App\Models\User;
use Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class NotebookTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Storage::fake();
    }


    public function testNotebookIndex(): void
    {
        $response = $this->get(route('notebook.index'));

        $response->assertStatus(200);
    }

    public function testNotebookShow(): void
    {
        $notebook = Notebook::factory()->create();

        $response = $this->get(route('notebook.show', $notebook));

        $response->assertStatus(200);
    }


    public function testNotebookCreate(): void
    {

        $notebook = Notebook::factory()->make();
        $response = $this->post(
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

    public function testNotebookUpdate(): void
    {

        $notebook = Notebook::factory()->create();
        $data = Notebook::factory()->make();
        $response = $this->patch(
            route('notebook.update', $notebook->getKey()),
            [
                'image' => UploadedFile::fake()->image('avatar.jpg')
            ] +
                $data->getAttributes()
        )
            ->assertOk()
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



    public function testNotebookDelete(): void
    {
        $notebook = Notebook::factory()->create();

        $response = $this->delete(route('notebook.destroy', $notebook->getKey()));
        $response->assertOk();
    }




    public static function invalidNotebookFieldsProvider(): Generator
    {
        yield 'invalid email' => ['email', 'some11212e11212'];
        yield 'null email' => ['email', null];
    }
}
