<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ExportController extends BaseController
{
    public function pdf($id)
    {
        $surveyor = $this->surveyorModel->find($id);
        $komoditas = $this->komoditasModel->find($surveyor['komoditas_id']);
        $lokasi = $this->lokasiModel->find($surveyor['lokasi_id']);

        $data = [
            'title' => 'Detail Transaction',
            'komoditas' => $komoditas,
            'lokasi' => $lokasi,
            'surveyor' => $surveyor
        ];

        $filename = date('Ymd') . '_transaction_' . $surveyor['id'];

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pages/export/pdf', $data));
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        $dompdf->stream($filename);

        return view('pages/export/pdf', $data);
    }

    public function excel()
    {
        $surveyor = $this->surveyorModel->getAllData();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->setActiveSheetIndex(0);

        $sheet->setCellValue('A1', 'Transaction');
        $sheet->setCellValue('A3', 'No.');
        $sheet->setCellValue('B3', 'Name');
        $sheet->setCellValue('C3', 'Date Time Survey');
        $sheet->setCellValue('D3', 'Commodity Name');
        $sheet->setCellValue('E3', 'Location Name');
        $sheet->setCellValue('F3', 'Repeat Orders');
        $sheet->setCellValue('G3', 'Survey Results');

        $sheet->mergeCells('A1:G1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $names = range('A', 'G');
        foreach ($names as $name) {
            $sheet->getColumnDimension($name)->setAutoSize(true);
        }

        $sheet->getStyle('A3:G3')->getFont()->setBold(true);
        $sheet->getStyle('A3:G3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $column = 4;
        $no = 0;
        foreach ($surveyor as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue("A{$column}", $no + 1)
                ->setCellValue("B{$column}", $data['marketing_nama'])
                ->setCellValue("C{$column}", date('d M Y', strtotime($data['waktu'])))
                ->setCellValue("D{$column}", $data['nama_komoditas'])
                ->setCellValue("E{$column}", $data['nama_lokasi'])
                ->setCellValue("F{$column}", $data['repeat_order'] == 0 ? 'Tidak' : 'Iya')
                ->setCellValue("G{$column}", $data['hasil_survey']);
            $no++;
            $column++;
        }
        $sheet->getStyle("A3:G" . ($column - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);


        $filename = date('Ymd') . '_transaction';

        header('Content-Type:application/vnd.ms_excel');
        header("Content-Disposition:attachment; filename={$filename}.xlsx");
        header('Cache-Control:max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}