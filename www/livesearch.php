<?php
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


    $xml_pitanja_path = "xml/pitanja.xml";

    $xml = simplexml_load_file($xml_pitanja_path) or die ("Error");

    $q = htmlspecialchars($_GET["q"]);
    $stringovi = array();
    if(strlen($q) > 0) {
    	$hint = "";
    	foreach ($xml->children() as $pitanje) {
    		$tema = $pitanje->tema;
    		$tekst = $pitanje->tekst;
    		$odgovor = $pitanje->odgovor;
    		if(stristr($tema,$q) || stristr($tekst,$q) || stristr($odgovor,$q)) {
    			$hint = '<a href="search.php?termin='.$q.'">'.$tema.'</a><br>';
                array_push($stringovi,$hint);
    		}
    	}
    }

    if(empty($stringovi)) {
    	$response = "Nema sugestija";
    } else {
    	$response = implode(" ", $stringovi);
    }

    echo $response;
?>