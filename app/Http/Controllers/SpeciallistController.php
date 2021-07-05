<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Speciallist;
use App\Models\Competence;
use App\Models\Doctor;
use App\Models\Medicalrecords;
use App\Models\Patient;
// use App\Http\Requests\DisciplineRequest;

class SpeciallistController extends Controller
{
    public function index_list(Request $rq){
        $search = $rq->search;
        $array_list = Speciallist::where('speciallist_name','like',"%$search%")->paginate(10);
        return view('speciallist.index_list',[
            'array_list'=> $array_list,
            'search'=> $search
        ]);
    }
    public function doctor_list(Request $rq,$speciallist_id){
        $competence = Competence::get();
        $speciallist = Speciallist::find($speciallist_id);
        $search = $rq->search;
    	$array_list = Doctor::where('speciallist_id',$speciallist_id)->where('last_name','like',"%$search%")->paginate(10);
        return view('speciallist.doctor_list',[
            'competence' => $competence,
            'speciallist' => $speciallist,
            'array_list'=> $array_list,
            'search'=> $search,
        ]);
    }
    public function patient_list(Request $rq,$speciallist_id){
        $doctor = Doctor::get();
        $patient = Patient::get();
        $search = $rq->search;
        $speciallist = Speciallist::find($speciallist_id);
        $array_list = Medicalrecords::where('speciallist_id',$speciallist_id)
                                        ->join('patient','medicalrecords.patient_id','patient.patient_id')
                                        // ->join('doctor','medicalrecords.doctor_id','doctor.doctor_id')
                                        ->where('patient.last_name','like',"%$search%")
                                        ->paginate(10);
        return view('speciallist.patient_list',[
            'patient' => $patient,
            'doctor' => $doctor,
            'speciallist' => $speciallist,
            'array_list'=> $array_list,
            'search' => $search,
        ]);
    }
    public function view_insert(){
    	return view('speciallist.insert');
    }
    public function process_insert(DisciplineRequest $rq){
    	Speciallist::create($rq->all()); 
        return redirect()->route('speciallist.index_list');

    }
    public function delete($speciallist_id)
    {
        Speciallist::find($id)->delete();
    	return redirect()->route('speciallist.show_speciallist');
    }
    public function view_update($speciallist_id){
        $speciallist= Speciallist::find($id);
    	return view('speciallist.edit',[
    		'speciallist'=> $speciallist,
    	]);

    }
    public function process_update_speciallist(speciallistRequest $rq,$speciallist_id){
        $name    = $rq->name;
        $name_collapse = $rq->name_collapse;
        DB::table('speciallist')->where('id',$id)->update([
    		'name'=> $name,
            'name_collapse'=> $name_collapse,
    	]);
        // SinhVienLop::find($id)->update($rq->all());
       
    	return redirect()->route('speciallist.index_list');
    }
}
