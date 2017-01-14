<?php
    require '/baza.php';
    $table = 'pitanja';
	if(!isset($_SESSION)) { 
        session_start(); 
    } 

    if(!isset($_SESSION['admin'])) {
            header("location: index.php");
            exit();
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

    delete_by_id($table,$id_pitanja);
    header("location: admin.php");
?>
