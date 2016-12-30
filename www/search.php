<?php
    include 'utility.php';
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    
    $xml_pitanja_path = "xml/pitanja.xml";
    if(file_exists($xml_pitanja_path)) {
        $xml = simplexml_load_file($xml_pitanja_path) or die ("Error");
        $broj_unosa = count($xml->children());
    }

    if(isset($_GET['termin'])) {
        $termin = prepare($_GET['termin']);
    } else {

    }
?>

<!DOCTYPE html> 
<html>
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="script.js"></script>
        <script type="text/javascript" src="search.js"></script>
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
        <div class="pretraga">
            <form action="search.php" method="get" id="pretraga" onsubmit="return validateSearch()" name="search_form">
                <table>
                    <tr>
                        <td><p id="error_msg_pretraga"></p></td>
                        <td><input type="text" maxlength="150" name="termin" onkeyup="prikaziRezultat(this.value)"></td>
                        <td><input type="submit" value="Traži"></td>
                    </tr>
                    <tr>
                        <td>

                        </td>
                        <td>
                            <div id="livesearch">

                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        
        <div class="wrap_pitanja">
        <?php 
            if(file_exists($xml_pitanja_path)) {
                foreach ($xml->children() as $pitanje) {

                    if(stristr($pitanje->tekst,$termin) || stristr($pitanje->tema,$termin) || stristr($pitanje->odgovor, $termin)) {
                    echo '<div class="wrap_pitanje">';
                    echo '<div class ="naslov">';
                    echo '<h4>'.$pitanje->tema.'</h4>';
                    echo '</div>';

                    echo '<div class="pitanje">';
                    echo '<p>'.$pitanje->tekst.'</p>';
                    echo '</div>';

                    echo '<div class="odgovor">';
                    echo '<p>'.$pitanje->odgovor.'</p>';
                    echo '</div>';
                  }
                }
            }
        ?>
        </div>
        </div>
    

     </div>
    </div>

    </body>

</html>
