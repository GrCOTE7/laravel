<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LbcController extends Controller
{
    public function index(){
        return view ('pages.lbc.index');
    }
}
