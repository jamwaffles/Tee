<?php
namespace Tee\Adapter;

interface TeeAdapter {
	// Configuration method. Executed once before any other usage of the adapter.
	// Do any preconfiguration/caching in here
	public function configure(array $conf);

	// Returns string with filled placeholders
	public function translate($string, array $values = []);
}
?>