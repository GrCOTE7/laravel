<?php
namespace App\Http\Tools;

class Gc7 {
	public static function aff(mixed $var, string $txt = null): void {
		$aff = self::affR($var, $txt);
		echo $aff;
	}

	public static function affR(mixed $var, string $txt = null): string {
		$aff = '<a title=' . debug_backtrace()[1]['file'] . '&nbsp;-&nbsp;Line&nbsp;' . debug_backtrace()[1]['line'] . '><pre>' . (($txt) ? $txt . ' : ' : '');
		$aff .= print_r($var, 1);
		$aff .= '</pre></a>';

		// return (DEBUG) ? $aff : '';
		return $aff;
	}

	/**
	 * Affiche les 3 clés utiles de notre session.
	 *
	 * @param mixed $out
	 */
	public static function affSession(int $out = 0): string {
		$infos = ['page', 'todo', 'errors'];
		foreach ($infos as $info) {
			$str[] = self::affR($_SESSION['data'][$info] ?? 'Nothing', $info);
		}

		return implode($str);
	}

	public static function affFile($url, $file = 'data.txt') {
		$fp = fopen($file, 'w+');
		fwrite($fp, "\n");
		fwrite($fp, str_repeat('-', 7) . ' START ' . str_repeat('-', 7));
		fwrite($fp, "\n");
		fwrite($fp, "\n");
		fwrite($fp, print_r($url, 1));
		fwrite($fp, "\n");
		fwrite($fp, "\n");
		fwrite($fp, str_repeat('-', 7) . '  oOo  ' . str_repeat('-', 7));
		fwrite($fp, "\n");
		fwrite($fp, "\n");
		fwrite($fp, debug_backtrace()[0]['file'] . '   Line   ' . debug_backtrace()[0]['line'] . "\n");
		fwrite($fp, "\n");
		fwrite($fp, str_repeat('-', 7) . '  END  ' . str_repeat('-', 7));
		fwrite($fp, "\n");
		fclose($fp);
	}
}
// aff(debug_backtrace());