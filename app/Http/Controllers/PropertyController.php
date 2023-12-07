<?php

namespace App\Http\Controllers;

use App\Http\Tools\Gc7;

class PropertyController extends Controller
{
	public $property_location;

	public $ad_published_at;

	public $ad_title;

	public $ad_link;

	public $property_price;

	public $property_number_of_pieces;

	public $property_number_of_bedrooms;

	public $property_building_surface;

	public $property_ground_surface;

	public $property_number_of_levels;

	public $property_description;

	public function index()
	{
		return $this->description();
	}

	private function description()
	{
        Gc7::aff($this);
		// return $this;
	}
}
