<?php

namespace Sign;

use Imagick;
use ImagickDraw;
use ImagickPixel;

function signImage($name, $filename, array $data)
{
    $line1 = "ДОКУМЕНТ ПОДПИСАН ЭЦП";
    $line2 = "Сертификат: ${data['number']}";
    $line3 = "Владелец: {$data['owner']}";
    $line4 = "Действителен: {$data['dates']}";

    $maxLength = max(array_map(function ($str) {
        return iconv_strlen($str, 'utf8');
    }, [$line1, $line2, $line3, $line4]));

    $image = new Imagick($filename);
    $width = $image->getImageWidth();
    $height = $image->getImageHeight();
    $font = $width * 1.7 / 100;

    $fontw = $font * 0.6;
    $fontm = $font * 1.1;
    $stampHeight = $font * 5;

    $draw = new ImagickDraw();
    $w = $fontw * $maxLength;
    $h = $stampHeight;
    $x = $width - $w - $fontw * 2;
    $y = $height * 1 / 100;

    $draw->setFillOpacity(0.0);
    $draw->setStrokeColor(new ImagickPixel('rgb(70, 76, 160)'));
    $draw->setStrokeWidth($font * 0.2);
    $draw->roundRectangle($x, $y, $x + $w, $y + $h, $fontw, $fontw);

    $image->drawImage($draw);

    $draw = new ImagickDraw();
    $draw->setFont('/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf');
    $draw->setFontSize($font);
    $draw->setFillColor(new ImagickPixel('rgb(70, 76, 160)'));
    $image->annotateImage($draw, $x + $w / 2 - (21 * $fontw * 1.25) / 2, $y + $fontm, 0, $line1);
    $image->annotateImage($draw, $x + $font / 3, $y + $fontm * 2, 0, $line2);
    $image->annotateImage($draw, $x + $font / 3, $y + $fontm * 3, 0, $line3);
    $image->annotateImage($draw, $x + $font / 3, $y + $fontm * 4, 0, $line4);

    $newPdfName = tempnam('/tmp', 'signed_pdf');
    $image->writeImage('png:' . $newPdfName);

    return [
        'name' => pathinfo($name, PATHINFO_FILENAME) . '.signed.png',
        'type' => 'image/png',
        'tmp_name' => $newPdfName,
        'error' => UPLOAD_ERR_OK,
        'size' => filesize($newPdfName),
    ];
}
