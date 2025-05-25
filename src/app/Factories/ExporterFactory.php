<?php

namespace App\Factories;


use App\Services\Exporters\ExporterInterface;
use App\Services\Exporters\CSVExporter;
use App\Services\Exporters\XMLExporter;
use InvalidArgumentException;

class ExporterFactory
{
    public function make(string $format): ExporterInterface
    {
        if ($format === 'csv') {
            return new CSVExporter();
        }

        if ($format === 'xml') {
            return new XMLExporter();
        }

        throw new \Exception("Unsupported format: " . $format);
    }
}