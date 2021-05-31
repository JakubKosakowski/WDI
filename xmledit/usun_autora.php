<?php
	require_once 'XmlEdit.php';
	
    $x = 0;
    $dane = array();

	$xml = new Xml();
    $ksiazki = $xml->zwrocKsiazki();

    foreach($ksiazki as $id => $d){
        $dane[$id] = $d;
    }
    foreach($dane as $id => $d){
        if($d['id_autora'] == $_GET['id']){
            $x = $x + 1;
        }
    }
    if($x == 0){
    $xml->usunAutora($_GET['id']);
	header("Location: autorzy.php");
    }
    else{
        header("Location: autorzy.php?komunikat=1");      
    }
