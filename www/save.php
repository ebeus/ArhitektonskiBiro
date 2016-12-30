<?php 
    if(!isset($_SESSION)) { 
        session_start(); 
    } 
    if(!isset($_SESSION['admin'])) {
            header("location: index.php");
            exit();
    }
    
    $xml_path = "xml/projekti.xml";
    $xml = simplexml_load_file($xml_path) or die ("Error");
    $broj_unosa = count($xml->children());

	$id_projekta = intval($_SESSION['id_projekta']);
	echo $id_projekta;
    if(empty($_POST['tekst'])) {
    	header('Refresh: 2; URL=projekti.php');
    	exit("Nema teksta - izlaz");
    } else {
    	$tekst = htmlspecialchars($_POST['tekst']);
    }

    if(isset($_SESSION['add'])) {
        if($_FILES['slika']['size'] == 0)  {
            echo "Nedostaje fotografija";
            header('Refresh: 3; URL=edit.php?id='.$id_projekta);
            exit();
        }
    }

	if(isset($_FILES['slika']) && $_FILES['slika']['size'] != 0) {
		$file_name = $_FILES['slika']['name'];
        $file_size =$_FILES['slika']['size'];
        $file_tmp =$_FILES['slika']['tmp_name'];
        $file_type=$_FILES['slika']['type'];
        $file_ext=strtolower(end(explode('.',$_FILES['slika']['name'])));
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
         $xml->projekat[$id_projekta]->slikasrc = $path;
         $xml->projekat[$id_projekta]->tekst = $tekst;
         $xml->asXml($xml_path);
      }else{
         print_r($errors);
         if(!isset($_SESSION['add'])) {
            header('Refresh: 3; URL=edit.php?id='.$id_projekta);
         } 
         exit();
      }
	} else {
		
		$xml->projekat[$id_projekta]->tekst = $tekst;
		$xml->asXml($xml_path);
	}
	header("location: projekti.php");
    unset($_SESSION['add']);
?>