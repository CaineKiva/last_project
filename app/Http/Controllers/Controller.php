<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;



class Controller{
	
	public function master()
	{
		return view('layouts.master');
	}
	public function index()
	{
		return view('index');

	}


}
// $all=Students::join('attendancedetails','students.id','attendancedetails.id_students')
// 				->get()
// 				->count('status');
// 		$dihoc=Students::where('status',0)
// 				->join('attendancedetails','students.id','attendancedetails.id_students')
// 				->get()
// 				->count();
// 		$nghihoc=Students::where('status',1)
// 				->join('attendancedetails','students.id','attendancedetails.id_students')
// 				->get()
// 				->count();
// 		$muonhoc=Students::where('status',2)
// 				->join('attendancedetails','students.id','attendancedetails.id_students')
// 				->get()
// 				->count();
// 		// $dihoc_phantram=$dihoc/$all*100;
// 		// $nghihoc_phantram=$nghihoc/$all*100;
// 		// // $muonhoc_phantram=100-$dihoc_phantram-$nghihoc_phantram-1;
// 		//  $muonhoc_phantram=$muonhoc/$all*100;
// 		return view('index',[
// 			'dihoc'=> $dihoc,
// 			'nghihoc'=> $nghihoc,
// 			'muonhoc'=> $muonhoc,
// 			'all'=> $all,
// 			// 'dihoc_phantram'=> $dihoc_phantram,
// 			// 'nghihoc_phantram'=> $nghihoc_phantram,
// 			// 'muonhoc_phantram'=> $muonhoc_phantram,


// 		]);
