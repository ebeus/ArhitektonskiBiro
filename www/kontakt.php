<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

?>

<!DOCTYPE html> 
<html>
    <head>
        <script type="text/javascript" src="script.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Arhitektonski biro</title>
        <link rel="stylesheet" href="stil.css">
    </head>
    
    <body>
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
     <div class="contact_form">
        <p>Upišite vaše podatke i kontaktirajte nas.</p>
        <form id="kontaktforma" action="send_contact.php" onsubmit="return validateContactForm()" name="kontakt_forma" method="post" onclick="restore_podataka()">
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>Ime i prezime:</td>
                    <td><input maxlength=100 type="text" name="Ime" onload="restore_podataka()"></td>
                </tr>
                <tr>
                    <td>E-mail adresa:</td>
                    <td><input maxlength=256 type="text" name="email"></td>
                </tr>
                <tr>
                    <td>Tema:</td>
                    <td><input maxlength=50 type="text" name="tema"></td>
                </tr>
                <tr>
                    <td>Poruka:</td>
                    <td><textarea maxlength=1000 cols="50" rows="5" name="poruka" form="kontaktforma" text="Upisite poruku"></textarea></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td><input type="submit" value="Posalji" onclick="spremi_podatke()"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><p id="error_msg"></p></td>
                </tr>
            </table>
        </form>
     </div>
</div>


        <footer>
            <a href="login.php">login</a>
        </footer>
    </body>

</html>
