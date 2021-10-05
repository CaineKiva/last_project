<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Medicine;
use Session;
use DB;


class MedicineController extends Controller
{
    public function process_insert(Request $rq){
        Medicine::create($rq->all());
        return redirect()->back();
    }
    public function process_update(Request $rq){
        $medicine_id = $rq->get('medicine_id');
        $supplier_id = $rq->supplier_id;
        $medicine_name = $rq->medicine_name;
        $price = $rq->price;
        $using = $rq->using;
        $status = $rq->status;
        $quantity = $rq->quantity;

        Medicine::where('medicine_id',$medicine_id)->update([
            'supplier_id'=> $supplier_id,
            'medicine_name' => $medicine_name,
            'price'=> $price,
            'using'=> $using,
            'status'=> $status,
            'quantity' => $quantity,
        ]);
        return redirect()->back();
    }
}
