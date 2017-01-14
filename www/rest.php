<?php 	
	require 'baza.php';
	function zag() {
    	header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    	header('Content-Type: text/html');
    	header('Access-Control-Allow-Origin: *');
	}
	$sve = array('' => '*');
	function rest_get($request, $data) { 
		global $table; global $sve;
		$id = $data['id'];
		$rezultat = procitaj_id($table,$sve,$id);
		print "{ \"pitanja\": " .json_encode($rezultat) ."}";

	}

	function rest_post($request, $data) { 
		global $table;

		if(isset($data['key']) || $data['key'] == "ABCDEFGHIJK") {
			if(!empty($data['ime']) && !empty($data['email']) && !empty($data['tema']) && !empty($data['pitanje'])) {
				$unosi = array('ime' => $data['ime'], 'email'=>$data['email'], 'tema' => $data['tema'], 'pitanje' => $data['pitanje'], 'odgovor' => $data['odgovor']);
				unos($table,$unosi);
				print "Success.";
			} else {
				print "Neispravni parametri";
			}
		} else {
			print "Invalid key";
		}
	}

	function rest_delete($request,$data) {
		global $table;
		if(isset($data['key']) || $data['key'] == "ABCDEFGHIJK" && isset($data['id'])) {
			delete_by_id($table,$data['id']);
			print('Izvrseno');
	 	} else {
	 		print "Invalid key";
	 	}
	}

	function rest_put($request, $data) { 
		if($key == "ABCDEFGHIJK") {

		}
	}
	function rest_error($request) { }


	
	$method  = $_SERVER['REQUEST_METHOD'];
	$request = $_SERVER['REQUEST_URI'];
switch($method) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        zag(); $data = $put_vars; rest_put($request, $data); break;
    case 'POST':
        zag(); $data = $_POST; rest_post($request, $data); break;
    case 'GET':
        zag(); $data = $_GET; rest_get($request, $data); break;
    case 'DELETE':
        zag(); rest_delete($request,$data); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}
?>
