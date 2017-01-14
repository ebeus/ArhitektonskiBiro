<?php
    require 'baza.php';
	if(!isset($_SESSION)) { 
        session_start(); 
    } 
    if(!isset($_SESSION['admin'])) {
    		header("location: index.php");
    		exit();
    }
       	
    if(!isset($_GET['id'])) {
    	header('Refresh: 2; URL=projekti.php');
    	exit("ID Error");
    }
    $table = 'projekti';
	$id_projekta = intval($_GET['id']);
    $_SESSION['id_projekta'] = $id_projekta;
    $polja = array('slikasrc','tekst');
    $projekat = procitaj_id($table,$polja,$id_projekta);
    $_SESSION['edit'] = "true"; 
?>

<!DOCTYPE html> 
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Arhitektonski biro</title>
        <link rel="stylesheet" href="stil.css">
    </head>
    
    <body onload="prikazi(1)">
      <script type="text/javascript" src="skripta.js"></script>
      <div class="naslov"> 
            <a href="index.php"><img id="logo_img" src="logo.png"></a>
            <h3 id="logo_text">Arhitektonski biro</h3>
      </div>

      <div class="wrap_main">
          <div class = "korisnici">
            <p>
                <?php
                    if(!isset($_SESSION['user'])) {
                        echo '<a href="login.php"> Prijava</a>';
                    } else {
                        echo 'Korisnik:<a>' .$_SESSION["user"].'</a>';
                        echo '<a href="logout.php"> (Odjava)</a>';
                    }
                ?>
            </p>
          </div>
        <div class="meni">
            <ul>
                <li><a href="index.php"/>početna</li>
                <li><a href="projekti.php"/>projekti</li>
                <li><a href="usluge.php"/>usluge</li>
                <li><a href="pitanja.php"/>pitanja</li>
                <li><a href="about.php"/>o nama</li>
                <li><a href="kontakt.php"/>kontakt</a></li>    
                <?php
                   if(isset($_SESSION['admin'])) {
                    if($_SESSION['admin'] == true ) {
                        echo '<li><a href="admin.php"/>administracija</a></li>';
                    }
                }
                    
                ?>           
            </ul>
        </div>

        <div id="sadrzaj">


        <div class="edit_form">
        <p>Edit projekta</p>
        <form id="edit_forma" action="save.php" onsubmit="return validateEdit()" name="edit_forma" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>

                <tr>
                	<td>
                	</td>
                	<td>
                		Tekst
                	</td>
                </tr>
                <tr>
                    <td></td>
                    <td><textarea maxlength=2000 cols="100" rows="10" name="tekst" form="edit_forma" text="tekst">
                    	<?php
                            if(!is_null($projekat))
                    		echo $projekat[0]['tekst'];
                    	?>
                    </textarea></td>
                </tr>

                <tr>
                	<td>
                	</td>
                	<td>
                		<?php 
                          if(!is_null($projekat))
                			echo '<img src="'.$projekat[0]['slikasrc'].'"></img>';
                		 ?>
                	</td>
                </tr>

                <tr>
                	<td>Slika:</td>
                	<td><input type="file" name="slika"> </td>
                </tr>

                <tr>
                    <td></td>
                    <td><input type="submit" value="Spremi"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p id="error_msg"></p></td>
                </tr>
            </table>
        </form>

        </div>

      </div>

    </body>
</html>
        
