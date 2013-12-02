<?php
require_once 'Translator.php';

use \Tee\Translator as Trans;

Trans::configure(array(
	'mapDirectory' => 'translations',
	'locale' => 'de'
));
?>

<h1>Tee testing</h1>

<h2>Simple test</h2>

<pre>
<code>&lt;?= T("Hello world, my name is Kerbal") ?>
&lt;?= T("Hello world, my name is %s", 'James') ?>
&lt;?= T("Hello world, my name is %s", array('Bob')) ?></code>
</pre>

<?= T("Hello world, my name is Kerbal") ?><br>
<?= T("Hello world, my name is %s", 'James') ?><br>
<?= T("Hello world, my name is %s", array('Bob')) ?>

<hr>