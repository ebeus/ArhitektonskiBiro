<?php
	
	function prepare($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}

  function createCSV($xml,$f) {
    $polja = array("imeiprezime","email","tema","poruka");
    fputcsv($f, $polja,',','"');
    foreach ($xml->children() as $kontakt) {
        $val = array($kontakt->imeiprezime,$kontakt->email,$kontakt->tema,$kontakt->poruka);
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