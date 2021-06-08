<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speciallist;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Supplier;
use App\Models\Medicalrecords;
use App\Models\Appointment;
use Session;
use DB;


class AppointmentController extends Controller
{
	public function process_insert(Request $rq){
        Appointment::create($rq->all()); 
        return redirect()->back();
    }
    public function appointment_list(Request $rq){
    	$speciallist =Speciallist::get();
		$doctor = Doctor::get();
		$patient = Patient::get();
        $search = $rq->search;
    	$array_list = Appointment::where('status','0')
                    ->join('patient','appointment.patient_id','patient.patient_id')->where('last_name','like',"%$search%")->paginate(10);
    	return view('appointment.appointment_list',[
			'speciallist'=> $speciallist, 
			'doctor'=> $doctor,
			'patient'=> $patient,
			'array_list' => $array_list,
            'search'=> $search,
		]);
    }
	public function process_update(Request $rq,$medicalrecords_id){
        Medicalrecords::find($medicalrecords_id)->join('patient','medicalrecords.patient_id' , 'patient.patient_id')->update($rq->except('_token'));
        return redirect()->route('medicalrecords.medicalrecords_index');
    }


}