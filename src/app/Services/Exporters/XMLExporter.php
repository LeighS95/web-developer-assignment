<?php

namespace App\Services\Exporters;

use App\Services\Exporters\ExporterInterface;
use SimpleXMLElement;

class XMLExporter implements ExporterInterface
{
    public function export(array $data)
    {
        $xml = new SimpleXMLElement('<?xml version="1.0"?><books></books>');

        foreach ($data as $row) {
            $book = $xml->addChild('book');

            foreach ($row as $key => $value) {
                $book->addChild($key, htmlspecialchars($value));
            }
        }

        return [
            'content' => $xml->asXML(),
            'contentType' => 'application/xml',
            'filename' => "books" . date('Y-m-d H:i:s') . ".xml",
        ];
    }
}