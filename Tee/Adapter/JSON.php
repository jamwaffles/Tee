<?php
namespace Tee\Adapter;

class JSON implements \Tee\Adapter\TeeAdapter {
	protected $conf;
	protected $map = array();

	public function configure(array $conf) {
		$this->conf = (object)$conf;

		if(!isset($this->conf->locale)) {
			$this->conf->locale = 'gb';
		}

		// Load translation map (JSON)
		$path = rtrim($this->conf->translations, '/') . '/' . $this->conf->locale . '.json';

		if(is_file($path)) {
			$mapFile = file_get_contents($path);

			$this->map = (array)json_decode($mapFile);
		} else {
			throw new \RuntimeException("Could not find translation file {$path}");
		}
	}

	public function translate($string, array $values = []) {
		if(isset($this->map[$string])) {
			return vsprintf($this->map[$string], $values);
		} else {
			return vsprintf($string, $values);
		}
	}
}
?>