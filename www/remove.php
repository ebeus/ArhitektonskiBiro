<?php 
	if(!isset($_SESSION)) { 
        session_start(); 
    } else {
    	if(!isset($_SESSION['admin'])) {
    		header("location: index.php");
    		exit();
    		}
    }
	$xml_path = "xml/projekti.xml";
    if(!file_exists($xml_path)) {
        header('Refresh: 2; URL=add.php');
        exit("Prazan file.");
    }
    if(!isset($_GET['id'])) {
    	header('Refresh: 2; URL=projekti.php');
    	exit("ID Error");
    }

    if(!is_numeric($_GET['id'])) {
        header('Refresh: 2; URL=projekti.php');
        exit("ID Error");
    }

	$id_projekta = intval($_GET['id']);

	$xml = simplexml_load_file("xml/projekti.xml") or die ("Error");
    $broj_unosa = count($xml->children());


    if($broj_unosa < $id_projekta) {
    	header('Refresh: 2; URL=projekti.php');
    	exit("Pogresan ID ".$id_projekta);
    }

    if($broj_unosa == 1) {
        unset($xml_path);
        header("location: index.php");
        exit();
    }

    unset($xml->projekat[$id_projekta]);
    $xml->asXML($xml_path);
    header("location: projekti.php");
?>