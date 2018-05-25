<?php

namespace app\api\models;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use app\web\models\User;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Class Users
 * @package app\api\models
 */
class Users extends User
{
    public static function export(string $file)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        foreach (self::find()->each() as $index => $user) {
            $row = $index + 1;
            $sheet->setCellValue("A{$row}", $user['id']);
            $sheet->setCellValue("B{$row}", $user['name']);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save($file);
    }
}
