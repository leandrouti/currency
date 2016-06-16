<?php

	$url = "https://openexchangerates.org/api/latest.json?app_id=0a002939d3814b5782425c1b34b66ac7";
	$content = file_get_contents($url);

	$values = json_decode($content, true);
	echo "<pre>";
	var_dump($values);
	$date = date("Y/m/d H:i:s", $values['timestamp']);

	echo <<<HTML
	<h1>Date: {$date}</h1>
	<table border="1">
	<tr><th>1USD > 1BRL</th><td>{$values['rates']['BRL']}</td></tr>
	<tr><th>1USD > 1JPY</th><td>{$values['rates']['JPY']}</td></tr>
	</table>
	<hr>
HTML;
	$bbQuote = array();
	$bbQuote['JPY']['USD'] = $values['rates']['JPY']+1;
	$bbQuote['USD']['JPY'] = $values['rates']['JPY']-1;
?>

<table border="1">
	<tr><th colspan="2">Cotacao para BB</th></tr>
	<tr><th>JPY > USD</th><th>USD > JPY</th></tr>
	<tr><td><?php echo $bbQuote['JPY']['USD']; ?></td><td><?php echo $bbQuote['USD']['JPY']; ?></td></tr>
</table>
