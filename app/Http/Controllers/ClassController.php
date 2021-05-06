<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Discipline;
use DB;
use App\Models\Course;
use App\Models\Classs;
use App\Models\Teacher;
use App\Http\Requests\ClassRequest;
use App\Imports\StudentImportByCourse;
use App\Models\Students;
use Maatwebsite\Excel\Facades\Excel;



class ClassController extends Controller
{
	public function index_class(Request $rq) {
		$search = $rq->search;
		$array_list = Classs::where('name', 'like', "%$search%")->paginate(7);
		return view('class.index_class',[
			'array_list' => $array_list,
			'search' => $search,

		]);
	}

	public function view_insert_class() {
		$courses = Course::get();
		$disciplines = Discipline::get();
		return view('class.view_insert_class', [
			'courses' => $courses,
			'disciplines' => $disciplines,
		]);
	}

	public function view_insert_class_under_student() {
		$courses = Course::get();
		$disciplines = Discipline::get();
		return view('class.view_insert_class_under_student', [
			'courses' => $courses,
			'disciplines' => $disciplines,
		]);
	}

	public function assignment_class_subject() {
		$disciplines=Discipline::get();
		$courses=Course::get();
		$classes=Classs::get();
		return view('class.assignment_class_subject',[
			'classes' => $classes,
			'disciplines' => $disciplines,
			'courses' => $courses,
		]);
	}

	public function process_assignment_class_subject(Request $rq) {
		$id_class=$rq->all();
		// $students=$rq->get('students');
		dd($id_class);

		// DB::update([
		// 		'id_class'=> $id_class,
		// 	]);


		DB::table('students')
		-> sel
		->where('id_class',$id_class)
		->update([
			'id_class'=> $id_class,
		]);
		
		
	}

	public function process_insert_class(ClassRequest $rq) {

		Classs::create($rq->all());

		return redirect()->route('class.index_class');

	}

	public function delete($id)
	{

		Classs::find($id)->delete();
		return redirect()->route('class.show_edit');

	}

	public function show_edit(Request $rq) {
		$search = $rq->search;
		$array_list = Classs::where('name', 'like', "%$search%")->paginate(10);
		return view('class.show_edit',[
			'array_list' => $array_list,
			'search' => $search,

		]);
	}
	public function view_update_class($id){

		$class= Classs::find($id);
		$disciplines = Discipline::all();
		$courses = Course::get();
		return view('class.view_update_class',[
			'courses'=> $courses,
			'class'=> $class,
			'disciplines' => $disciplines,

		]);

	}
	public function process_update_class(ClassRequest $rq,$id){
		$name    = $rq->name;
		
		$id_discipline=$rq->id_discipline;
		$id_course=$rq->id_course;
		DB::table('class')->where('id',$id)->update([
			'name'=> $name,
			
			'id_discipline'=> $id_discipline,
			'id_course' => $id_course,


		]);
	    // SinhVienLop::find($id)->update($rq->all());

		return redirect()->route('class.show_edit');
	}
	public function process_insert_class_under_srudent(Request $rq){
		Excel::import(new StudentImportByCourse, $rq->excel_student_class);
		// $input=$rq->all();
		return redirect()->route('class.index_class');
	}
}
