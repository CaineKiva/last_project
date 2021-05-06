<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendancedetails extends Model
{
    protected $table = 'attendancedetails';
	// protected $primaryKey = ['id_teacher','id_subject'];
	protected $fillable = ['id_students','id_listpoints ','status'];

	public $timestamps = false;
	public function Listpoints()
    {
    	return $this->belongsTo('App\Models\Listpoints', 'id_listpoints');
    }
    
}
