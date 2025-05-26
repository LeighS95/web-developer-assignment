<?php

namespace Tests\Feature\Requests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreBookRequestTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // disable csrf token for tests
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    public function test_it_fails_when_required_fields_are_missing()
    {
        $response = $this->post('books', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['author', 'title']);
    }

    public function test_it_passes_with_valid_data()
    {
        $response = $this->post('books', [
            'author' => 'Test Author',
            'title' => 'Test Title',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('books');
    }
}
