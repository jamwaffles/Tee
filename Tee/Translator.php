<?php
/**
* @author James Waples
* @since v0.0.1
* 
* Main translator class
*/
namespace Tee {
	class Translator {
		private static $conf;
		private static $translationMap;

		/**
		* @since v0.0.1
		* @static
		*
		* Configure global Tee config
		*
		* @param Array $conf Configuration array
		*/
		public static function configure($conf) {
			self::$conf = (object)$conf;

			if(!isset(self::$conf->locale)) {
				self::$conf->locale = 'gb';
			}

			// Load translation map (JSON)
			$path = realpath('../../' . trim(self::$conf->mapDirectory, '/') . '/' . self::$conf->locale . '.json');

			if(is_file($path)) {
				$mapFile = file_get_contents($path);

				self::$translationMap = (array)json_decode($mapFile);
			}
		}

		/**
		* @since v0.0.1
		* @static
		* Take a string template and either a list or array of data values to insert
		*
		* @param String $string The template string compatible with <code>sprintf()</code>
		*
		* @param Array $args Array of values to insert into the template string
		* @param Mixed $args[...] A list of separate arguments to insert into the template string
		*
		* @return String The compiled string
		*
		* Example: \Tee\Translator::translate("Hello world")
		* Example: \Tee\Translator::translate("Hello %s. I'm %d years old", 'world', 7)
		* Example: \Tee\Translator::translate("Hello %s. I'm %d years old", array('world', 7))
		*/
		public static function translate() {
			$args = func_get_args();
			$string = array_shift($args);
			$args = $args[0];
			$output = '';

			if(self::$translationMap) {
				if(isset(self::$translationMap[$string])) {
					$string = self::$translationMap[$string];
				} else {
					// Throw some sort of warning
				}
			}

			if(count($args)) {
				if(is_array($args[0])) {		// Array of args
					$output = vsprintf($string, $args[0]);
				} else {			// List of args
					$output = sprintf($string, $args[0]);
				}
			} else {		// No placeholders, just return string
				$output = $string;
			}

			return $output;
		}
	}
}

namespace {
	/**
	* @global Function T
	*
	* A global convenience method for the namespaced translator function. See Tee\Translator::translate for usage
	*/
	function T() {
		$args = func_get_args();
		$string = array_shift($args);

		return \Tee\Translator::translate($string, $args);
	}
}
?>