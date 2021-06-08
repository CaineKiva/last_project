<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speciallist;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Medicine;
use App\Models\Supplier;
use App\Models\Medicalrecords;
use Session;
use DB;

class FrontendController extends Controller
{
    public function layout(){
    	$patient = Patient::get();
    	$speciallist = Speciallist::get();
		$doctor = Doctor::get();
        return view('frontend.master',[
			'speciallist' => $speciallist, 
			'doctor' => $doctor,
			'patient' => $patient,
		]);
    }

    public function service_select(){
		$speciallist = Speciallist::get();
		$doctor = Doctor::get();
		return view('frontend.service',[
			'speciallist'=> $speciallist, 
			'doctor'=> $doctor,
		]);
	}
}
