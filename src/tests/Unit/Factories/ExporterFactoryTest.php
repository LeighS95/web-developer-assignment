<?php

namespace Tests\Unit\Factories;

use App\Factories\ExporterFactory;
use App\Services\Exporters\CSVExporter;
use App\Services\Exporters\XMLExporter;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ExporterFactoryTest extends TestCase
{
    protected ExporterFactory $exporterFactory;

    protected function setUp(): void
    {
        parent::setUp();
        $this->exporterFactory = new ExporterFactory();
    }

    public function test_returns_csv_exporter()
    {
        $exporter = $this->exporterFactory->make('csv');
        $this->assertInstanceOf(CSVExporter::class, $exporter);
    }

    public function test_returns_xml_exporter()
    {
        $exporter = $this->exporterFactory->make('xml');
        $this->assertInstanceOf(XMLExporter::class, $exporter);
    }

    public function test_throws_exception_for_invalid_format()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Unsupported format: json');

        $this->exporterFactory->make('json');
    }
}
