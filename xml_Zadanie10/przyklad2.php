<?php

$plikmarki = file_get_contents("marki.xml");
$xmlmarki = new SimpleXMLElement($plikmarki);
$marki = array();
foreach ($xmlmarki as $xm){
	$marki[(int)$xm->id] = (string)$xm->nazwa;
}

$plikmodele = file_get_contents("modele.xml");
$xmlmodele = new SimpleXMLElement($plikmodele);
$modele = array();
foreach ($xmlmodele as $xms){
	$modele[(int)$xms->id] = (string)$xms->nazwa;
}


$plik = file_get_contents("samochody.xml");
$xml = new SimpleXMLElement($plik);

$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');



foreach($xml as $samochod) {
	$stmt = $pdo->prepare("
		INSERT INTO samochody 
		(id, marka, model, rok, pojemnosc, typ_silnika, liczba_poduszek, abs, esp) 
		VALUES 
		(:id, :marka, :model, :rok, :pojemnosc, :typ_silnika, :liczba_poduszek, :abs, :esp)
	");
	$wynik = $stmt->execute([
		'id' => $samochod->id,
		'marka' => $marki[(int)$samochod->marka],
		'model' => $modele[(int)$samochod->model],
		'rok' => $samochod->rok,
		'pojemnosc' => $samochod->pojemnosc,
		'typ_silnika' => $samochod->typ_silnika,
		'liczba_poduszek' => $samochod->liczba_poduszek,
		'abs' => $samochod->abs,
		'esp' => $samochod->esp,
	]);
}