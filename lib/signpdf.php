<?php

namespace {
    require_once __DIR__ . '/fpdf/fpdf.php';
    require_once __DIR__ . '/fpdi/src/autoload.php';
}

namespace Sign {

    use FPDF;
    use setasign\Fpdi\Fpdi;

    function signPdf($name, $pdfFileName, array $data)
    {
        $pdf = new Fpdi();

//        for ($i = 1; $i <= $pdf->setSourceFile($pdfFileName); $i++) {
//            $tplId = $pdf->importPage($i);
//            $sizes = $pdf->getTemplateSize($tplId);

//            $width = $sizes['width'];
//            $height = $sizes['height'];
//            $orientation = $sizes['orientation'];
        $pdf->AddPage();//$orientation, [$sizes[0], $sizes[1]]);
//        $tplId = $pdf->importPage(1);
        $width = $pdf->GetPageWidth();
        $height = $pdf->GetPageHeight();

//            if ($i === 1) {
        $line1 = "ДОКУМЕНТ ПОДПИСАН ЭЦП";
        $line2 = "Сертификат: {$data['number']}";
        $line3 = "Владелец: {$data['owner']}";
        $line4 = "Действителен: {$data['dates']}";

        $lines = [$line1, $line2, $line3, $line4];

        $font = $width * 3 / 100;
        $fontw = $font * 0.3;
        $stampHeight = $font * 3.3;
        $w = null;

        foreach ($lines as $line) {
            $length = iconv_strlen($line, 'utf-8');
            $sym = preg_replace('/[^\W]/u', '', $line);
            $small = preg_replace('/[^a-zа-яё0-9]/u', '', $line);

            $symLength = iconv_strlen($sym, 'utf-8');
            $smallLength = iconv_strlen($small, 'utf-8');
            $nw = $fontw * ($length - $smallLength - $symLength) + $fontw * 0.85 * $smallLength + $fontw * 0.5 * $symLength;
            if (null === $w || $nw > $w) {
                $w = $nw;
            }
        }
//                $pdf->useTemplate($tplId);
        $pdf->SetLineWidth(100 / $width);
        $pdf->SetFillColor(255);
        $pdf->SetTextColor(70, 76, 160);
        $pdf->SetDrawColor(70, 76, 160);

        $h = $stampHeight;
        $x = $width - $w - $width * 1 / 100;
        $y = $height * 1 / 100;

        (new PdfSigner($pdf))->RoundedRect($x, $y, $w, $h, 3.5);

        $pdf->AddFont('dejavusans', 'b');
        $pdf->SetFont('dejavusans', 'b', $font);
        $pdf->Text($x + $fontw + $w / 2 - (21 * $fontw) / 2, $y + $font / 1.5, \iconv('utf-8', 'cp1251', $line1));
        $pdf->Text($x + $fontw, $y + $font / 1.5 * 2, \iconv('utf-8', 'cp1251', $line2));
        $pdf->Text($x + $fontw, $y + $font / 1.5 * 3, \iconv('utf-8', 'cp1251', $line3));
        $pdf->Text($x + $fontw, $y + $font / 1.5 * 4, \iconv('utf-8', 'cp1251', $line4));
//            } else {
//                $pdf->useTemplate($tplId);
//            }
//        }

        $stampName = tempnam('/tmp', 'stamp_pdf');
        $pdf->Output('F', $stampName, true);
        $newPdfName = tempnam('/tmp', 'signed_pdf');
        $tmpFiles[] = $stampName;

        `pdftk A=${pdfFileName} cat 1 output ${newPdfName} 2>&1 >> /dev/null`;
        $tmpFiles[] = $newPdfName;
        `pdftk ${newPdfName} stamp ${stampName} output ${newPdfName}_signed 2>&1 >> /dev/null`;
        $tmpFiles[] = $newPdfName . '_signed';
        `pdftk A=${pdfFileName} B=${newPdfName}_signed cat B A2-end output ${newPdfName}_final 2>&1 >> /dev/null`;
        $tmpFiles[] = $newPdfName . '_final';

        $outputFile = file_exists($newPdfName . '_final') ? $newPdfName . '_final' : $newPdfName . '_signed';
        foreach ($tmpFiles as $file) {
            if ($file !== $outputFile) {
                unlink($file);
            }
        }

        return [
            'name' => pathinfo($name, PATHINFO_FILENAME) . '.signed.pdf',
            'type' => 'application/pdf',
            'tmp_name' => $outputFile,
            'error' => UPLOAD_ERR_OK,
            'size' => filesize($newPdfName),
        ];
    }

    class PdfSigner extends FPDF
    {
        private $pdf;

        public function __construct(FPDF $pdf)
        {
            $this->pdf = $pdf;
        }

        function RoundedRect($x, $y, $w, $h, $r, $style = '')
        {
            $k = $this->pdf->k;
            $hp = $this->pdf->h;
            if ($style == 'F')
                $op = 'f';
            elseif ($style == 'FD' || $style == 'DF')
                $op = 'B';
            else
                $op = 'S';
            $MyArc = 4 / 3 * (sqrt(2) - 1);
            $this->pdf->_out(sprintf('%.2F %.2F m', ($x + $r) * $k, ($hp - $y) * $k));
            $xc = $x + $w - $r;
            $yc = $y + $r;
            $this->pdf->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - $y) * $k));

            $this->_Arc($xc + $r * $MyArc, $yc - $r, $xc + $r, $yc - $r * $MyArc, $xc + $r, $yc);
            $xc = $x + $w - $r;
            $yc = $y + $h - $r;
            $this->pdf->_out(sprintf('%.2F %.2F l', ($x + $w) * $k, ($hp - $yc) * $k));
            $this->_Arc($xc + $r, $yc + $r * $MyArc, $xc + $r * $MyArc, $yc + $r, $xc, $yc + $r);


            $xc = $x + $r;
            $yc = $y + $h - $r;
            $this->pdf->_out(sprintf('%.2F %.2F l', $xc * $k, ($hp - ($y + $h)) * $k));
            $this->_Arc($xc - $r * $MyArc, $yc + $r, $xc - $r, $yc + $r * $MyArc, $xc - $r, $yc);
            $xc = $x + $r;
            $yc = $y + $r;
            $this->pdf->_out(sprintf('%.2F %.2F l', ($x) * $k, ($hp - $yc) * $k));
            $this->_Arc($xc - $r, $yc - $r * $MyArc, $xc - $r * $MyArc, $yc - $r, $xc, $yc - $r);
            $this->pdf->_out($op);
        }

        function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
        {
            $h = $this->pdf->h;
            $this->pdf->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1 * $this->pdf->k, ($h - $y1) * $this->pdf->k,
                $x2 * $this->pdf->k, ($h - $y2) * $this->pdf->k, $x3 * $this->pdf->k, ($h - $y3) * $this->pdf->k));
        }
    }
}
