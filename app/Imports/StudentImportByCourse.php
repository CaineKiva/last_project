<?php

namespace App\Imports;

use Request;
use App\Models\Students;
use App\Models\Discipline;
use App\Models\Course;
use App\Models\Classs;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class StudentImportByCourse implements ToCollection,WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $count_student = 0;
        foreach ($rows->toArray() as $index => $row) {
            $row = array_filter($row);
            if(!empty($row)){
                $count_student++;
            }
            else{
                unset($rows[$index]);
            }
        }
        
        $number_class = Request::get('name');
        $number_student_in_class = ceil($count_student / $number_class);

        
        
        $id_discipline = Request::get('id_discipline');
        $id_course = Request::get('id_course');
        $name_discipline = Discipline::find($id_discipline)->name_collapse;
        $name_course = Course::find($id_course)->name_collapse;
        $count_class_with_dis_and_crs = Classs::where([
                                    'id_discipline' => $id_discipline,
                                    'id_course' => $id_course,
                                ])->count();

        $count = 0;
        foreach ($rows as $row) 
        {
            if($count == $number_student_in_class){
                $count = 0;
            }
            if($count==0){
                $id_class = Classs::insertGetId([
                    'name' => $name_discipline . ($count_class_with_dis_and_crs++) . $name_course,
                    'id_discipline' => $id_discipline,
                    'id_course' => $id_course,
                ]);
            }
            $array = [
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'date' => date_format(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date']),"Y/m/d"),
                'address' => $row['address'],
                'phone' => $row['phone'],
                'email' => $row['email'],
                'gender' => ($row['gender']=='nam') ? 1 : 0,
                'id_class' => $id_class
            ];
            Students::create($array);
            
            $count++;
        }
    }
}
