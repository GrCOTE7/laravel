<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutoSilloController extends Controller
{
    public function index(){
        return view('pages.tuto.w');
    }
    public function welcome(){
        return view('welcome');
    }
    public function article($n){
        return view('pages.tuto.article')->withNumero($n);
    }
}
