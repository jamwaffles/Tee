Tee
===

Composer-compatible translation framework for PHP 5.3+ supporting multiple translation backends.

## Installation

Tee can be installed through Composer by adding it to your dependencies like this:

	{
		"require": {
			"jamwaffles/tee": "dev-master"
		}
	}

## Configuration

Make sure to include the Composer autoloader. You can then globally configure Tee as follows:

	require_once 'vendor/autoload.php';

	use \Tee\Translator as Trans;

	Trans::configure(array(
		'adapter' => '\\Tee\\Adapter\\JSON',
		'adapterConfig' => array('translations' => 'example_translations/'),
		'locale' => 'de'
	));

Tee is aliased to `Trans` here to make things easier.

Tee is bundled with the `\Tee\Adapter\JSON` JSON-based adapter by default. You can write your own by extending the `\Tee\TeeAdapter` interface.

## Usage

Tee can be used as a namespaced static class as `\Tee\Translator` like this:

	\Tee\Translator::configure(array( ... ));

	$username = 'JamWaffles';
	$someString = \Tee\Translator::translate("Hello, %s", $username);

Or with the convinence method, `T()`, like this in your templates:

	<h1><?= T("Account for %s", $username) ?></h1>

	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>

## Adapters

### JSON

This adapter is bundled by default. Details on how to form a valid translation JSON file will be added here shortly.

## Todo

- Documentation on the wiki
- Modify JSON adapter file format to have a small config section so fallback languages can be specified
- Add support for multiple caching mechanisms. Will look into supporting most common existing caching libraries. APC(u) will come first.