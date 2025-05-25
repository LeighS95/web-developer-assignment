<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use App\Services\ExportService;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Handle requests to export data
     *
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request, BookService $bookService, ExportService $exportService)
    {
        $format = $request->get('format');
        $columns = $request->get('columns');

        if ($columns == 'all') {
            $columns = ['title', 'author'];
        } else {
            $columns = array($columns);
        }

        $data = $bookService->getExportData($columns);
        $exported = $exportService->export($data, $format);

        return response($exported['content'])
            ->header('Content-Type', $exported['contentType'])
            ->header('Content-Disposition', "attachment; filename={$exported['filename']}");
    }
}
