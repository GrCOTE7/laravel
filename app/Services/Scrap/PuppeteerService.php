<?php

namespace App\Services\Scrap;

use Nesk\Puphpeteer\Puppeteer;

class PuppeteerService
{
	protected $puppeteer;

	public function __construct()
	{
		$this->puppeteer = new Puppeteer([
			// 'executablePath' => 'C:\Program Files\Google\Chrome\Application\chrome.exe',
			// Remplacez par le chemin de votre exécutable Chrome/Chromium
			'headless' => false,
			// true pour exécution sans interface graphique
		]);
	}

	public function screenshot($url, $outputPath)
	{
		$browser = $this->puppeteer->launch();

		$page = $browser->newPage();
		$page->goto($url);
		$page->screenshot(['path' => $outputPath]);

		$browser->close();
	}
}

// x Créer un service
// https://www.youtube.com/watch?v=rRZMV-OHfWQ

// 2see

// 2do Scraper le Web avec Puppeteer
// https://www.youtube.com/watch?v=phK3zP2u_a4

// 2do Puppeteer Tutorial for Beginners
// https://www.youtube.com/playlist?list=PLp50dWW_m40XnkYHJpA60roI-DZefRe8l

// 2do Puppeteer & CAPCHA
// https://www.youtube.com/watch?v=awKW5H7XXRs&pp=ugMICgJmchABGAHKBRZwdXBwZXRlZXIgYXZlYyBsYXJhdmVs

// 2do Course Puppeteer
// https://www.youtube.com/watch?v=URGkzNC-Nwo&list=PLuJJZ-W1NwdqgvE0D-1SMS7EpWIC5cKqu

// 2do Full course Puppeteer
// https://www.youtube.com/watch?v=URGkzNC-Nwo&list=PLuJJZ-W1NwdqgvE0D-1SMS7EpWIC5cKqu
