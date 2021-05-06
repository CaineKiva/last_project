<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Competence;
use App\Http\Requests\CompetenceRequest;

class CompetenceController extends Controller
{
    public function index_competence(Request $rq){
        $search = $rq->search;
        $array_list = Competence::where('name','like',"%$search%")->paginate(10);
        return view('competence.index_competence',[
         'array_list'=> $array_list,
         'search'=> $search
        ]);

    }
    public function show_competence(Request $rq){
        $search = $rq->search;
    	$array_list = Competence::where('name','like',"%$search%")->paginate(10);
        return view('competence.show_competence',[
         'array_list'=> $array_list,
         'search'=> $search
        ]);

    }
    public function view_insert_competence(){
    	return view('competence.insert');
    }
    public function process_insert_competence(CompetenceRequest $rq){
    	
        
        Competence::create($rq->all()); 

    	return redirect()->route('competence.show_competence');

    }
    public function delete($id)
    {


        Competence::find($id)->delete();
    	return redirect()->route('competence.show_competence');

    }
    public function view_update_competence($id){
    	
        $competence= Competence::find($id);
    	return view('competence.edit',[
    		'competence'=> $competence,
    	]);

    }
    public function process_update_competence(CompetenceRequest $rq,$id){
        $competence_name= $rq->competence_name;
        DB::table('competence')->where('id',$id)->update([
            'competence_name'=> $competence_name,
    	]);
        // SinhVienLop::find($id)->update($rq->all());
       
    	return redirect()->route('competence.show_competence');
    }
}
