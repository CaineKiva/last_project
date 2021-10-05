<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Nurse;
use App\Models\Speciallist;
use App\Models\Competence;
use App\Models\Patient;
use App\Models\Supplier;
use App\Models\Medicine;
use App\Models\Medicalrecords;
use App\Models\Appointment;
use DB;
use Session;

class AjaxController extends Controller
{
    public function appointment_list(Request $rq){
        $doctor_id = $rq->get('doctor_id');
        $appointment_list = Appointment::where('doctor_id',$doctor_id)->get();
        return $appointment_list;
    }
    public function doctor_information(Request $rq){
        $doctor_id = $rq->get('doctor_id');
        $doctor = Doctor::where('doctor_id',$doctor_id)->get();
        return $doctor;
    }
    public function patient_information(Request $rq){
        $patient_id = $rq->get('patient_id');
        $patient = Patient::where('patient_id',$patient_id)->get();
        return $patient;
    }
    public function doctor_speciallist(Request $rq){
        $speciallist_id = $rq->get('speciallist_id');
        $doctor = Doctor::where('speciallist_id',$speciallist_id)->get();
        return $doctor;
    }
    public function doctor_medicalrecords(Request $rq){
        $medicalrecords_id = $rq->get('medicalrecords_id');
        $medicalrecords = Medicalrecords::where('medicalrecords_id',$medicalrecords_id)
                                        ->join('patient','medicalrecords.patient_id' , 'patient.patient_id')
                                        ->get();
        return $medicalrecords;
    }
    public function appointment_patient(Request $rq){
        $patient_id = $rq->get('patient_id');
        $appointment = Appointment::where('patient_id',$patient_id)
                                    ->join('doctor','appointment.doctor_id' , 'doctor.doctor_id')
                                    ->join('speciallist','appointment.speciallist_id' , 'speciallist.speciallist_id')
                                    ->orderBy("time", "desc")
                                    ->paginate(8);
        return $appointment;
    }
    public function patient_medicalrecords(Request $rq){
        $medicalrecords_id = $rq->get('medicalrecords_id');
        $medicalrecords = Medicalrecords::where('medicalrecords_id',$medicalrecords_id)
                                    ->join('doctor','medicalrecords.doctor_id' , 'doctor.doctor_id')
                                    ->join('speciallist','medicalrecords.speciallist_id' , 'speciallist.speciallist_id')
                                    ->join('patient','medicalrecords.patient_id' , 'patient.patient_id')
                                    ->latest()
                                    ->get();
        return $medicalrecords;
    }
    public function appointment_doctor_patient(Request $rq){
        $appointment_id = $rq->get('appointment_id');
        $appointment = Appointment::where('appointment_id',$appointment_id)
                                    ->where('status','0')
                                    ->join('patient','appointment.patient_id' , 'patient.patient_id')
                                    ->get();
        return $appointment;
    }
    public function nurse_information(Request $rq){
        $nurse_id = $rq->get('nurse_id');
        $nurse = Nurse::where('nurse_id',$nurse_id)->get();
        return $nurse;
    }
    public function medicine_information(Request $rq){
        $medicine_id = $rq->get('medicine_id');
        $medicine = Medicine::where('medicine_id',$medicine_id)->get();
        return $medicine;
    }
    public function supplier_information(Request $rq){
        $supplier_id = $rq->get('supplier_id');
        $supplier = Supplier::where('supplier_id',$supplier_id)->get();
        return $supplier;
    }
    public function appointment_advice(Request $rq){
        $appointment_id = $rq->appointment_id;
        $appointment = Appointment::where('appointment_id',$appointment_id)
                                    ->join('doctor','appointment.doctor_id' , 'doctor.doctor_id')
                                    ->join('speciallist','appointment.speciallist_id' , 'speciallist.speciallist_id')
                                    ->get();
        $medicine_id = Appointment::where('appointment_id',$appointment_id)->select('medicine_id')->get();
        $data = preg_match_all('!\d+!', $medicine_id, $matches);
        $medicine_data = Medicine::whereIn('medicine_id',$matches[0])->get();

        return [$appointment, $medicine_data];
    }
//    public function medicine_supplier(Request $rq){
//        $medicine_id = $rq->get('medicine_id');
//        $supplier_id = $rq->get('supplier_id');
//        $array_selection = Medicalrecords::where('medicine_id',$medicine_id)
//                            ->where('supplier_id',$supplier_id)
//                            ->join('supplier','medicalrecord.supplier_id' , 'supplier.supplier_id')
//                            ->join('medicine','medicalrecord.medicine_id' , 'medicine.medicine_id')
//                           ->get();
//        return $array_medicalrecords;
//
//
//    }
//    public function assignment_class_subject(Request $rq){
//        $id_discipline = $rq->get('id_discipline');
//        $id_course = $rq->get('id_course');
//        $array_class = Classs::where('id_discipline',$id_discipline)
//                            ->where('id_course',$id_course)
//                            ->leftJoin('discipline','class.id_discipline' , 'discipline.id')
//                            ->leftJoin('course','class.id_course' , 'course.id')
//                            ->select()
//                            ->getFullName()
//                            ->get();
//
//        return $array_class;
//
//
//    }
    public function listpoint(Request $rq){
        $id_teacher=Session::get('id');
        $id_discipline = $rq->get('id_discipline');
        $id_course = $rq->get('id_course');
        $array_class = Medicalrecords::where('id_discipline',$id_discipline)
                            ->where('id_course',$id_course)
                            ->where('id_teacher',$id_teacher)
                            ->join('discipline','class.id_discipline' , 'discipline.id')
                            ->join('course','class.id_course' , 'course.id')
                            ->join('assignmen','assignmen.id_class','class.id')
                            ->select('class.id','class.name')

                            ->get();

        return $array_class;
        // đây là cái truyền ra sinh viên à


    }
    public function assignment_discipline_subject(Request $rq){
        $id = $rq->get('id');

        $array_subject= Subject::where('id_discipline',$id)->get();

        return $array_subject;
    }
    public function subject_teacher(Request $rq){
        $id = $rq->get('id');
        // $array_subject_teacher= Subject_teacher::join('subject','subject_teacher.id_subject','subject.id')
        //                                     ->where('id_teacher',$id)

        //                                     ->get(['name','id']);
        // $id_teacher=$rq->get('id_teacher');
        $array_subject_teacher=Subject_teacher::where('subject_teacher.id_teacher',$id)
                                            ->where('assignmen.id_teacher',null)
                                            ->join('subject','subject.id','subject_teacher.id_subject')
                                            ->leftJoin('assignmen','assignmen.id_subject','subject.id')
                                            ->select('subject.name','subject.id')
                                            ->get();
        return $array_subject_teacher;
    }
    public function assignment_class(Request $rq){
    	$id = $rq->get('id');
    	$array_class= Classs::where('id_course',$id)->get();

    	return $array_class;


    }
     public function assignment_class_td(Request $rq){
        $id = $rq->get('id');

        $array_class= Classs::where('id_course',$id)->get();

        return $array_class;


    }

