<?php
require_once 'vendor/autoload.php';

use \Tee\Translator as Trans;

Trans::configure(array(
	'adapter' => '\\Tee\\Adapter\\JSON',
	'adapterConfig' => array('translations' => 'example_translations/'),
	'locale' => 'de'
));
?>
<h1>Tee testing</h1>

<h2>Simple test</h2>

<pre>
<code>&lt;?= T("Hello world, my name is Kerbal") ?>
&lt;?= T("Hello world, my name is %s", 'James') ?>
&lt;?= T("Hello world, my name is %s", array('Bob')) ?></code>
&lt;?= T("Hello %s, my name is %s", array('Earth', 'Bob')) ?></code>
&lt;?= T("Hello %s, my name is %s", 'Earth', 'Bob') ?></code>
</pre>

<?= T("Hello world, my name is Kerbal") ?><br>
<?= T("Hello world, my name is %s", 'James') ?><br>
<?= T("Hello world, my name is %s", array('Bob')) ?><br>
<?= T("Hello %s, my name is %s", array('Earth', 'Bob')) ?><br>
<?= T("Hello %s, my name is %s", 'Earth', 'Bob') ?>
<hr>