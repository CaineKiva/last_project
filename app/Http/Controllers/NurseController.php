<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Nurse;
use App\Imports\NurseImport;
use App\Imports\NursesExcelClassImport;
use Excel;
use DataTables;
use App\Http\Requests\NurseRequest;
use App\Exports\NursesExport; 

class NurseController extends Controller
{
	public function show_nurse(Request $rq){
        $search = $rq->search;
    	$array_list = Nurse::where('last_name','like',"%$search%")->paginate(15);
        return view('nurse.show',[
         'array_list'=> $array_list,
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
    public function process_insert(NurseRequest $rq){
    	
        
        Students::create($rq->all()); 

    	return redirect()->route('nurse.show');

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
    public function process_update(NurseRequest $rq,$nurse_id){
        $name    = $rq->name;
        $date    = $rq->date;
        $address = $rq->address;
        $gender  = $rq->gender;
        $email   = $rq->email;
        $phone   = $rq->phone;
        
        $password = $rq->password;
    	DB::table('students')->where('id',$id)->update([
    		'name'=> $name,
    		'date'=> $date,
    		'address'=> $address,
    		'gender'=> $gender,
            'email' => $email,
            'phone' => $phone,
           
            'password' => $password,
    	]);
        // SinhVienLop::find($id)->update($rq->all());
       
    	return redirect()->route('nurse.show');
    }
}
