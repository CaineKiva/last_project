<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model {
	protected $table = 'medicine';
	protected $primaryKey = 'medicine_id';
	protected $fillable = ['medicine_name', 'using','price','status','supplier_id'];
	public $timestamps = false;
	public function Supplier()
    {
    	return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }
}
