<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ImportSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$locations = [
			[39000, 'Dôle'], [21170, 'Losne'], [21170, 'Saint Jean-de-Losne'], [21170, 'Saint-Usage'],
		];

		echo "\nLocations table:\n";
		foreach ($locations as $k => $location) {
			$sql[] = [
				'cp'         => $location[0],
				'name'       => $location[1],
				'slug'       => Str::slug($location[1]),
				'sort_order' => $k + 1,
			];
			echo "\n" . $location[0] . ' - ' . $location[1];
		}
		echo "\n";

		Location::insert($sql);
	}
}
