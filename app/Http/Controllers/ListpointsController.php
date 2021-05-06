<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Students;
use App\Models\Discipline;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Classs;
use App\Models\Listpoints;
use App\Models\Attendancedetails;

use Session;
use DB;

class ListpointsController extends Controller
{
    public function view_listpoints(){
    	$id_teacher=Session::get('id');
    	
		$courses=Course::get();
		$disciplines=Discipline::get();
		$classs=Classs::get();
		$subjects=Subject::get();
		$teachers=Teacher::get();

		return view('listpoints.view_listpoints',[
			'courses'=> $courses,
			'disciplines'=> $disciplines,
			'classs'=> $classs,
			'subjects' => $subjects,
			'teachers' => $teachers,
			'id_teacher' => $id_teacher,
		]);
	}
	// public function view_listpoints_history(){
 //    	$id_teacher=Session::get('id');
    	
	// 	$courses=Course::get();
	// 	$disciplines=Discipline::get();
	// 	$classs=Classs::get();
	// 	$subjects=Subject::get();
	// 	$teachers=Teacher::get();

	// 	return view('listpoints.view_listpoints_history',[
	// 		'courses'=> $courses,
	// 		'disciplines'=> $disciplines,
	// 		'classs'=> $classs,
	// 		'subjects' => $subjects,
	// 		'teachers' => $teachers,
	// 		'id_teacher' => $id_teacher,
	// 	]);
	// }

	// public function process_listpoint(Request $rq){
	// 	$data= json_decode($rq->data,true);
	// 	dd($data);
		
	// 	// $value=$rq->get('value');
	// 	// dd($value);
	// 	$array_list_listpont=$rq->all();

	// 	$id_class=$rq->get('id_class');
	// 	$array_list_students=Students::where('id_class',$id_class)
	// 							->join('class','class.id','students.id_class')
	// 							->select('students.id')
	// 							->get();
		

	// 	// foreach ($array_list_students as $array_list_listpont) {
	// 	// 	$array[$listpoint->$array_list_listpont]=$listpoint -> 

	// 	// 	$listpoint=Listpoints::
	// 	// }


	// }
	public function  process_post(Request $rq){
		// return $rq->all();
		$id_teacher=Session::get('id');
		$id_subject=$rq->get('id_subject');
		$id_class=$rq->get('id_class');
	
		$listpoint=Listpoints::create([
			'id_teacher'=>$id_teacher,
			'id_subject'=>$id_subject,
			'id_class'=>$id_class,
		]);
		
		foreach ($rq->except('_token','id_subject','id_class','id') as $id_student => $status) {			$a=DB::table('attendancedetails')->insert([
				'id_students'=>$id_student,
				'id_listpoints'=>$listpoint->id,
				'status'=>$status
			]);
		}
		return redirect()->route('listpoints.view_listpoints')->with('thongbao','Điểm danh thành công ');
		// return view('listpoints.view_listpoints_history');
	}
	public function history()
	{
		$classes=Classs::get();
		$subjects=Subject::get();
		return view('listpoints.history',[
			'classes'=>$classes,
			'subjects'=>$subjects,
		]);
	}
	public function process_history(Request $rq)
	{
		// $array_history=Attendancedetails::selectRaw("
		// 	if(status=1,'nghi',IF(status=2,'muon','di hoc')) as trang_thai,
		// 	attendancedetails.id_listpoints,
		// 	attendancedetails.id_students,
		// 	attendancedetails.status,
		// 	listpoints.id_class,
		// 	listpoints.id_teacher,
		// 	listpoints.id_subject
		// 	")
		// 	->where('listpoints.id_subject',$id_subject)
		// 	->where('listpoints.id_class',$id_class)
		// 	->join('listpoints','listpoints.id','attendancedetails.id_listpoints')

		// 	->get();
		// return view('listpoints.view_history_listpoint',[ 
		// 		'array_history'=> $array_history,
		// ]);
		
		$input=$rq->all();
		$id_teacher=Session::get('id');
		$id_class=$rq->get('id_class');
		$id_subject=$rq->get('id_subject');

		$id_listpoints=Listpoints::where('listpoints.id_teacher',$id_teacher)
								->where('listpoints.id_class',$id_class)
								->selectRaw('id')
								->orderBy('listpoints.id','desc')
								->first();
		// return $id_listpoints;
		$array=Attendancedetails::selectRaw("concat(students.first_name,' ',students.last_name) as sinhvien, attendancedetails.status, students.id as name")

							  ->join('listpoints','attendancedetails.id_listpoints','listpoints.id')
							  ->join('students','students.id','attendancedetails.id_students')
							  ->where('listpoints.id_class',$id_class)
							  ->where('listpoints.id_subject',$id_subject)
							  ->where('attendancedetails.id_listpoints',$id_listpoints->id)
							  ->get();
		
		// return $array;
		return view('listpoints.view_history_listpoint',[
				'array'=>$array,

		]);
	}
}
