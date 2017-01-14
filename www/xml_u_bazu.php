<?php
function spremixml() {

	$host = 'localhost';
	$db_name = 'arhbirobaza';
	$user = 'wtspirala';
	$password= '123456';
	$db = new PDO('mysql:host=localhost; dbname=arhbirobaza; charset=utf8','wtspirala','123456');

	$xml_kontakt_path = "xml/kontakt.xml";
	$xml_usluge_path = "xml/usluge.xml";
    $xml_pitanja_path = "xml/pitanja.xml";
    $xml_projekti_path = "xml/projekti.xml";
    $xml_korisnici_path = "xml/admin.xml";

    $tabela_kontakt = 'kontakt';
    $tabela_korisnici = 'korisnici';
    $tabela_pitanja = 'pitanja';
    $tabela_projekti = 'projekti';
    $tabela_usluge = 'usluge';
    $citaj_sve = array('' => '*' );

	if(file_exists($xml_kontakt_path)) {
    	$xml = simplexml_load_file($xml_kontakt_path) or die ("Error");
    }

	$rezultat = procitaj($tabela_kontakt,$citaj_sve);
	foreach ($xml->children() as $kontakt) {
		$query = 'INSERT INTO kontakt (ime, email, tema, poruka) VALUES (?, ? ,? ,?);';
		$postoji = false;
		//odose performanse
		foreach ($rezultat as $kontakt_db) {
			if($kontakt_db['email'] == $kontakt->email && $kontakt_db['poruka'] == $kontakt->poruka) {	//mogu se provjeriti i ostala polja za duplikate
				$postoji = true;
				break;
			}
		}

		if(!$postoji) {
			$upit = $db->prepare($query);
			$upit->bindValue(1,$kontakt->imeiprezime,PDO::PARAM_STR);
			$upit->bindValue(2,$kontakt->email,PDO::PARAM_STR);
			$upit->bindValue(3,$kontakt->tema,PDO::PARAM_STR);
			$upit->bindValue(4,$kontakt->poruka,PDO::PARAM_STR);
			$upit->execute();
		}
	}

	if(file_exists($xml_pitanja_path)) {
    	$xml = simplexml_load_file($xml_pitanja_path) or die ("Error");
    }

	$rezultat = procitaj($tabela_pitanja,$citaj_sve);
	foreach ($xml->children() as $pitanje) {
		$postoji = false;
		//odose performanse
		foreach ($rezultat as $pitanja_db) {
			if($pitanja_db['email'] == $pitanje->email && $pitanja_db['pitanje'] == $pitanje->tekst) {	//mogu se provjeriti i ostala polja za duplikate
				$postoji = true;
				break;
			}
		}

		if(!$postoji) {
			$query = 'INSERT INTO pitanja (ime, email, tema, pitanje, odgovor) VALUES (?, ?, ?, ?, ?);';
			$upit = $db->prepare($query);
			$upit->bindValue(1,$pitanje->imeiprezime,PDO::PARAM_STR);
			$upit->bindValue(2,$pitanje->email,PDO::PARAM_STR);
			$upit->bindValue(3,$pitanje->tema,PDO::PARAM_STR);
			$upit->bindValue(4,$pitanje->tekst,PDO::PARAM_STR);
			$upit->bindValue(5,$pitanje->odgovor,PDO::PARAM_STR);
			$upit->execute();
		}
	}


	if(file_exists($xml_usluge_path)) {
    	$xml = simplexml_load_file($xml_usluge_path) or die ("Error");
    }

	$rezultat = procitaj($tabela_usluge,$citaj_sve);
	foreach ($xml->children() as $usluge) {

		$postoji = false;
		//odose performanse
		foreach ($rezultat as $usluge_db) {
			if($usluge_db['email'] == $usluge->email && $usluge_db['poruka'] == $usluge->poruka) {	//mogu se provjeriti i ostala polja za duplikate
				$postoji = true;
				break;
			}
		}

		if(!$postoji) {
			$query = "INSERT INTO usluge (ime, email, vrstausluge, kvadratura, poruka, path) VALUES (?, ?, ?, ?, ?, ?);";
			$upit = $db->prepare($query);
			$upit->bindValue(1,$usluge->imeiprezime,PDO::PARAM_STR);
			$upit->bindValue(2,$usluge->email,PDO::PARAM_STR);
			$upit->bindValue(3,$usluge->vrstausluge,PDO::PARAM_STR);
			$upit->bindValue(4,$usluge->kvadratura,PDO::PARAM_INT);
			$upit->bindValue(5,$usluge->poruka,PDO::PARAM_STR);
			$upit->bindValue(6,$usluge->attachmentpath,PDO::PARAM_STR);
			$upit->execute();
		}
	}

	if(file_exists($xml_projekti_path)) {
		$xml = simplexml_load_file($xml_projekti_path) or die ("Error");
	}

	$rezultat = procitaj($tabela_projekti,$citaj_sve);
	foreach ($xml->children() as $projekti) {
		$postoji = false;
		//odose performanse
		foreach ($rezultat as $projekti_db) {
			if($projekti_db['slikasrc'] == $projekti->slikasrc && $projekti_db['tekst'] == $projekti->tekst) {	//mogu se provjeriti i ostala polja za duplikate
				$postoji = true;
				break;
			}
		}

		if(!$postoji) {
			$query = "INSERT INTO projekti (slikasrc, tekst) VALUES (?, ?) ;";

			$upit = $db->prepare($query);
			$upit->bindValue(1,$projekti->slikasrc,PDO::PARAM_STR);
			$upit->bindValue(2,$projekti->tekst,PDO::PARAM_STR);
			$upit->execute();
		}
	}

	if(file_exists($xml_korisnici_path)) {
    	$xml = simplexml_load_file($xml_korisnici_path) or die ("Error");
    }
	
	$rezultat = procitaj($tabela_korisnici,$citaj_sve);
	foreach ($xml->children() as $korisnici) {
		$postoji = false;

		foreach ($rezultat as $korisnici_db) {
			if($korisnici_db['username'] == $korisnici->username && $korisnici_db['email'] == $korisnici->email) {	
				$postoji = true;
				break;
			}
		}

		if(!$postoji) {
			$query = "INSERT INTO korisnici (username, password, email) VALUES (?, ?, ?) ;";
			echo $query.'\n';
			$upit = $db->prepare($query);
			$upit->bindValue(1,$korisnici->username,PDO::PARAM_STR);
			$upit->bindValue(2,$korisnici->password,PDO::PARAM_STR);
			$upit->bindValue(3,$korisnici->email,PDO::PARAM_STR);
			$upit->execute();
		}


	}
}
?> 