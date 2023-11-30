<?php

namespace App\Http\Controllers;

class importOwnerManagerController extends Controller
{
	public function index()
	{
		$owners = $this->getData();

		$ch = '';
		// echo $owner . ' = ' . $this->dateConversion($published_date) . '<br>';
		// $words        = explode(' ', $owner);
		// // $regex = '/^([^\d-s]+)/i';
		// $regex = '/^([^\d\s]+(?:\s+[^\d\s]+)*)\s+Membre/';
		// if (preg_match($regex, $firstLetters, $matches)) {
		// 	$newOwner = $matches[1];
		// }
		// $nomsProprietaires = [];

		foreach ($owners as $owner) {
                $ch .= $owner . '<br>→ ' . $this->getNewOwner($owner) . '<hr>';
		}

		// $newOwner = preg_replace('/Membre/', '', $newOwner);

		$myVar = $ch;

		return view('pages.test', compact('myVar'));
	}

	public function getNewOwner($owner)
	{
        $regex = '/^([^\d\s]+(?:\s+[^\d\s]+)*)(?:.*?Membre|$)/';
		if (preg_match($regex, $owner, $matches)) {
			return $matches[1];
		}
	}

	private function getData()
	{
		return [
			'christine colinMembre depuis août 2019Signaler l’annonceVos droits et obligationsAccueilVentes immobilièresFranche-ComtéJuraPeintre 39290Lot maisons à vendreAnnonces Google',
			'Coco16 annoncesMembre depuis décembre 2015Dernière réponse en moins de 6 heuresSignaler l’annonceVos droits et obligationsAccueilVentes immobilièresFranche-ComtéJuraChaussin 39120Maison type F5Annonces Google',
			'philippeMembre depuis juillet 2015Dernière réponse en moins de 10 minutesSignaler l’annonceVos droits et obligationsAccueilVentes immobilièresFranche-ComtéJuraTavaux 39500Maison Tavaux villageAnnonces Google',
            "Laurent23 annoncesPièce d’identité vérifiéeMembre depuis novembre 2015Répond généralement dans les 6 heuresSignaler l’annonceVos droits et obligationsAccueilVentes immobilièresFranche-ComtéJuraDole 39100Maison 5 chambres 200m2Annonces Google",
            "benjamin112 annoncesPièce d’identité vérifiéeMembre depuis octobre 2015Répond généralement dans les 3 heuresSignaler l’annonceVos droits et obligationsAccueilVentes immobilièresBourgogneCôte-d'OrNeuilly-Crimolois 21800Maison 90 m2 Neuilly CrimoloisAnnonces Google",
            "MD21Membre depuis janvier 2015Signaler l’annonceVos droits et obligationsAccueilVentes immobilièresBourgogneCôte-d'OrSeurre 21250Maison 5 pièces 106 m²Annonces Google"
		];
	}
}
