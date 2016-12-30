<?php
	include "utility.php";

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    
    if(!isset($_SESSION['admin'])) {
            header("location: index.php");
            exit();
    }

    $xml_pitanja_path = "xml/pitanja.xml";
    if(file_exists($xml_pitanja_path)) {
        $xml = simplexml_load_file($xml_pitanja_path) or die ("Error");
        $broj_unosa = count($xml->children());
    } 
    

    if(!isset($_POST['id_pitanja'])) {
    	header('Refresh: 2; URL=admin.php');
    	exit("ID Not Set Error");
    }

    if(!is_numeric($_POST['id_pitanja'])) {
        header('Refresh: 5; URL=admin.php');
        exit("ID Num Error");
    }

    $id_pitanja = intval($_POST['id_pitanja']);



    $odgovor = prepare($_POST['tekstodgovora']);

    if(isset($_POST['odobreno']) && $_POST['odobreno'] == 'Yes') {
    	$odobreno = true;
    } else {
    	$odobreno = false;
    }

    $xml->pitanje[$id_pitanja]->odgovor = $odgovor;
    $xml->pitanje[$id_pitanja]->odobreno = $odobreno;

    $xml->asXML($xml_pitanja_path);
    echo "Uspješno dodano!";
    header('Refresh: 5; URL=pitanja.php');
?>
