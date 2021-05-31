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
        if($d['id_rodzaju'] == $_GET['id']){
            $x = $x + 1;
        }
    }
    if($x == 0){
    $xml->usunRodzaj($_GET['id']);
	header("Location: rodzaj.php");
    }
    else{
        header("Location: rodzaj.php?komunikat=1");      
    }
