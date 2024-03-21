<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Http\Controllers;

class GregController extends Controller
{
	public $a = 77;

	public function index()
	{
		// ini_set('output_buffering', 0);
		// ini_set('implicit_flush', true);
		// ob_implicit_flush(true);

		// phpinfo();
		// return;
		$this->aff($this->a);
		$this->aff('ok');

		echo 'Début ...<br />';
		for ($i = 0; $i < 3; ++$i) {
			echo $i . '<br />';
			ob_flush();
			flush();
			sleep(1);
		}
		echo 'Fin ...<br />';

		$response = $this->encode('Perroquet !');
		// aff($response);
		$msg     = $this->getMessage();
		$decoded = $this->gregDecode($msg);

		return view('pages.greg', compact('msg', 'decoded', 'response'));
	}

	public function gregDecode($msg)
	{
		$clefs = $this->getKeys();

		foreach ($clefs as $k => $clef) {
			$msg = str_replace($k, $clef, $msg);
			// aff($msg);
			// sleep(2);
		}

		return $msg;
	}

	public function encode($msg)
	{
		$code = array_flip($this->getKeys($this->getKeys()));

		foreach ($code as $k => $clef) {
			$msg = str_replace($k, $clef, $msg);
		}

		return $msg;
	}

	public function getMessage()
	{
		return '
⌇⏃⌰⎍⏁ @ ⏁⍜⎍⌇ !<br><br>

⟊\'⟒⌇⌿è⍀⟒ ⍾⎍⟒ ⎐⍜⎍⌇ ê⏁⟒⌇ ⊑⟒⎍⍀⟒⎍⌖.<br><br>

☊⟒☊⟟ ⎅⟟⏁, ⋏⍜⌇ ⍀⍜⎍⏁⟒⌇ ⌇⟒ ⌇⍜⋏⏁ ☊⍀⍜⟟⌇é⟒⌇... ⋏\'é⏁⏃⟟⏁ ☊⟒ ⍾⎍\'⎍⋏ ⏃☊☊⟟⎅⟒⋏⏁, ☊⍜⋔⋔⟒ ⎅⟒⌇☊⏃⍀⏁⟒⌇ ⌰\'⏃⎍⍀⏃⟟⏁ ⏃⟟⋔é... ?  ⍜ù, ⌿⟒⎍⏁-ê⏁⍀⟒ é⏁⏃⟟⏁ ☊⟒ + ⏃⍀⟟⌇⏁⍜☊⟟⟒⋏...?<br><br>

⏚⍜⋏, ⌿⍜⎍⍀ ☊⟒⎍⌖ ⍾⎍⟒ ç⏃ ⟟⋏⏁é⍀⟒⌇⌇⟒⋏⏁, ⟒⏁ ⌇⟟ ⎐⍜⎍⌇ ⌿⟒⋏⌇⟒⋉ ⏃⎍⌇⌇⟟ à ☊⟒ ⎅⟒⍀⋏⟟⟒⍀ ☊⏃⌇, ⋔⍜⟟, ⟊⟒ ⍀⟒⌇⏁⟒ ⎅⏃⋏⌇ ⌰⏃ ☊⍀⍜⊬⏃⋏☊⟒ ⎅⎍ ☊⍜⎅⟒ é⏁⊑⟟⍾⎍⟒.<br><br>

⟒⏁ ⎅⍜⋏☊, ⟊⟒ ⎅⟒⎐, à ⎅⍜⋏⎎ ⟒⋏ ⋏⍜⎅⟒ ⟊⌇ (⌇⎍⍀⏁⍜⎍⏁ ⌰⟒⌇ ⏃⌇⊬⋏☊, ⟒⏁☊...) ⟒⏁ ⌿⊑⌿/⋔⊬⌇⍾⌰ (⟒⏁ ☊⍜⋔⋔⟒ ⎅\'⊑⏃⏚, à ⏁⟟⏁⍀⟒ ⍾⎍⏃⌇⟟ ⌿⟒⍀⌇⍜)...<br><br>

⟒⏁ ⎐⍜⎍⌇ ?<br><br>

⟊⎍⌇⏁⟒ ⚎ ⍾⎍⟒⌇⏁⟟⍜⋏⌇ à ☊⟒⎍⌖(☊⟒⌰⌰⟒⌇) ⍾⎍⟟ ⎐⍜⎍⎅⍀⍜⋏⏁ ⏚⟟⟒⋏ ⊬ ⍀é⌿⍜⋏⎅⍀⟒...:<br>
⟒⌇⏁-☊⟒ ⍾⎍⟒ ⌰⏃ ⎎⍜⍀⋔⏃⏁⟟⍜⋏ ⌇⎍⟟⎐⟟⟒ ⎐⍜⎍⌇ ⏃ ⏃⌿⌿⍜⍀⏁é ⍾⎍⟒⌰⍾⎍⟒ ☊⊑⍜⌇⟒ ⍾⎍⟒ ⎐⍜⎍⌇ ⏃⎐⟒⋉ ⎅é⟊à ⌇⎍ ⟒⏁ ⌿⎍ ⎍⏁⟟⌰⟟⌇⟒⍀ ⟒⎎⎎⟟☊⏃☊⟒⋔⟒⋏⏁ ? ( ⍜⋏ ⟒⌇⏁ ⟒⌇⏁ ⍾⎍⏃⌇⟟  à ⟊ + 360. ⎅⟒ ⌇⍜⋏ ⏁⟒⍀⋔⟒...) ?<br><br>
à ⏁⟟⏁⍀⟒ ⌿⍀⍜, ⎍⋏ ⟊⍜⏚ ?  ☊⍜⋔⋔⟒ ⌇⍜⌿⊑⟟⟒-⏃⋏⋏⟒ ⌇\'⟒⋏ ⟟⋏⍾⎍⟟è⏁⟒ ☊⟟-⏃⎐⏃⋏⏁?<br><br>
⌿⟒⋏⎅⏃⋏⏁ ☊⟒ ⌇⏁⏃☌⟒, ⍜⋏ ⏃ ⎎⏃⟟⏁ ⎅⟒⌇ ⏁⏃⌇ ⎅⟒ ⍀⟒⋏☊⍜⋏⏁⍀⟒⌇, ⊬ ☊⍜⋔⌿⍀⟟⌇ ⏃⎐⟒☊ ⎅⟒⌇ ☌⟒⋏⌇ ⎎⍜⍀⋔⟟⎅⏃⏚⌰⟒⌇ (⟒⏁ ⟊⟒ ⋏⟒ ⌿⏃⍀⌰⟒ ⌰à, ⍾⎍⟒ ⎅⟒ ⋏⍜⏁⍀⟒ "⟊⍜⊑⋏⋏⊬ ", ⍜⎍ ⟒⋏☊⍜⍀⟒ ⎅⟒ ⋏⍜⏁⍀⟒ ⟟⋏⎐⟒⌇⏁⟟ ☊⊬⍀⟟⌰ ⎐⏃⌰⌰⟒⟒..., ⍜ù ⋔ê⋔⟒ ⎅⟒ ⌰⏃ ⌇⟒☊⍀é⏁⏃⟟⍀⟒ ⏁⍜⎍⟊⍜⎍⍀⌇ ⍀é☊⍜⋏⎎⍜⍀⏁⏃⋏⏁⟒...), ⋔⏃⟟⌇ ⏃⎍⌇⌇⟟ ⎅⟒ ☊⊑⏃☊⎍⋏ ⎅\'⟒⋏⏁⍀⟒ ⎐⍜⎍⌇ ! ⟊⟒ ⋏⟒ ☊⟟⏁⟒⍀⏃⟟ ⌿⟒⍀⌇⍜⋏⋏⟒ ⟒⋏ ⌿⏃⍀⏁⟟☊⎍⌰⟟⟒⍀, ☊⏃⍀ ⌇⟟⋏⍜⋏, ☊⟒ ⌇⟒⍀⏃ ⏁⍀⍜⌿ ⌰⍜⋏☌ ⟟☊⟟, ⍜⋏ é⏁⏃⟟⏁ ⍾⎍⏃⋏⎅ ⋔ê⋔⟒ ⎍⋏ ⍾⎍⟟⋏⋉⏃⟟⋏⟒, ⟒⏁ ☊⟒⍀⏁⏃⟟⋏⌇ ⎐⟒⋏⏃⟟⟒⋏⏁ ⎅⟒ ⌰⍜⟟⋏ [⊑⟒⟟⋏, ☌⟒⍜⍀☌⟟ ?]), ⟒⏁ ⎅⟒ ⟒⏁ ⟒⋏ ⍾⎍⍜⟟ ⎐⍜⏁⍀⟒ ⏃⎐⟒⋏⟟⍀ ⎐⏃ ⏁\'⟟⌰ ⌿⍀⍜⎎⟟⏁⟒⍀ ⎅⟒ ☊⟒ ⌿⍜⏁⟒⋏⏁⟟⟒⌰ ?<br><br>

⏚⍜⋏, ⋔⟒⍀☊⟟ ⎅⟒ ⎐⍜⏁⍀⟒ ⍀é⌿⍜⋏⌇⟒ é⎐⟒⋏⏁⎍⟒⌰⌰⟒.<br><br>

⟒⏁ ⍾⎍⍜⟟ ⍾⎍\'⟟⌰ ⟒⋏ ⌇⍜⟟⏁, ⋏\'⍜⎍⏚⌰⟟⟒⋉ ⟊⏃⋔⏃⟟⌇ ⍾⎍⟒ ⏁⍜⟟, ☊⍜⋔⋔⟒ ☊⊑⏃☊⎍⋏, ⟒⌇⏁ ⎍⋏⟟⍾⎍⟒, ⟒⏁ ⎅⍜⋏☊ ⟒⌖☊⟒⌿⏁⟟⍜⋏⋏⟒⌰ ⟒⏁ ⍀⏃⍀⟒ ! ⟒⏁ ☊⟒⌇ ⍾⎍⟒⌰⍾⎍⟒⌇ ⌇⟒⎍⌰⌇ 2-3 ☊⍀⟟⏁è⍀⟒⌇ ⟊⎍⌇⏁⟟⎎⟟⟒⋏⏁ ⍾⎍⟒ ⏁⎍ ⟒⌇ ⎅⍜⋏☊ ⟟⋔⌿⍜⍀⏁⏃⋏⏁ !  ⋔⏃⟟⌇ ⍾⎍⟒ ☊⟒ ⍾⎍⟟ ⎎⟒⍀⏃ ⎅⟒ ⏁⍜⟟ ⎐⍀⏃⟟⋔⟒⋏⏁ ⏁⏃ ⎎⍜⍀☊⟒, ⟒⌇⏁ ⏃⎍⌇⌇⟟ ⎅⏃⋏⌇ ⍾⎍⟒⌰⌰⟒ ⋔⟒⌇⎍⍀⟒ ⏁⎍ ⎐⏃⌇ ⍀é⎍⌇⌇⟟⍀ à ⎍⏁⟟⌰⟟⌇⟒⍀ ⟒⋏⏁⍀⟒ ⏃⎍⏁⍀⟒⌇, ⏃⎍⌇⌇⟟ ⏁⟒⌇ ⌿⍜⏁⟒⋏⏁⟟⟒⌰⌇ !<br><br>

@ ++, ⟊⟒ ⎐⍜⎍⌇ ⏃⟟ ⏃⟟⋔é, ⎐⍜⎍⌇ ⏃⟟⋔⟒ ⟒⋏☊⍜⍀⟒, ⟒⏁ ⌿⟒⍀⌇⟟⌇⏁⟒ à ☊⍀⍜⟟⍀⟒ ⟒⋏ ⎐⍜⎍⌇ !<br><br>
';
	}

	public function getKeys()
	{
		return [
			'⚎' => '3',
			'⏃' => 'a',
			'⏚' => 'b',
			'☊' => 'c',
			'⎅' => 'd',
			'⟒' => 'e',
			'⎎' => 'f',
			'☌' => 'g',
			'⊑' => 'h',
			'⟟' => 'i',
			'⟊' => 'j',
			'⌰' => 'l',
			'⋔' => 'm',
			'⋏' => 'n',
			'⍜' => 'o',
			'⌿' => 'p',
			'⍀' => 'r',
			'⌇' => 's',
			'⏁' => 't',
			'⍾' => 'q',
			'⎍' => 'u',
			'⎐' => 'v',
			'⌖' => 'x',
			'⊬' => 'y',
			'⋉' => 'z',
		];
	}

	public function aff($message)
	{
		echo $message;
		ob_flush();
		flush();
	}
}
