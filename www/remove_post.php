<?php
	if(!isset($_SESSION)) { 
        session_start(); 
    } 

    if(!isset($_SESSION['admin'])) {
            header("location: index.php");
            exit();
    }

    $xml_pitanja_path = "xml/pitanja.xml";

    if(!file_exists($xml_pitanja_path)) {
        header('Refresh: 2; URL=admin.php');
        exit("Prazan file.");
    }

    if(!isset($_GET['id'])) {
    	header('Refresh: 2; URL=admin.php');
    	exit("ID Error");
    }

    if(!is_numeric($_GET['id'])) {
        header('Refresh: 2; URL=admin.php');
        exit("ID Error");
    }

    $id_pitanja = intval($_GET['id']);

    $xml = simplexml_load_file($xml_pitanja_path) or die ("Error");
    $broj_unosa = count($xml->children());

    if($broj_unosa < $id_pitanja) {
    	header('Refresh: 2; URL=admin.php');
    	exit("Pogresan ID ".$id_pitanja);
    }

    if($broj_unosa == 1) {
        unlink($xml_pitanja_path);
        header("location: admin.php");
        exit();
    }

    unset($xml->pitanje[$id_pitanja]);
    $xml->asXML($xml_pitanja_pathth);
    header("location: admin.php");
?>