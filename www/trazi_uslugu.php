<?php 
	include "/utility.php";
    require '/baza.php';

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    $table = 'usluge';

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

    $unosi = array('ime' => $ime_i_prezime, 'email' => $email, 'vrstausluge' => $vrstausluge, 'kvadratura' => $kvadratura, 'poruka' => $poruka);   //wait
    $attachmentpath = '';



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
       	  $attachmentpath = $path;
      	}else{
       	  print_r($errors);
       	  header('Refresh: 2; URL=usluge.php');
       	  exit();
      }


	} 


    $unosi['path'] = $attachmentpath;
    unos($table,$unosi);
    echo "Uspješno dodano!";
    header('Refresh: 3; URL=index.php');
}
?>
