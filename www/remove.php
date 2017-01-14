<?php 
    require '/baza.php';

    $table = 'projekti';

	if(!isset($_SESSION)) { 
        session_start(); 
    } 

    if(!isset($_SESSION['admin'])) {
    		header("location: index.php");
    		exit();
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

	delete_by_id($table,$id_projekta);
    header("location: projekti.php");
?>
