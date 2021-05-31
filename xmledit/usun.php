<?php
	require_once 'XmlEdit.php';
	
	$xml = new Xml();
	$xml->usunKsiazke($_GET['id']);
	header("Location: index.php");