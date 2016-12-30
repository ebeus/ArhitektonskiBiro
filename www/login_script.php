<?php //pass je šifra
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	$error = '';
	$username = '';
	$password = '';
	$found = false;
	$admin = false;
	if (empty($_POST['username']) || empty($_POST['password'])) {
		$error = "Username ili password nisu uneseni.";
	} else {
		$username = data_filter($_POST['username']);
		$password = data_filter($_POST['password']);
		$xml = simplexml_load_file("xml/admin.xml") or die ("Error");
		foreach ($xml->children() as $korisnici) {
			if($korisnici->username == $username 
				&& $korisnici->password == md5($password)) {
					$found = true;
					if($korisnici['category'] == "Admin") {
						$admin == true;
						$_SESSION['admin'] = true;
					}
					break;
			}
		}

		if($found) {
			$_SESSION['user'] = $username;			
			header("location: index.php");
		} else {
			$error = "Nevažeći username/password.";
		}

	}

	function data_filter($data)
	{
		$data = htmlspecialchars($data);
		return $data;
	}
?>