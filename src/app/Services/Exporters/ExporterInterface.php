<?php

namespace App\Services\Exporters;

interface ExporterInterface
{
    /**
     * 
     * @param array $data
     * @return array
     */
    public function export(array $data);
}