<?php 
	include "utility.php";


    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xml_kontakt_path = "xml/kontakt.xml";

    $ime_i_prezime = prepare($_POST['Ime']);
    $email = prepare($_POST['email']);
    $tema = prepare($_POST['tema']);
    $poruka = prepare($_POST['poruka']);

    if(strlen($ime_i_prezime) < 5 || strlen($tema) < 5 || strlen($poruka) <5) {
        header('Refresh: 2; URL=contact.php');
        exit("Ime, naziv teme ili poruka su prekratki.");
    }

    if(!validateEmail($email)) {
        header('Refresh: 2; URL=contact');
        exit("Neispravan mail.");
    }

    if(file_exists($xml_kontakt_path)) {
    	$xml = simplexml_load_file($xml_kontakt_path) or die ("Error");
    	$broj_unosa = count($xml->children());
    } else {
    	$broj_unosa = 0;
 		$xml = new SimpleXMLElement('<kontakti></kontakti>');
 		$xml->addChild('kontakt');
 		$xml->kontakt[0]->addChild('imeiprezime');
 		$xml->kontakt[0]->addChild('email');
 		$xml->kontakt[0]->addChild('tema');
 		$xml->kontakt[0]->addChild('poruka');
        $xml->asXML($xml_kontakt_path);
    }


    $xml->kontakt[$broj_unosa]->imeiprezime = $ime_i_prezime;
    $xml->kontakt[$broj_unosa]->email = $email;
    $xml->kontakt[$broj_unosa]->tema = $tema;
    $xml->kontakt[$broj_unosa]->poruka = $poruka;
    $xml->asXML($xml_kontakt_path);

    echo "Poruka uspješno poslana!";
    header('Refresh: 2; URL=index.php');
} else {
    header('Refresh: 0; URL=contact.php');
}
?>