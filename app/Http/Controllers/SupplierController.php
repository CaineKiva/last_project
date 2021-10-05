<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Medicine;
use Session;
use DB;


class SupplierController extends Controller
{
    public function supplier_list(Request $rq){
        $search = $rq->search;
        $array_list = Supplier::where('supplier_name','like',"%$search%")->paginate(10);
        return view('supplier.supplier_list',[
            'array_list'=> $array_list,
            'search'=> $search
        ]);
    }
    public function medicine_list(Request $rq,$supplier_id){
        $search = $rq->search;
        $supplier =Supplier::find($supplier_id);
        $array_list = Medicine::where('medicine_name','like',"%$search%")->where('supplier_id',$supplier_id)->paginate(10);
        return view('supplier.medicine_list',[
            'array_list'=> $array_list,
            'search'=> $search,
            'supplier' => $supplier
        ]);
    }
    public function process_insert(Request $rq){
        Supplier::create($rq->all());
        return redirect()->back();
    }
    public function process_update(Request $rq){
        $supplier_id = $rq->supplier_id;
        $supplier_name = $rq->supplier_name;
        $address = $rq->address;
        $email = $rq->email;
        $phone = $rq->phone;
        Supplier::where('supplier_id',$supplier_id)->update([
            'supplier_name'=> $supplier_name,
            'address'=> $address,
            'email' => $email,
            'phone' => $phone,
        ]);
        return redirect()->back();
    }
}
