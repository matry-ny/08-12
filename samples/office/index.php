<?php

/**
 * https://ruseller.com/lessons.php?id=712&rub=37
 */

require_once __DIR__ . '/vendor/autoload.php';

use app\PDF;

$builder = (new PDF())->getBuilder();

$builder->AddPage();
$builder->Image('https://php-academy.kiev.ua/2017/img/logo-footer.png');
$builder->SetFont(PDF::ARIAL_FAMILY, PDF::BOLD_TEXT, 14);
$builder->Ln(10);

$text = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.';
$builder->Cell(100, 20, $text);

$pdfTarget = __DIR__ . '/lorem.pdf';
$builder->Output($pdfTarget, PDF::FILE_OUTPUT);

$zip = new ZipArchive();
$filename = __DIR__ . '/lorem.zip';

if ($zip->open($filename, ZipArchive::CREATE) !== true) {
    exit("File {$filename} can not be loaded");
}

$zip->addFile($pdfTarget, basename($pdfTarget));
$zip->close();