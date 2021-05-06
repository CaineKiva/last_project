<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model {
	protected $table = 'subject';
	protected $primaryKey = 'id';
	protected $fillable = ['name', 'time','status','id_discipline'];
	

	public $timestamps = false;
	
    public function Discipline()
    {
    	return $this->belongsTo('App\Models\Discipline', 'id_discipline');
    }
       public function Teacher()
    {
    	return $this->belongsTo('App\Models\Teacher', 'id_teacher');
    }
    
}
