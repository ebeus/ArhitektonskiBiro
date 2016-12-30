<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<!DOCTYPE html> 
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="script.js"></script>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Arhitektonski biro</title>
        <link rel="stylesheet" href="stil.css">
    </head>
    
    <body>
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
                        echo '<a href="admin.php"> (Odjava)</a>';
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
                <div class="wrap_about">
        <div class="red">
            <div class="about">
                <h3 id="naslov_p">PODACI O KOMPANIJI</h3>
                <p id="detalji"></p>
                <p id="Naziv_kompanije">hexa</p>
                <p id="adresa_sjedista">Neka adresa, Sarajevo, Bosna i Hercegovina</p>
                <p id="telefon">+387 33 123 456</p>
                <p id="email">arhitektonskibiro@provider.ba</p>
            </div>
            
            <div class="poslovnice">
                <div class="poslovnica">
                    <h4>Poslovnica Zagreb</h4>
                    <p id="adresa_poslovnice">Adresa 2, Zagreb, Hrvatska</p>
                    <p id="telefon_poslovnice">+385 12 345 678</p>
                    <p id="email_poslovnice">arhitektonski_biro@provider.hr</p>
                    <div class="mapa">
                    </div>
                </div>
            </div>
            
            </div>
        </div>
        </div>
    </body>

</html>
