<?php 
	include "utility.php";
    require 'baza.php';

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    $table = 'kontakt';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

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

    $unosi = array('ime' => $ime_i_prezime, 'email' => $email, 'tema'=>$tema,'poruka' => $poruka);
    unos($table,$unosi);
    echo "Poruka uspješno poslana!";
    header('Refresh: 2; URL=index.php');
} else {
    header('Refresh: 0; URL=contact.php');
}
?>