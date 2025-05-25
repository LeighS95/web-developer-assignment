<?php

namespace App\Services\Exporters;

use App\Services\Exporters\ExporterInterface;

class CSVExporter implements ExporterInterface
{
    public function export(array $data)
    {
        $content = "";

        if (!empty($data)) {
            $headers = array_keys($data[0]);
            $content .= "" . implode(",", $headers) . "\n";

            foreach ($data as $row) {
                $content .= implode(",", $row) . "\n";
            }
        }

        return [
            'content' => $content,
            'contentType' => 'text/csv',
            'filename' => "books" . date('Y-m-d H:i:s') . ".csv",
        ];
    }
}