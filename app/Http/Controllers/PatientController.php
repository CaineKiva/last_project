<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Patient;
use App\Models\Speciallist;
use App\Imports\PatientImport;
use Excel;
use App\Http\Requests\PatientRequest;

class PatientController extends Controller
{
    public function patient_index(Request $rq){
        $search = $rq->search;
        $speciallist = Speciallist::get();
        $array_list = Patient::where('last_name','like',"%$search%")->paginate(5);
        return view('patient.index',[
         'array_list' => $array_list,
         'speciallist' => $speciallist,
         'search'=> $search
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
    	return view('patient.insert');
    }
    public function process_insert(Request $rq){
    	Patient::create($rq->all()); 
        return redirect()->back();
    }
    public function view_insert_excel(){
        return view('patient.view_insert_excel');
    }
    public function process_insert_excel(PatientRequest $rq){
          Excel::import(new PatientImport, $rq->file('excel_patient')->path());
          return redirect()->route('patient.show');
    }
    public function delete($patient_id){
        Patient::find($patient_id)->delete();
    	return redirect()->route('patient.patient_index');

    }
    public function view_update($patient_id){
    	
        $patient= Doctor::find($patient_id);
    	return view('patient.edit',[
    		'patient'=> $patient,
    	]);

    }
    public function process_update(PatientRequest $rq,$doctor_id){
        $first_name    = $rq->first_name;
        $last_name    = $rq->last_name;
        $birthday    = $rq->birthday;
        $address = $rq->address;
        $gender  = $rq->gender;
        $email   = $rq->email;
        $contact_phone   = $rq->contact_phone;
        
        $password = $rq->password;
    	DB::table('Patient')->where('patient_id',$patient_id)->update([
    		'first_name'=> $first_name,
            'last_name'=> $last_name,
    		'birthday'=> $birthday,
    		'address'=> $address,
    		'gender'=> $gender,
            'email' => $email,
            'phone' => $phone,
           
            'contact_password' => $contact_password,
    	]);
        // SinhVienLop::find($id)->update($rq->all());
       
    	return redirect()->route('patient.show');
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