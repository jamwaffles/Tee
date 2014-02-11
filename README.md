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

The JSON adapter uses standard JSON files to store translations in a `"original": "translation"` format. For example:

	{
		"Hello world, my name is %s": "Hallo Welt, mein Name ist %s"
	}

Configure Tee to use the `\Tee\Adapter\JSON` adapter like this:

	Trans::configure(array(
		'adapter' => '\\Tee\\Adapter\\JSON',
		'adapterConfig' => array('translations' => 'resources/languages/'),
		'locale' => 'de'		// Or whatever else
	));

Pass an array to `adapterConfig` to specify where the translations will be stored. The `locale` value is the name of the translation file without the `.json` extension. The configuration above would look for a file at 

	resources/languages/de.json

## Todo

- Documentation on the wiki
- Modify JSON adapter file format to have a small config section so fallback languages can be specified
- Add support for multiple caching mechanisms. Will look into supporting most common existing caching libraries. APC(u) will come first.
- Better error reporting. Allow passing of logger instances?