    public function listpoint_subject(Request $rq){
        $id_teacher=Session::get('id');
        $id_discipline = $rq->get('id_discipline');
        $array_subject= Subject::where('id_discipline',$id_discipline)
                                    ->where('id_teacher',$id_teacher)
                                    ->join('assignmen','subject.id','assignmen.id_subject')
                                    ->select('subject.name','subject.time','subject.id')
                                    ->distinct()
                                    ->get();
        // $array_subject=Subject::where('id_discipline',$id_discipline)
        //                         ->where('subject_teacher.id_teacher',$id_teacher)
        //                         ->join('discipline','subject.id_discipline','discipline.id')
        //                         ->join('subject_teacher','subject_teacher.id_subject','subject.id')
        //                         ->select('subject.id',
        //                                  'subject.name',
        //                                 )
        //                         ->get();
        return $array_subject;
    }
    public function listpoint_class(Request $rq){
        $id = $rq->get('id');
        $array_class= Classs::where('id_course',$id)->get();

        return $array_class;


    }

    public function listpoint_students(Request $rq){
        $id_class= $rq->get('id_class');
        $id_subject= $rq->get('id_subject');
        $listpoint=Listpoints::where(['id_subject'=>$id_subject ,'id_class'=>$id_class])->get();
        if(count($listpoint)>0)
        {
            $students=Listpoints::selectRaw("students.id,
                concat(students.first_name,' ',students.last_name) as name,
                students.date as birthday,COUNT(status) as dem, if(status=1,'nghi',if(status=2,'muon','di_hoc')) as status")
            ->join('attendancedetails','listpoints.id','=','attendancedetails.id_listpoints')
            ->join('students','students.id','=','attendancedetails.id_students')
            ->groupBy(['status','id_students'])
            ->orderBy('id_students','asc')
            ->where(['listpoints.id_subject'=>$id_subject,'listpoints.id_class'=>$id_class])
            ->get();
            foreach ($students as $key => $value) {
                if($value->status=="muon")
                {
                    if($value->dem==1)
                    {
                        $value->dem=0.3;
                        $value->status="nghi";
                    }
                    elseif($value->dem==2)
                    {
                        $value->dem=0.7;
                        $value->status="nghi";
                    }
                    elseif($value->dem==3)
                    {
                        $value->dem=1;
                        $value->status="nghi";
                    }
                    else{

                        if($value->dem%3==1)
                        {
                            $so_du=0.3;
                        }
                        else{
                            $so_du=0.7;
                        }
                        $value->dem=intdiv($value->dem, 3) + $so_du;
                    }
                }
                elseif($value->status=="di_hoc")
                {
                    $value->status="nghi";
                    $value->dem=0;
                }
            }

            $arr=[];
            $ajax_students=[];
            foreach ($students as $key1 => $value1) {
                if(!in_array($value1->id, $arr)){
                    foreach ($students as $key2 =>$value2) {
                       if($value1->id==$value2->id && $key1!=$key2)
                       {
                            $value1->dem+=$value2->dem;
                            $arr[]=$value1->id;
                       }
                    }
                    $ajax_students[]=$value1;
                }
            }
        }
        else{
            $ajax_students=Students::selectRaw("id,concat(first_name,' ',last_name) as name,
            date as birthday, 0 as dem, 'nghi' as status")->where('id_class',$id_class)->get();
        }
        $subject=Subject::find($id_subject);
        return [$ajax_students,$subject->time];

    }
    public function view_assignment(Request $rq)
    {
        $id_class=$rq->get('id_class');
        // $id_discipline=Classs::where('id',$id_class)->get('id_discipline');

        // $subjects=Subject::where('id_discipline',1)
        //                     ->get();


        // return $subjects;
        // $teachers=Teacher::get();
        // $teachers=Teacher::selectRaw('id, concat(first_name,last_name) as name')->get();
        // dd($teacher,$subjects);
        $array=Assignment::where('id_class',$id_class)
                            ->leftJoin('subject','subject.id','assignmen.id_subject')
                            ->leftJoin('class','class.id','assignmen.id_class')
                            ->Join('teacher','teacher.id','assignmen.id_teacher')
                            ->selectRaw('class.name as lop ,subject.name as mon,concat(teacher.first_name,teacher.last_name) as giaovien')
                            -> get();
       return $array;

       // return [$subjects,$teachers];
    }
    public function history_listpoint(Request $rq)
    {
        $id_class=$rq->get('id_class');
        $array_history=Subject::where('assignmen.id_class',$id_class)
                        ->join('assignmen','assignmen.id_subject','subject.id')
                        ->get();
        return $array_history;
    }
}
