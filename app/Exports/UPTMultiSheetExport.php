<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class UPTMultiSheetExport implements WithMultipleSheets
{
    use Exportable;
    public function sheets(): array {
        return [
            new UPTSheetExport('UPT Klinik Utama Sungai Bangkong'),
            new UPTSheetExport('UPT Klinik Pratama'),
            new UPTSheetExport('UPT Laboratorium Kesehatan'),
            new UPTSheetExport('UPT Pelatihan Kesehatan'),
        ];
    }
}