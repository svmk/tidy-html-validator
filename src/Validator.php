<?php
namespace TidyValidator;
use Symfony\Component\Process\Process;
use Rackem\Cgi;
use \Rackem;
class Validator {
    /**
     * validate validates html data
     * 
     * @param string $htmlContent html data
     * @param array  $config      config
     * @param string $codePage    code page
     *
     * @access public
     * @static
     *
     * @return array
     */
	public static function validate($htmlContent,$config = [], $codePage = 'utf8') {
		$tidy = new \tidy;
		$tidy->parseString($htmlContent, $config, $codePage);
		$tidy->cleanRepair();
		$items = explode("\n",$tidy->errorBuffer);
		$result = [];
		foreach ($items as $item) {
			if (preg_match('/^line\s*([0-9]*)\s*column\s*([0-9]*)\s*-\s*([a-zA-Z0-9]*)\s*\:\s*(.*)$/isU', $item,$matches)) {
				$result[] = [
					'line' => $matches[1],
					'column' => $matches[2],
					'messageType' => trim($matches[3]),
					'message' => trim($matches[4]),
				];
			}
		}
		return $result;
	}
}