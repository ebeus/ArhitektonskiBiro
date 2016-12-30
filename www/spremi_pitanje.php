<?php
    include "utility.php";

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xml_pitanja_path = "xml/pitanja.xml";

    $ime_i_prezime = prepare($_POST['Ime']);
    $email = prepare($_POST['email']);
    $tema = prepare($_POST['tema']);
    $tekst = prepare($_POST['tekst']);

    if(strlen($ime_i_prezime) < 5 || strlen($tekst) <5 || strlen($tema) < 5) {
        header('Refresh: 2; URL=pitanja.php');
        exit("Ime, tema ili poruka su prekratki.");
    }

    if(!validateEmail($email)) {
        header('Refresh: 2; URL=pitanja.php');
        exit("Neispravan mail.");
    }

    if(file_exists($xml_pitanja_path)) {
        $xml = simplexml_load_file($xml_pitanja_path) or die ("Error");
        $broj_unosa = count($xml->children());
    } else {
        $broj_unosa = 0;
        $xml = new SimpleXMLElement('<pitanja></pitanja>');
        $xml->addChild('pitanje');
        $xml->pitanje[0]->addChild('imeiprezime');
        $xml->pitanje[0]->addChild('email');
        $xml->pitanje[0]->addChild('tema');
        $xml->pitanje[0]->addChild('tekst');
        $xml->pitanje[0]->addChild('odgovor');
        $xml->asXML($xml_pitanja_path);
    }



    $xml->pitanje[$broj_unosa]->imeiprezime = $ime_i_prezime;
    $xml->pitanje[$broj_unosa]->email = $email;
    $xml->pitanje[$broj_unosa]->tema = $tema;
    $xml->pitanje[$broj_unosa]->tekst = $tekst;
    $xml->pitanje[$broj_unosa]->odgovor = "";
    $xml->asXML($xml_pitanja_path);
    echo "Uspješno dodano!";
    header('Refresh: 2; URL=pitanja.php');
}
?>