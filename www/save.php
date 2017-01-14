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

	$id_projekta = intval($_SESSION['id_projekta']);

    if(empty($_POST['tekst'])) {
    	header('Refresh: 2; URL=projekti.php');
    	exit("Nema teksta - izlaz");
    } else {
    	$tekst = htmlspecialchars($_POST['tekst']);
    }

    if(isset($_SESSION['edit']) && !isset($_SESSION['add'])) {
        $rezultat = procitaj_id($table,array('id', 'slikasrc', 'tekst'),$id_projekta);
        $id_projekta = $rezultat['id'];
    }
/*
    if(isset($_SESSION['add'])) {
        if($_FILES['slika']['size'] == 0)  {
            echo "Nedostaje fotografija";
            header('Refresh: 3; URL=edit.php?id='.$id_projekta);
            exit();
        }
    }
*/
    $unosi = array('slikasrc' => '' , 'tekst' => $tekst);
	if(isset($_FILES['slika']) && $_FILES['slika']['size'] != 0) {
		$file_name = $_FILES['slika']['name'];
        $file_size =$_FILES['slika']['size'];
        $file_tmp =$_FILES['slika']['tmp_name'];
        $file_type=$_FILES['slika']['type'];
        $tmp = explode('.',$_FILES['slika']['name']);
        $file_ext=strtolower(end($tmp));
        $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="Ekstenzija nije dozvoljena";
      }
      
      if($file_size > 2097152){
         $errors[]='Fajl mora biti manji od 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"slike/".$file_name);
         $path = "slike/".$file_name;
         $unosi['slikasrc'] = $path;
      }else{
         print_r($errors);
         if(!isset($_SESSION['add'])) {
            header('Refresh: 3; URL=edit.php?id='.$id_projekta);
         } 
         exit();
      }
	} else {
		
	}

    if(isset($_SESSION['add']) && !isset($_SESSION['edit'])) {
        unos($table,$unosi);
        unset($_SESSION['add']);
    }

    if(isset($_SESSION['edit']) && !isset($_SESSION['add'])) {
        update_by_id($table,$unosi,$id_projekta);
        unset($_SESSION['edit']);
    }

    header("location: projekti.php");

?>
