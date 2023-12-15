<?php

namespace App\Http\Tools;

class Gc7
{
	public static function aff(mixed $var, string $txt = null): void
	{
		if (!$txt) {
			$txt = gettype($var);
		}
		$aff = self::affR($var, $txt);
		echo $aff;
	}

	public static function affR(mixed $var, string $txt = null): string
	{
		$aff = '<a title=' . debug_backtrace()[1]['file'] . '&nbsp;-&nbsp;Line&nbsp;' . debug_backtrace()[1]['line'] . '><pre>' . (($txt) ? $txt . ' : ' : '');
		$aff .= print_r($var, 1);
		$aff .= '</pre></a>';

		// return (DEBUG) ? $aff : '';
		return $aff;
	}

	public static function affData($data = null)
	{
		// self::aff($data);
		$str = $data;

		if (!is_string($data)) {
			if (is_array($data)) {
				$str = implode('<br>', $data);
			}
			if (is_object($data)) {
				$str = 'Object:<br>';
				foreach ($data as $k => $v) {
					$str .= $k . ' → ' . $v . '<br>';
				}
			}
		}

		return $str;
	}

	/**
	 * Affiche les 3 clés utiles de notre session.
	 *
	 * @param mixed $out
	 */
	public static function affSession(int $out = 0): string
	{
		$infos = ['page', 'todo', 'errors'];
		foreach ($infos as $info) {
			$str[] = self::affR($_SESSION['data'][$info] ?? 'Nothing', $info);
		}

		return implode($str);
	}

	public static function affFile($url, $file = 'data.txt')
	{
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

	public static function affH($ad)
	{
		$fields = array_keys($ad);
		$values = array_values($ad);

		// $limit = count($ad) > 20 ? 33 : 12;
		$limit = count($ad);
		$cell  = 'text-align: center; max-width: 260; word-wrap: break-word;';

		$lg = 0;
		for ($i = 0; $i <= 3; ++$i) {
			$linesH[$i] = '';
			$linesC[$i] = '';
		}
		// $lines='';
		foreach ($fields as $k => $v) {
			if ($k < $limit) {
				$linesH[$lg] .= '<th style="' . $cell . '">' . $v . '<br>' . $k . '</th>';
				if (!(($k + 1) % ($limit / 3))) {
					++$lg;
					// $linesH[$lg] .= '</tr><tr>';
				}
			}
		}
		$lg = 0;
		foreach ($values as $k => $v) {
			if ($k < $limit) {
				$linesC[$lg] .= '<td style="' . $cell . '">' . $v . '</td>';
				if (!(($k + 1) % ($limit / 3))) {
					++$lg;
					// $linesC[$lg] .= '</tr><tr>';
				}
			}
		}

		$data = '<table class="table table-sm table-bordered table-rounded m-auto" style="width: 97%"><tr>';
		for ($i = 0; $i <= 3; ++$i) {
			$data .= $linesH[$i] . '</tr><tr>';
			$data .= $linesC[$i] . '</tr><tr>';
		}
		$data .= '</tr></table>';

		echo $data;

		// foreach ($ad as $k => $v) {
		// 	echo $k;
		// }
		// self::aff($k);
	}
}
// aff(debug_backtrace());
