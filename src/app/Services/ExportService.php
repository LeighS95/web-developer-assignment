<?php

namespace App\Services;

use App\Factories\ExporterFactory;

class ExportService
{
    protected $exporterFactory;

    public function __construct(ExporterFactory $exporterFactory)
    {
        $this->exporterFactory = $exporterFactory;
    }

    /**
     * Export data as CSV/XML
     * 
     * @return array
     */
    public function export(array $data, string $format): array
    {
        $exported = $this->exporterFactory->make($format);

        return $exported->export($data);
    }
}