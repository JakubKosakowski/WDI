<?php

$plik = file_get_contents("samochody.xml");
$xml = new SimpleXMLElement($plik);
$csv = '';

foreach($xml as $samochod) {
	$csv .= $samochod->id.";";
	$csv .= $samochod->marka.";";
	$csv .= $samochod->model.";";
	$csv .= $samochod->rok.";";
	$csv .= $samochod->pojemnosc.";";
	$csv .= $samochod->typ_silnika.";";
	$csv .= $samochod->liczba_poduszek.";";
	$csv .= $samochod->abs.";";
	$csv .= $samochod->esp."\n";
}

file_put_contents("przyklad3.csv", $csv);