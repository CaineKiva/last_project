<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hash;

class Supplier extends Model
{
    protected $table = 'supplier'; // kết nối bảng lớp
    protected $primaryKey = 'supplier_id'; // đổi khóa chính thành id
    protected $fillable = ['supplier_name','address','email','phone'];
    public $timestamps = false;
}
