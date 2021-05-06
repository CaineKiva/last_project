<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Discipline;
use App\Models\Teacher;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\SubjectRequest;

class SubjectController extends Controller {

  public function index_subject(Request $rq) {
        
    $search = $rq->search;
    $array_list = Subject::where('name', 'like', "%$search%")->paginate(10);
    return view('subject.index_subject', [
      'array_list' => $array_list,
      'search' => $search,
           
    ]);
  }
	public function show_subject(Request $rq) {
        
		$search = $rq->search;
		$array_list = Subject::where('name', 'like', "%$search%")->paginate(10);
		return view('subject.show_subject', [
			'array_list' => $array_list,
			'search' => $search,
           
		]);
	}

	public function view_insert_subject() {
		$teachers = Teacher::get();
        $disciplines = Discipline::get();
        return view('subject.view_insert_subject', [
         'teachers' => $teachers,
         'disciplines' => $disciplines,
     ]);
  }
    public function process_insert_subject(SubjectRequest $rq) {

      Subject::create($rq->all());

      return redirect()->route('subject.show_subject');

  }
  public function delete($id)
  {

   Subject::find($id)->delete();
   return redirect()->route('subject.show_subject');

}
public function view_update_subject($id){

   $subject= Subject::find($id);
   $teachers = Teacher::all();
   $disciplines = Discipline::all();
   return view('subject.view_update_subject',[
     'subject'=> $subject,
     'teachers' => $teachers,
     'disciplines' => $disciplines,
    
 ]);

}
public function process_update_subject(Request $rq,$id){
   $name    = $rq->name;
   $time   = $rq->time;
   $id_discipline=$rq->id_discipline;
   $id_teacher=$rq->id_teacher;
  
   DB::table('subject')->where('id',$id)->update([
     'name'=> $name,
     'time'=> $time,
     'id_discipline'=> $id_discipline,
     'id_teacher' => $id_teacher,
   

 ]);
	  

   return redirect()->route('subject.show_subject');
}
}
