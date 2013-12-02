<?php
/**
* @author James Waples
* @since v0.0.1
* 
* Main translator class
*/
namespace Tee {
	class Translator {
		/**
		* @since v0.0.1
		* @static
		* Take a string template and either a list or array of data values to insert
		*
		* @param String $string The template string compatible with <code>sprintf()</code>
		*
		* @param Array $args Array of values to insert into the template string
		* @param Multiple $args[...] A list of separate arguments to insert into the template string
		*
		* @return String The compiled string
		*/
		public static function translate() {
			$args = func_get_args();
			$string = array_shift($args);
			$output = '';

			if(is_array($args[0])) {		// Array of args
				$output = vsprintf($string, $args[0]);
			} else {			// List of args
				$output = sprintf($string, $args[0]);
			}

			return $output;
		}
	}
}

namespace {
	/**
	* @global Function T
	*/
	function T($string, $args = null) {
		return \Tee\Translator::translate($string, $args);
	}
}
?>