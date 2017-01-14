<?php
    require 'baza.php';
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    $tabela = 'pitanja';
    $sve = array('' => '*');
    $rezultat = procitaj($tabela,$sve);

    $q = htmlspecialchars($_GET["q"]);
    $stringovi = array();
    if(strlen($q) > 0) {
    	$hint = "";
    	foreach ($rezultat as $pitanje) {
    		$tema = $pitanje['tema'];
    		$tekst = $pitanje['pitanje'];
    		$odgovor = $pitanje['odgovor'];
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
