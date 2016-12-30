<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    $xml_projekti_path = "xml/projekti.xml";

    if(file_exists($xml_projekti_path)) {
        $xml = simplexml_load_file($xml_projekti_path) or die ("Error");
        $broj_unosa = count($xml->children());
    }
?>

<!DOCTYPE html> 
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Arhitektonski biro</title>
        <link rel="stylesheet" href="stil.css">
    </head>
    
    <body>
      <div class="naslov"> 
            <a href="index.html"><img id="logo_img" src="logo.png"></a>
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
        
        <?php 
        if(isset($_SESSION['admin'])) {
            echo '<a href="add.php"><img id="kontrola" src="./ikone/add.png"></img></a>';
        }
        if(file_exists($xml_projekti_path)) {

            for($i = 0; $i < $broj_unosa; $i+=2) {
                echo '<div class="red">';
                echo '<div class="projekt">';
                echo '<div class="projekt jedan">';
                echo '<div class="projekt_opis">';

                if(isset($_SESSION['admin'])) {
                    echo '<div class="edit_icons">';
                    
                    echo '<a href="edit.php?id='.$i.'"><img id="kontrola" src="./ikone/edit.png"></img></a>';
                    echo '<a href="remove.php?id='.$i.'"><img id="kontrola" src="./ikone/remove.png"></img></a>';
                    echo '</div>';
                }
                echo '<p id="kratakOpis">'. $xml->projekat[$i]->tekst. '</p>';
                echo '</div>'; //DIV KRATAK OPIS
                echo '<div class="projekt_slika">';
                echo '<img src="'.$xml->projekat[$i]->slikasrc.'">';
                echo '</div>';
                echo '</div>';

                

                if(is_object($xml->projekat[$i+1])) {
                    echo '<div class="projekt jedan">';
                    echo '<div class="projekt_opis">';

                    if(isset($_SESSION['admin'])) {
                        echo '<div class="edit_icons">';
                        echo '<a href="edit.php?id='.($i+1).'"><img id="kontrola" src="./ikone/edit.png"></img></a>';
                        echo '<a href="remove.php?id='.($i+1).'"><img id="kontrola" src="./ikone/remove.png"></img></a>';
                        echo '</div>';
                    }

                    echo '<p id="kratakOpis">'. $xml->projekat[$i+1]->tekst. '</p>';
                    echo '</div>';
                    echo '<div class="projekt_slika">';
                    echo '<img src="'.$xml->projekat[$i+1]->slikasrc.'">';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                
                }
                
                echo '</div>';

            }
        }
        ?>
            </div>
</body>

</html>