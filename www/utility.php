<?php
	
	function prepare($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}

  function createCSV($rezultat,$f) {
    $polja = array("id","imeiprezime","email","tema","poruka");
    fputcsv($f, $polja,',','"');
    foreach ($rezultat as $kontakt) {
        $val = array($kontakt['id'],$kontakt['ime'],$kontakt['email'],$kontakt['tema'],$kontakt['poruka']);
        fputcsv($f, $val,',','"');
      }
  }

  function validateEmail($email) {
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    return true;
  }

?>