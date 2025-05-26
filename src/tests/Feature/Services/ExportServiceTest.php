<?php

namespace Tests\Feature\Services;

use App\Factories\ExporterFactory;
use App\Services\ExportService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExportServiceTest extends TestCase
{
    use WithFaker;

    protected $data;
    protected $csvName;
    protected $xmlName;

    protected function setUp(): void
    {
        parent::setUp();

        $this->data = [
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen'],
            ['title' => 'Alice in Wonderland', 'author' => 'Lewis Carroll'],
            ['title' => 'Adventures of Tom Sawyer', 'author' => 'Mark Twain'],
        ];

        $timestamp = date('Y-m-d H:i:s');
        $this->csvName = "books$timestamp.csv";
        $this->xmlName = "books$timestamp.xml";
    }

    public function test_export_as_csv()
    {
        $service = new ExportService(new ExporterFactory());
        $result = $service->export($this->data, 'csv');

        $this->assertIsArray($result);
        $this->assertStringContainsString('Pride and Prejudice', $result['content']);
        $this->assertEquals('text/csv', $result['contentType']);
        $this->assertEquals($this->csvName, $result['filename']);
    }

    public function test_export_as_xml()
    {
        $service = new ExportService(new ExporterFactory());
        $result = $service->export($this->data, 'xml');

        $this->assertIsArray($result);
        $this->assertStringContainsString('<book>', $result['content']);
        $this->assertStringContainsString('<title>Pride and Prejudice</title>', $result['content']);
        $this->assertEquals('application/xml', $result['contentType']);
        $this->assertEquals($this->xmlName, $result['filename']);
    }
}
