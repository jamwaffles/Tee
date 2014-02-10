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
		private static $adapter = null;

		/**
		* @since v0.0.1
		* @static
		*
		* Configure global Tee config
		*
		* @param Array $conf Configuration array
		*/
		public static function configure(array $conf) {
			self::$conf = (object)$conf;

			if(!self::$adapter) {
				if(isset(self::$conf->adapter)) {
					$adapter = self::$conf->adapter;

					if(class_exists($adapter)) {
						self::$adapter = new $adapter (isset(self::$conf->adapterConfig) ? self::$conf->adapterConfig : array());
					} else {
						throw new \RuntimeException("Tee adapter {$adapter} not found");
					}
				}
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
			$key = array_shift($args);
			$values = $args[0];

			// If values were passed as an array, it'll be nested. Un-nest it from the arguments list so it's passed to the adapter verbatim
			if(count($values) && is_array($values[0])) {
				$values = array_values($values[0]);
			}

			return self::$adapter->translate($key, $values);
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