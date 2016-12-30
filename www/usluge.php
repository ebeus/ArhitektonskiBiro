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
        
        <div class="narucivanje_form">
        <p>Neki tekst</p>
            <form action="trazi_uslugu.php" method="post" id="naruci_forma" name="usluge_form" onsubmit="return validateUslugeForm()" enctype="multipart/form-data">
                <table>
                    <tr>
                        <td>Ime i prezime:</td>
                        <td><input maxlength=100 type="text" name="Ime"></td>
                    </tr>
                    <tr>
                        <td>E-mail adresa:</td>
                        <td><input maxlength=256 type="text" name="email"></td>
                    </tr>
                    <tr>
                        <td>Vrsta usluge:</td>
                        <td><select name="vrstausluge">
                                <option value="projektovanje">Projektovanje</option>
                                <option value="renoviranje">Renoviranje</option>
                                <option value="uredjenje">Uređenje interijera</option>
                            </select>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>Kvadratura:</td>
                        <td><input type="number" name="kvadratura"></td>
                    </tr>
                    
                    <tr>
                        <td>Poruka:</td>
                        <td><textarea maxlength=1000 cols="50" rows="5" name="poruka" id="poruka" text="Upisite poruku"></textarea></td>
                    </tr>
                    <tr>
                        <td>Prilog:</td>
                        <td><input type="file" name="prilog" id="prilog"></td>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Posalji"></td>
                    </tr>
                    
                    <tr>
                        <td></td>
                        <td><p id="error_msg"></p></td>
                    </tr>
                </table>
            </form>
       
        </div>
       </div>
       </div>
    <footer>
        <a href="login.php">login</a>
    </footer>
</body>

</html>