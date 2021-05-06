<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class TeacherImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Teacher([
           'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'date' => date_format(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']),"Y/m/d"),
            'address' => $row['address'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'gender' => ($row['gender']=='nam') ? 1 : 0
        ]);
    }
}
