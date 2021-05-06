<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speciallist;
use App\Models\Competence;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Supplier;
use App\Models\Medicalrecords;
use Session;
use DB;
// use App\Models\Patient;
use App\Imports\DoctorImport;
use Excel;
use App\Http\Requests\DoctorRequest;

class DoctorController extends Controller
{
    public function doctor_index(Request $rq){
        $competence = Competence::all();
        $speciallist = Speciallist::all();
        $search = $rq->search;
        $array_list = Doctor::where('last_name','like',"%$search%")->paginate(10);
        return view('doctor.index',[
         'array_list'=> $array_list,
         'search'=> $search,
         'competence'=> $competence,
         'speciallist'=> $speciallist,
        ]);

    }
    // public function subject_Doctor(){
    //     $subjects= Subject::get();
    //     $subject_Doctor= Subject_Doctor::get();
    //     return view('Doctor.Doctor_subject',[
    //         'subject_Doctor'=> $subject_Doctor,
    //         'subjects'=> $subjects,
    //     ]);
    // }
    public function view_insert(){
    	return view('doctor.insert');
    }
    public function process_insert(DoctorRequest $rq){
    	Doctor::create($rq->all()); 
        return redirect()->route('doctor.doctor_index');
    }
    public function view_insert_excel(){
        return view('doctor.view_insert_excel');
    }
    public function process_insert_excel(DoctorRequest $rq){
        Excel::import(new DoctorImport, $rq->file('excel_doctor')->path());
        return redirect()->route('doctor.show');
    }
    public function delete($doctor_id){
        Doctor::find($doctor_id)->delete();
    	return redirect()->route('doctor.doctor_index');

    }
    public function view_update($doctor_id){
        $doctor= Doctor::find($doctor_id);
    	return view('doctor.edit',[
    		'doctor'=> $doctor,
    	]);
    }
    public function process_update(DoctorRequest $rq,$doctor_id){
        $first_name    = $rq->first_name;
        $last_name    = $rq->last_name;
        $date    = $rq->date;
        $address = $rq->address;
        $gender  = $rq->gender;
        $email   = $rq->email;
        $phone   = $rq->phone;
        
        $password = $rq->password;
    	DB::table('Doctor')->where('doctor_id',$doctor_id)->update([
    		'first_name'=> $first_name,
            'last_name'=> $last_name,
    		'date'=> $date,
    		'address'=> $address,
    		'gender'=> $gender,
            'email' => $email,
            'phone' => $phone,
           
            'password' => $password,
    	]);
        // SinhVienLop::find($id)->update($rq->all());
       
    	return redirect()->route('doctor.show');
    }
    public function view_list(){
        $speciallist =Speciallist::get();
        $doctor = Doctor::get();
        $patient = Patient::get();
        $medicine = Medicine::get();
        $array_list = Medicalrecords::where('doctor_id',Session::get('doctor_id'))->latest()->get();
        return view('doctor.view_list',[
            'speciallist'=> $speciallist, 
            'doctor'=> $doctor,
            'patient'=> $patient,
            'medicine' => $medicine,
            'array_list' => $array_list,
        ]);
    }

    // public function assignment_subject_Doctor(){
    //     $subjects= Subject::get();

    //     $Doctors= Doctor::all();
       
    //     return view('Doctor.assignment_subject_Doctor',[
    //      'subjects'=> $subjects,
    //      'Doctors'=> $Doctors
    //     ]);
    // }
    // public function process_assignment_subject_Doctor(Request $rq){

       
    //     $input = $rq -> all();
    //     $id_Doctor = $rq -> get('id_Doctor');
       
    //     Subject_Doctor::where('id_Doctor',$id_Doctor)->delete();
    //     foreach ($rq->check as $id_subject) {
        

    //          Subject_Doctor::insert([
    //             'id_Doctor' => $rq->id_Doctor,
    //             'id_subject' => $id_subject,
    //          ]);
    //     }
    //     return redirect()->route('Doctor.subject_Doctor');
    // }   
}
        
       
