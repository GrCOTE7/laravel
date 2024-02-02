<?php

// 2do Install Puppeter + extra x2

namespace App\Http\Controllers;

use App\Http\Tools\Gc7;
use App\Services\Scrap\PuppeteerService;

class ScrapController extends Controller
{
	public function index()
	{
		$valeur = 777;
		// $valeur = $this->scrapByPhp();

		// 2fix Puppeteer
		$res = $this->generateScreenshot();

		return Gc7::affR($valeur ?? '');
		// return 777;
	}

	public function generateScreenshot()
	{
		$puppeteerService = new PuppeteerService();
		$url              = 'https://example.com';
		$outputPath       = public_path('screenshots/example.png');

		$puppeteerService->screenshot($url, $outputPath);

		return response()->download($outputPath);
	}

	public function scrapByPhp()
	{
		$html = file_get_contents('https://www.webscraper.io/test-sites/e-commerce/allinone/product/599');

		$wscrap = new \DOMDocument();

		libxml_use_internal_errors(true);
		libxml_clear_errors();

		$wscrap->loadHTML($html);

		$wscrap_path = new \DOMXPath($wscrap);

		$requete_path = '//h4[@class="float-end price pull-right"]';

		$result = $wscrap_path->query($requete_path);

		$valeur = $result[0]->nodeValue;

		return Gc7::affR($valeur);
		// return 777;
	}

	// public function puphpeteer()
	// {
	// 	$puppeteer = new Puppeteer();
	// 	$browser   = $puppeteer->launch();

	// 	$page = $browser->newPage();
	// 	$page->goto('https://example.com');
	// 	$page->waitForTimeout();
	// 	$page->screenshot(['path' => 'example.png']);

	// 	$browser->close();
	// }
}
