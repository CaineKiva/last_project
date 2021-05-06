<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;


use App\Models\Students;
use Yajra\DataTables\DataTables;

class DatatableController extends Controller
{


/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function getIndex()
{
    return view('datatable.datatable');
}

// *
// * Display a listing of the resource.
// *
// * @return \Illuminate\Http\Response

public function anyData()
{
 $users = Students::select([
    'id', 
    'first_name',
    'last_name',
    'date',
    'address',
    'phone', 
    'email', 
    'gender'
])
 ->get();

 return Datatables::of($users)->make();
}




}