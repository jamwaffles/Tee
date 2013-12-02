<?php
namespace Tee {
	class Translator {
		public static function translate() {
			$args = func_get_args();
			$string = array_shift($args);
			$output = '';

			if(is_array($args[0])) {		// Array of args
				$output = vsprintf($string, $args[0]);
			} else {			// List of args
				$output = sprintf($string, $args);
			}

			return $output;
		}
	}
};

namespace {
	function T($string, $args = null) {
		\Tee\Translator::translate($string, $args);
	}
}
?>