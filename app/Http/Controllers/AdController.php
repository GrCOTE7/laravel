<?php

namespace App\Http\Controllers;

use App\Http\classes\AdImport;

class AdController extends Controller
{
	public $ad;

	private $_adJson;

	public function __construct()
	{
		ini_set('max_execution_time', '0');
	}

	public function index()
	{
        // $o = new \stdClass();
        // $o->property1 = 'Value1';
        // $o->property2 = 'Value2';

		// return $o;
		return (new AdImport())->index();
	}
}
