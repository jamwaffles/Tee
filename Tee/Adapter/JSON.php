<?php
namespace Tee\Adapter;

class JSON implements \Tee\Adapter\TeeAdapter {
	protected $conf;
	protected $translationMap = array();

	public function configure(array $conf) {
		$this->conf = (object)$conf;

		if(!isset($this->conf->locale)) {
			$this->conf->locale = 'gb';
		}

		// Load translation map (JSON)
		$path = rtrim($this->conf->translations, '/') . '/' . $this->conf->locale . '.json';

		if(is_file($path)) {
			$mapFile = file_get_contents($path);

			$this->translationMap = (array)json_decode($mapFile);
		} else {
			throw new \RuntimeException("Could not find translation file {$path}");
		}
	}

	public function translate($string, array $values = []) {
		// No arguments passed, return the string as is
		if(!count($values)) {
			return $string;
		}

		// Return string with placeholders replaced with actual values
		return vsprintf($string, $values);
	}
}
?>