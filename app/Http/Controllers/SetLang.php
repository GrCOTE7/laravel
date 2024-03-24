<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLang extends Controller
{
    public function setLang(Request $request)
{
    App::setLocale($request->lang);
    return back();
}
}
