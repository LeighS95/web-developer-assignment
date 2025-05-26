<?php

namespace Tests\Feature\Controllers;

use App\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExportControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $csvName;
    protected $xmlName;


    protected function setUp(): void
    {
        parent::setUp();

        Book::create(['title' => 'Pride and Prejudice', 'author' => 'Jane Austen']);

        $timestamp = date('Y-m-d H:i:s');
        $this->csvName = "attachment; filename=books$timestamp.csv";
        $this->xmlName = "attachment; filename=books$timestamp.xml";

        // disable csrf token for tests
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
    }

    public function test_export_as_csv_with_all_columns()
    {
        $response = $this->get('/export?format=csv&columns=all');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $response->assertHeader('Content-Disposition', $this->csvName);
        $response->assertSee('Pride and Prejudice');
        $response->assertSee('Jane Austen');
    }

    public function test_export_as_csv_with_specific_column()
    {
        $response = $this->get('/export?format=csv&columns=title');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
        $response->assertHeader('Content-Disposition', $this->csvName);
        $response->assertSee('Pride and Prejudice');
        $response->assertDontSee('Jane Austen');
    }

    public function test_export_as_xml_with_all_columns()
    {
        $response = $this->get('/export?format=xml&columns=all');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertHeader('Content-Disposition', $this->xmlName);
        $response->assertSee('<title>Pride and Prejudice</title>');
        $response->assertSee('<author>Jane Austen</author>');
    }

    public function test_export_as_xml_with_specific_column()
    {
        $response = $this->get('/export?format=xml&columns=title');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml');
        $response->assertHeader('Content-Disposition', $this->xmlName);
        $response->assertSee('<title>Pride and Prejudice</title>');
        $response->assertDontSee('<author>');
    }

    public function test_export_with_invalid_format_fails()
    {
        $response = $this->get('/export?format=json&columns=all');

        $response->assertStatus(500);
    }
}
