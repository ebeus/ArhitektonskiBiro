<?php
	include "utility.php";
    require 'baza.php';
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    
    if(!isset($_SESSION['admin'])) {
            header("location: index.php");
            exit();
    }
    $table = 'pitanja';
  

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
    $polja = array('odgovor' => $odgovor);
    update_by_id($table,$polja,$id_pitanja);


    echo "Uspješno dodano!";
    header('Refresh: 5; URL=pitanja.php');
?>
