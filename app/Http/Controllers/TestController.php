<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $maVar = 'Oki';
        return view('pages.test', compact ('maVar'));
    }
}
