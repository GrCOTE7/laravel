<?php

namespace App\Http\Controllers;

class ImportController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data = $this->import();

		// return $data;

		return view('pages.import', compact('data'));
	}

	public function import()
	{
		// // $jsonData = file_get_contents('./../storage/app/exports/uuuleboncoin.fr.xlsx.json');
		$jsonData = file_get_contents('./../storage/app/exports/231204-17_sjdl20.json');
		$jsonData = file_get_contents('./../storage/app/exports/fullleboncoin.fr.json');
		$jsonData = file_get_contents('./../storage/app/exports/sjdl20s.json');
		$jsonData = file_get_contents('./../storage/app/exports/231201_sjdl20.json');
		$jsonData = preg_replace('/ /', '&nbsp;', $jsonData);
		$datas    = json_decode($jsonData, true);

		if (null === $datas) {
			exit('Erreur lors de la conversion JSON');
		}

		$line     = '';
		$maxAddId = 0;
		$addIds   = [];
		$addKeys  = [];

		$manager = new importManagerController();
		$manager->initDateProcess();


		foreach ($datas as $k => $data) {
			$addKey = array_keys($data);
			// echo 'ooooooooooooo: ' . $k . ' → ' . $addKey[3] . '<br>';

			$data = array_values($data);

			$addId = substr($data[1], 46, 9); // 'Lien_du_titre'

			if (!in_array($addId, $addIds)) {
				$addIds[]        = $add[$k]['addId'] = $addId;
				$add[$k]['date'] = $manager->dateConversion($data[15]); // 'Date de publication'
				$add[$k]['link'] = $data[1]; // 'Lien_du_titre'
				$add[$k]['id']   = $k;

				$add[$k]['title']   = $data[7]; // Titre
				$add[$k]['pieces']  = $data[11];
				$add[$k]['surface'] = $data[12]; // champ2
				$add[$k]['price']   = $data[14]; // champ4

				// $add[$k]['ownerOri'] = $data[8]; // champ4
				$add[$k]['owner'] = $manager->getNewOwner($data[8]); // champ4
				$maxAddId         = max($maxAddId, $add[$k]['addId']);
			}
		}
		// echo $maxAddId;

		sort($add);

		// echo count($add);

		// echo '<pre>';
		// var_dump($add);
		// echo '</pre>';

		$precAddId = '';

		$newAddIds = [];
		foreach ($add as $i => $a) {
			$color = 'none';

			// if ($a['addId'] == $precAddId) {
			if (in_array($a['addId'], $newAddIds)) {
				$color = 'orange';
			}
			$newAddIds[] = $a['addId'];

			$line .= '<tr">
                <td style="text-align: right; font-weight: bold; background-color: ' . $color . '"><a href=' . $a['link'] . ' target="_blank">' . ($a['id']) . '</a></td>
                <td>' . $a['date'] . '</td>
		        <td>' . $a['addId'] . '</td>

		        <td>' . $a['title'] . '</td>
		        <td>' . $a['pieces'] . '</td>
		        <td>' . $a['surface'] . '</td>
		        <td>' . $a['price'] . '</td>

		        <td>' . $a['owner'] . '</td>
		        </tr>';
			// <td>' . $a['ownerOri'] . '</td>
			$precAddId = $a['addId'];
		}

		// for ($i = 0; $i <= $maxAddId; ++$i) {
		// 	if ($i == $add[$k]['addId']) {
		// 		$line .= '<tr>
		//         <td><a href=' . $add[$i]['link'] . ' target="_blank">' . ($i) . '</a></td>
		//         <td>' . $add[$k]['addId'] . '</td>
		//         <td>' . $add['Titre1'] . '</td>
		//         <td>' . $add['champ2'] . '</td>
		//         <td>' . $add['champ4'] . '</td>
		//         </tr>';
		// 	}
		// }

		$head = '<tr>
        <td style="text-align: center">Lien</td>
        <td style="text-align: center">Date</td>
        <td style="text-align: center">Id</td>
        <td style="text-align: center">Titre</td>
        <td style="text-align: center">Pièces</td>
        <td style="text-align: center">Surface</td>
        <td style="text-align: center">Prix</td>
        <td style="text-align: center">Proprio</td>
        </tr>';
		// <td style="text-align: center">ProprioOri</td>

		return count($add) . ' annonces<table class="table table-sm table-bordered table-rounded">' . $head . $line . '</table>';
		// $ch = 'https://www.leboncoin.fr/ventes_immobilieres/2452806946.htm';
		// $ch = substr($ch, 50, 5);
	}
}
