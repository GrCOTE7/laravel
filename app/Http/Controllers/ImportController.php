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

		return view('pages.import', compact('data'));
	}

	protected function import()
	{
		// Lire le contenu du fichier JSON
		// $jsonData = file_get_contents('./../storage/app/exports/2331129leboncoin.fr.json');
		$jsonData = file_get_contents('./../storage/app/exports/sjdl20.json');

		$jsonData = preg_replace('/ /', '&nbsp;', $jsonData);
		// Décoder le JSON en tableau PHP associatif
		$datas = json_decode($jsonData, true);

		// Vérifier si la conversion JSON a réussi
		if (null === $datas) {
			exit('Erreur lors de la conversion JSON');
		}

		// Parcourir chaque élément dans le tableau
		// foreach ($data as $annonce) {
		// 	echo 'Titre: ' . $annonce['Titre'] . '<br>';
		// 	echo 'Lien du titre: ' . $annonce['Lien_du_titre'] . '<br>';
		// 	echo 'Image: ' . $annonce['image'] . '<br>';
		// 	echo 'Prix: ' . $annonce['_smallsupporttextcaption'] . '<br>';
		// 	echo 'Prix par mètre carré: ' . $annonce['sc3b75e5410'] . '<br>';
		// 	echo 'Emplacement: ' . $annonce['textcaption'] . '<br>';
		// 	echo 'Date de publication: ' . $annonce['textcaption1'] . '<br>';
		// 	echo 'Description: ' . $annonce['champ18'] . '<br>';
		// 	echo '------------------------<br>';
		// }

		$line     = '';
		$maxAddId = 0;
		$addIds   = [];

		$newDate = new importDateManagerController();
		$newDate->index();

		$newOwner = new importOwnerManagerController();

		foreach ($datas as $k => $data) {
			$data = array_values($data);

			$addId = substr($data[1], 46, 9); // 'Lien_du_titre'

			if (!in_array($addId, $addIds)) {
				$addIds[]        = $add[$k]['addId'] = $addId;
				$add[$k]['date'] = $newDate->dateConversion($data[9]); // 'Date de publication'
				$add[$k]['link'] = $data[1]; // 'Lien_du_titre'
				$add[$k]['id']   = $k;

				$add[$k]['title']   = $data[7]; // Titre
				$add[$k]['pieces']  = $data[11];
				$add[$k]['surface'] = $data[12]; // champ2
				$add[$k]['price']   = $data[14]; // champ4

				$add[$k]['ownerOri'] = $data[8]; // champ4
				$add[$k]['owner']    = $newOwner->getNewOwner($data[8]); // champ4
				$maxAddId            = max($maxAddId, $add[$k]['addId']);
			}
		}
		// echo $maxAddId;

		sort($add);

		// echo count($add);

		// echo '<pre>';
		// var_dump($add);
		// echo '</pre>';

		$precAddId = '';

		foreach ($add as $i => $a) {
			$color = 'none';

			if ($a['addId'] == $precAddId) {
				$color = 'orange';
			}

			$line .= '<tr">
                <td style="text-align: right; font-weight: bold; background-color: ' . $color . '"><a href=' . $a['link'] . ' target="_blank">' . ($a['id']) . '</a></td>
                <td>' . $a['date'] . '</td>
		        <td>' . $a['addId'] . '</td>

		        <td>' . $a['title'] . '</td>
		        <td>' . $a['pieces'] . '</td>
		        <td>' . $a['surface'] . '</td>
		        <td>' . $a['price'] . '</td>

		        <td>' . $a['ownerOri'] . '</td>
		        <td>' . $a['owner'] . '</td>
		        </tr>';
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
        <td style="text-align: center">Titre1</td>
        <td style="text-align: center">Champ 1</td>
        <td style="text-align: center">Champ 2</td>
        <td style="text-align: center">Prix</td>
        <td style="text-align: center">ProprioOri</td>
        <td style="text-align: center">Proprio</td>
        </tr>';

		return count($add) . ' annonces<table class="table table-sm table-bordered table-rounded">' . $head . $line . '</table>';
		// $ch = 'https://www.leboncoin.fr/ventes_immobilieres/2452806946.htm';
		// $ch = substr($ch, 50, 5);
	}
}
