<?php 
	include "utility.php";


    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ime_i_prezime = prepare($_POST['Ime']);
    $email = prepare($_POST['email']);
    $vrstausluge = prepare($_POST['vrstausluge']);
    $kvadratura = (int)prepare($_POST['kvadratura']);
    $poruka = prepare($_POST['poruka']);

    if(strlen($ime_i_prezime) < 5 || strlen($poruka) <5) {
        header('Refresh: 2; URL=usluge.php');
        exit("Ime ili poruka su prekratki.");
    }

    if(!validateEmail($email)) {
        header('Refresh: 2; URL=usluge.php');
        exit("Neispravan mail.");
    }

    if(!is_numeric($kvadratura) || $kvadratura < 0 || $kvadratura>1000000) {
        header('Refresh: 2; URL=usluge.php');
        exit("Nevazeca kvadratura.");
    }

    $xml_usluga_path = "xml/usluge.xml";

    if(file_exists($xml_usluga_path)) {
    	$xml = simplexml_load_file($xml_usluga_path) or die ("Error");
    	$broj_unosa = count($xml->children());
    } else {
    	$broj_unosa = 0;
 		$xml = new SimpleXMLElement('<usluge></usluge>');
 		$xml->addChild('usluga');
 		$xml->usluga[0]->addChild('imeiprezime');
 		$xml->usluga[0]->addChild('email');
 		$xml->usluga[0]->addChild('vrstausluge');
 		$xml->usluga[0]->addChild('kvadratura');
 		$xml->usluga[0]->addChild('poruka');
 		$xml->usluga[0]->addChild('attachmentpath');
        $xml->asXML($xml_usluga_path);
    }



    $xml->usluga[$broj_unosa]->imeiprezime = $ime_i_prezime;
    $xml->usluga[$broj_unosa]->email = $email;
    $xml->usluga[$broj_unosa]->vrstausluge = $vrstausluge;
    $xml->usluga[$broj_unosa]->kvadratura = $kvadratura;
    $xml->usluga[$broj_unosa]->poruka = $poruka;
	$xml->usluga[$broj_unosa]->attachmentpath = "";

	if(isset($_FILES['prilog']) && $_FILES['prilog']['size'] != 0) {
		$file_name = $_FILES['prilog']['name'];
        $file_size = $_FILES['prilog']['size'];
        $file_tmp = $_FILES['prilog']['tmp_name'];
        $file_type = $_FILES['prilog']['type'];
        $file_ext = strtolower(end(explode('.',$_FILES['prilog']['name'])));
        $expensions= array("pdf","zip","rar","7z","jpeg","jpg","png");
    

    	if(in_array($file_ext,$expensions)=== false){
        	$errors[]="Ekstenzija nije dozvoljena";
    	}
      
    	if($file_size > 10485760){
        	$errors[]='Fajl mora biti manji od 10 MB';
    	}

    	if(empty($errors)==true){
       	  move_uploaded_file($file_tmp,"uploads/".$file_name);
       	  $path = "uploads/".$file_name;
       	  $xml->usluga[$broj_unosa]->attachmentpath = $path;
      	}else{
       	  print_r($errors);
       	  header('Refresh: 2; URL=usluge.php');
       	  exit();
      }


	} 

    $xml->asXML($xml_usluga_path);

    echo "Uspješno dodano!";
    header('Refresh: 3; URL=index.php');
}
?>