<?php
    if(!isset($_SESSION)) { 
        session_start(); 
    } 


    $host = getenv('OPENSHIFT_MYSQL_HOST');
	$db_name = 'arhbirobaza';
	$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
	$user = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
	$password= getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
    
    $db = new PDO('mysql:dbname='.$db_name.';host='.$host.';port='.$port,$user,$password);
    
    /*
        $unosi -> asocijativni niz, polje u tabeli => vrijednost
    */
    function unos($table_name, $unosi) {
        global $db;
        $j = 0;
        $query = 'INSERT INTO '.$table_name.' ('; 
        foreach ($unosi as $k => $v) {
            $query .= $k.', ';
            $j++;
        }

        $query = rtrim($query,', ');

        $query .= ') VALUES (';

        for($i = 0; $i < $j; $i++) {
            $query .= '?, ';
        }

        $query = rtrim($query,', ');
        $query .=');';
        $upit = $db->prepare($query);
        
        $i = 1;
        
        foreach ($unosi as $k => $v) {
            $upit->bindValue($i,$v);
            $i++;
        }
        
        $upit->execute();
    }


    function procitaj($table_name, $polja) {
        global $db;
        $query = 'SELECT ';
        foreach ($polja as $val) {
            $query .= $val.', ';
        }
        $query = rtrim($query,', ');
        
        $query .= ' FROM '.$table_name.';';
        $upit = $db->prepare($query);
        $upit->execute();
        return $upit->fetchAll();
        
    }

    function procitaj_id($table_name, $polja,$id) {
        global $db;
        $query = 'SELECT ';
        foreach ($polja as $val) {
            $query .= $val.', ';
        }
        $query = rtrim($query,', ');
        
        $query .= ' FROM '.$table_name.' WHERE id='.$id.';';
        $upit = $db->prepare($query);
        $upit->execute();
        return $upit->fetchAll();
        
    }

    function update_by_id($table_name, $polja,$id) {
        global $db;
        $query = 'UPDATE '.$table_name. ' ';
        foreach ($polja as $k => $v) {
            $query .= 'SET '.$k.'="'.$v.'",';
        }
        $query = rtrim($query,', ');
        $query .= ' WHERE id='.$id.';';
        $upit = $db->prepare($query);
        $upit->execute();
    }

    function delete_by_id($table_name,$id) {
        global $db;
        $query = 'DELETE FROM ';
        $query .= $table_name .' WHERE id=';
        $query .= $id.';';
        $upit = $db->prepare($query);
        $upit->execute();
    }

    function broj_unosa($table_name) {
        global $db;
        $query = 'SELECT COUNT(*) as ukupno FROM ';
        $query .= $table_name. ';';
        $upit = $db->prepare($query);
        $upit->execute();
        $upit->fetchAll();
        return $upit['ukupno'];
    }

?>
