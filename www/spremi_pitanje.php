<?php
    include "utility.php";
    require 'baza.php';
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    $table = 'pitanja';

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

    $unosi = array('ime' => $ime_i_prezime, 'email' => $email, 'tema' => $tema, 'pitanje' => $tekst );

    unos($table,$unosi);


    echo "Uspješno dodano!";
    header('Refresh: 2; URL=pitanja.php');
}
?>
