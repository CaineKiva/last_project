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
	public function process_update(Request $rq){
        $appointment_id = $rq->appointment_id;
        $time = $rq->time;
        $symptom = $rq->symptom;
        $room = $rq->room;
        $doctor_id = $rq->doctor_id;
        $speciallist_id = $rq->speciallist_id;
        Appointment::where('appointment_id',$appointment_id)->update([
            'time' => $time,
            'symptom' => $symptom,
            'room' => $room,
            'doctor_id' => $doctor_id,
            'speciallist_id' => $speciallist_id,
        ]);
        return redirect()->back();
    }
    public function done(Request $rq,$appointment_id){
        Appointment::where('appointment_id',$appointment_id)->update([
            'status' => '1',
        ]);
        return redirect()->back();
    }


}