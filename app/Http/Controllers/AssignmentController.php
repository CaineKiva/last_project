<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Classs;
use App\Models\Subject;
use App\Models\Discipline;
use App\Models\Teacher;
use App\Models\Assignment;
use DB;


class AssignmentController extends Controller
{
	public function assignment_teacher(){
		$courses =Course::get();
		$disciplines =Discipline::get();
		$classs=Classs::get();
		$subjects=Subject::get();
		$teachers=Teacher::get();
		
		return view('assignment.assignment_teacher',[
			'courses'=> $courses, 
			'disciplines'=> $disciplines,
			'classs'=> $classs,
			'subjects' => $subjects,
			'teachers' => $teachers
		]);
	}
	public function show(){
		
		$array_list = Assignment::get();
		return view('assignment.show',[
			'array_list' => $array_list,
			

		]);

	}
	public function process_assignment_teacher(Request $rq){
		$input = $rq -> all();
		
		// dd($input);
		Assignment::create($input);	

    	return redirect()->route('assignment.view_assignment_teacher');

	}
	
	public function assignment_class(){
		$courses =Course::get();
		$classs=Classs::get();
		$subjects=Subject::get();
		$teachers=Teacher::get();

		return view('assignment.assigment_class',[
			'courses'=> $courses,
			'classs'=> $classs,
			'subjects' => $subjects,
			'teachers' => $teachers
		]);
		
	}
	
	public function view_assignment_teacher()
	{
		$array_classes=Classs::get();
		$array_disciplines=Discipline::get();
		return view('assignment.view_assignment_teacher',[
				'array_classes'=> $array_classes,
				'array_disciplines'=> $array_disciplines,

			]);
	}


}
