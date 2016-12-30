<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    $xml_projekti_path = "xml/projekti.xml";

    if(file_exists($xml_projekti_path)) {
        $xml = simplexml_load_file("xml/projekti.xml") or die ("Error");
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
    
    <body onload="prikazi(1)">
      <script type="text/javascript" src="galerija.js"></script>
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
            <div class="prezentacija">
              <div class="kontejner">
                <div class="prikaz_slike">
                    <img src="./slike/slika1.jpg"></img>
                </div>
                
                <div class="prikaz_slike">
                    <img src="./slike/slika2.jpg"></img>
                </div>
                
                <div class="prikaz_slike">
                    <img src="./slike/slika3.jpg"></img>
                </div>
                <span class="btn_prev" onclick="iduci(-1)">&#10094;</span>
                <span class="btn_next" onclick="iduci(1)">&#10095;</span>
                <br></br>
             </div>
             <div class=tacke>
                <span class="dot" onclick="trenutni(1)"></span>
                <span class="dot" onclick="trenutni(2)"></span>
                <span class="dot" onclick="trenutni(3)"></span>
             </div>
            </div>   
             
                
                
        <?php 


        if(file_exists($xml_projekti_path)) {
            for($i = 0; $i < 4; $i+=2) {
                if($i >= $broj_unosa) 
                 break;
                echo '<div class="red">';
                echo '<div class="projekt">';
                echo '<div class="projekt jedan">';
                echo '<div class="projekt_opis">';
                echo '<p id="kratakOpis">'. $xml->projekat[$i]->tekst. '</p>';
                echo '</div>';
                echo '<div class="projekt_slika">';
                echo '<img src="'.$xml->projekat[$i]->slikasrc.'">';
                echo '</div>';
                echo '</div>';

                

                if(is_object($xml->projekat[$i+1])) {
                    echo '<div class="projekt jedan">';
                    echo '<div class="projekt_opis">';
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
