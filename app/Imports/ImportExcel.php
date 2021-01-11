<?php

namespace App\Imports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportExcel implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        if(gettype($row[1]) == 'string'){
            return null;
        }
        $array = array();
        for ($i=1; $i <5; $i++) {
            if($row[$i] != ''){
                $dt = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($row[$i]);
                $date = date(DATE_RFC822, $dt);
                $date = explode(",", $date);
                $weekday = $date[0];
                $format = explode(" ", $date[1]);
                $excelDT = $weekday . ' ' . $format[1] . ' ' . $format[2] . ' 20'. $format[3];
                array_push($array, $excelDT);
            }else{
                array_push($array, '');
            } 
        }
        return new Project([
            'name' => $row[0] != '' ? $row[0] : '',
            'planned_start' => $row[1] != '' ? $array[0] : '',
            'planned_finish' => $row[2] != '' ? $array[1] : '',
            'actual_start' => $row[3] != '' ? $array[2] : '',
            'actual_finish' => $row[4] != '' ? $array[3] : '',
            'percent_complete' => $row[5] != '' ? $row[5] : '',
            'comment' => $row[6] != '' ? $row[6] : '',
        ]);
    }
}
