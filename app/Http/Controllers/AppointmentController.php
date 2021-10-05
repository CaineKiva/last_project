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
use function GuzzleHttp\Psr7\str;


class AppointmentController extends Controller
{
	public function process_insert(Request $rq){
        $patient_id = $rq->get('patient_id');
        $doctor_id = $rq->get('doctor_id');
        $speciallist_id = $rq->get('speciallist_id');
        $time = $rq->get('time');
        $symptom = $rq->get('symptom');
        Appointment::create([
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
            'speciallist_id' => $speciallist_id,
            'time' => $time,
            'symptom' => $symptom,
            'status' => '0',
        ]);
        return redirect()->back();
    }
    public function appointment_list(Request $rq){
    	$speciallist = Speciallist::get();
        $doctor = Doctor::get();
		$patient = Patient::get();
        $search = $rq->search;
    	$array_list = Appointment::where('status','0')
                                ->join('patient','patient.patient_id','appointment.patient_id')
                                ->where('patient.last_name','like',"%$search%")
                                ->orderBy("status", "desc")
                                ->orderBy("time", "desc")
                                ->paginate(10);
    	return view('appointment.appointment_list',[
			'speciallist'=> $speciallist,
            'doctor' => $doctor,
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
    public function done(Request $rq){
        $advice = $rq->advice;
        $appointment_id = $rq->appointment_id;
        $medicine_data = $rq->medicine_data;
        $medicine_id = implode(' ', $medicine_data);
        Appointment::where('appointment_id',$appointment_id)->update([
            'status' => '1',
            'advice' => $advice,
            'medicine_id' => $medicine_id,
        ]);
        return redirect()->back();
    }
    public function massDone(Request $rq){
        $id = $rq->id;
        dump($id);
        die();
        if(!empty($id)){
            foreach ($id as $appointment_id)
            {
                Appointment::where('appointment_id', $appointment_id)->update([
                    'status' => '1'
                ]);
            }
        }
        return redirect()->back();
    }
    public function massRoom(Request $rq){
        $id = $rq->id;
        $room = $rq->setup_room;
        if(!empty($id)){
            foreach ($id as $appointment_id)
            {
                Appointment::where('appointment_id', $appointment_id)->update([
                    'room' => $room,
                    'status' => '0'
                ]);
            }
        }
        return redirect()->back();
    }

}
