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
        $doctor_id = $rq->doctor_id;
        $start_time = (int)strtotime( date('Y-m-d H:i:s',strtotime($rq->time)) );
        $allData = Appointment::where('doctor_id',$doctor_id)->get();
        $arrayData = array();
        foreach ($allData as $data) {
            $startTime = (int)strtotime( date('Y-m-d H:i:s',strtotime('-30 minutes',strtotime($data['time']))) );
            $endTime = (int)strtotime( date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($data['time']))) );
            // đếm xem có cái time có rơi vào khoảng nào không, nếu có thì tích số 1 vào mảng, không thì đánh số 0
            if ( $start_time <= $endTime && $start_time >= $startTime ) {
                $arrayData[] = 1;
            }
            else {
                $arrayData[] = 0;
            }
        }
        //kiểm tra xem trong mảng có số 1 không, nếu có thì thất bại
        if (in_array('1', $arrayData)) {
            return redirect()->route('login');
        } 
        else {
            return redirect()->back();
        }
    }
    public function appointment_list(Request $rq){
    	$speciallist = Speciallist::get();
		$patient = Patient::get();
        $search = $rq->search;
    	$array_list = Appointment::where('status','0')
                                ->join('patient','patient.patient_id','appointment.patient_id')
                                ->where('patient.last_name','like',"%$search%")
                                ->orderBy("time", "desc")
                                ->paginate(10);
    	return view('appointment.appointment_list',[
			'speciallist'=> $speciallist, 
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
    public function massDone(Request $rq){
        $id = $rq->id;
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