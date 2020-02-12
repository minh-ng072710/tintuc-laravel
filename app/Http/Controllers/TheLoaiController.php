<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TheLoaiController extends Controller
{
   public function TinhTich($a,$b){
       return $a*$b;
   }
}
