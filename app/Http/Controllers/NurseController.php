<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Nurse;
use App\Models\Competence;
use App\Imports\NurseImport;
use App\Imports\NursesExcelClassImport;
use Excel;
use DataTables;
use App\Http\Requests\NurseRequest;
use App\Exports\NursesExport; 

class NurseController extends Controller
{
	public function nurse_index(Request $rq){
        $search = $rq->search;
        $competence = Competence::all();
    	$array_list = Nurse::where('last_name','like',"%$search%")->paginate(20);
        return view('nurse.index',[
         'array_list'=> $array_list,
         'competence'=> $competence,
         'search'=> $search
        ]);

    }
    public function view_all(Request $rq) {


        if ($rq->ajax()) {
            $nurse = Nurse::get();
            return DataTables::of($nurse)
                ->addIndexColumn()
                ->addColumn('action', function ($nurse) {
                    return
                        '<button type="button" class="edit btn btn-primary btn-sm">
                        <a href="" style="color:#fff; text-decoration: none;">
                        <i class="fas fa-cogs text-dark-pastel-blue"></i>Edit</a></button>
                        <button type="button" name="delete" id="" class="delete btn btn-danger btn-sm"><i class="fas fa-times text-orange-white"></i>Delete</button>
                        <button type="button" class="btn btn-xs btn-info btn-sm"><i class="fas fa-redo-alt text-orange-white"></i>Hoàn tác</button>
                        ';
                        // '<button type="button" class="edit btn btn-primary btn-sm">
                        // <a href="' . route('students.view_update', $student->id) . '" style="color:#fff; text-decoration: none;">
                        // <i class="fas fa-cogs text-dark-pastel-blue"></i>Edit</a></button>
                        // <button type="button" name="delete" id="' . $student->id . '" class="delete btn btn-danger btn-sm"><i class="fas fa-times text-orange-white"></i>Delete</button>
                        // <button type="button" class="btn btn-xs btn-info btn-sm"><i class="fas fa-redo-alt text-orange-white"></i>Hoàn tác</button>
                        // ';
                })
                ->rawColumns(['action'])
                ->make(true);
       }
       return view('datatable.datatable');




    }
    public function export_excel(){
        return Excel::download(new NurseExport,'nurse.xlxs');
    }
    public function view_insert(){
    	return view('nurse.view_insert');
    }
    public function process_insert(Request $rq){
        Nurse::create($rq->all()); 
    	return redirect()->back();
    }
    public function view_insert_excel(){
        return view('nurse.view_insert_excel');
    }
    public function process_insert_excel(Request $rq){
          Excel::import(new NurseImport, $rq->file('excel_nurse')->path());
          return redirect()->route('nurse.show');

    }
    public function delete($nurse_id)
    {


        Nurse::find($nurse_id)->delete();
    	return redirect()->route('nurse.show');

    }
    public function view_update($nurse_id){
    	
        $nurse= Nurse::find($nurse_id);
    	return view('nurse.view_update',[
    		'nurse'=> $nurse,
    	]);

    }
    public function process_update(Request $rq){
        $nurse_id = $rq->get('nurse_id');
        $first_name = $rq->first_name;
        $last_name = $rq->last_name;
        $birthday = $rq->birthday;
        $competence_id = $rq->competence_id;
        $address = $rq->address;
        $gender = $rq->gender;
        $email = $rq->email;
        $phone = $rq->phone;
        Nurse::where('nurse_id',$nurse_id)->update([
            'first_name'=> $first_name,
            'last_name'=> $last_name,
            'birthday'=> $birthday,
            'address'=> $address,
            'competence_id' => $competence_id,
            'gender'=> $gender,
            'email' => $email,
            'phone' => $phone,
        ]);
        return redirect()->back();
    }
}
