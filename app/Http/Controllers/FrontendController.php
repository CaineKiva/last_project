<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController 
{
    public function layout(){
        return view('frontend.master');
    }
}
