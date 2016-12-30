<?php
	include 'utility.php';
	require('/lib/fpdf/fpdf.php');

	if(!isset($_SESSION)) { 
        session_start(); 
    } 

    if(!isset($_SESSION['admin'])) {
            header("location: index.php");
            exit();
    }

    $xml_kontakt_path = "xml/kontakt.xml";
    $xml_usluge_path = "xml/usluge.xml";
    $xml_pitanja_path = "xml/pitanja.xml";

    $csv_path = "csv/kontakt.csv";
    if(isset($_GET['generisi']) && $_GET['generisi'] == "true") {
    	if(isset($_GET['tip']) && $_GET['tip'] == "csv") {
    			$xml = simplexml_load_file($xml_kontakt_path);
    			$_f = fopen($csv_path, 'w');
    			createCSV($xml,$_f);
    			fclose($_f);

                header('Pragma: public');
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="kontakt.csv"');
                header("Cache-Control: no-cache, must-revalidate");
                readfile('csv/kontakt.csv');
                exit;

    	}else if(isset($_GET['tip']) && $_GET['tip']== "pdf") {
    		$pdf = new FPDF("p","mm","A4");
    		$pdf->AddPage();
    		$pdf->SetTitle('Izvjestaj');
    		$pdf->SetFont('Times');

    		$xml = simplexml_load_file($xml_usluge_path);

    		$pdf->SetY(120);
    		$pdf->SetFont('Times','',20);
    		$pdf->Cell(0,0,"Izvjestaj - Upiti",0,0,"C");
    		$pdf->AddPage();
    		$posY = 40;
    		$pdf->SetY($posY);
    		$pdf->SetFont('Times','',11);
    		foreach ($xml->children() as $usluge) {
    			
    			$pdf->SetX(30);
    			$pdf->Cell(30,8,"Ime i prezime:" ,1,0,"L");
    			$pdf->Cell(120,8,$usluge->imeiprezime,1,2,"L");

    			$pdf->SetX(30);
    			$pdf->Cell(30,8,"Email:" ,1,0,"L");
    			$pdf->Cell(120,8,$usluge->email,1,2,"L");

    			$pdf->SetX(30);
    			$pdf->Cell(30,8,"Vrsta usluge:" ,1,0,"L");
    			$pdf->Cell(120,8,$usluge->vrstausluge,1,2,"L");

    			$pdf->SetX(30);
    			$pdf->Cell(30,8,"Kvadratura:" ,1,0,"L");
    			$pdf->Cell(120,8,$usluge->kvadratura,1,2,"L");

    			$pdf->SetX(30);
    			$pdf->Cell(30,8,"Poruka:" ,1,0,"L");
    			$pdf->MultiCell(120,8,$usluge->poruka,1,"L");

    			$pdf->Cell(4,7,"",0,2,"C");
    		}
    		$pdf->Output();



    	} else {

    	}

        if($_SERVER['REQUEST_METHOD'] === "POST") {

        }
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
            <div class = "admin_panel">
    	       <a href="admin.php?generisi=true&tip=csv">CSV Kontakt</a><br>
    	       <a href="admin.php?generisi=true&tip=pdf">PDF Izvještaj</a>

               <div class="admin_pitanja">
               <div class="wrap_pitanja">
                    <?php 
                        if(file_exists($xml_pitanja_path)) {
                            $xml = simplexml_load_file($xml_pitanja_path);
                            $i = 0;
                            foreach ($xml->children() as $pitanje) {

                            
                            echo '<div class="wrap_pitanje">';
                            echo '<div class="edit_icons">';
                    
                            echo '<a href="remove_post.php?id='.$i.'"><img id="kontrola" src="./ikone/remove.png"></img></a>';
                            echo '</div>';
                            echo '<br>';

                            echo '<div class="info">';
                            echo '<p>'.$pitanje->imeiprezime.'</p>';
                            echo '<a href="mailto:'.$pitanje->email.'?Subject='.$pitanje->tema.' target="_top">Odgovori na mail</a>';
                            echo '</div>';


                            echo '<div class="naslov">';
                            echo '<h4>'.$pitanje->tema.'</h4>';
                            echo '</div>';

                            echo '<div class="pitanje">';
                            echo '<p>'.$pitanje->tekst.'</p>';
                            echo '</div>';

                            echo '<div class="odgovor">';
                            echo '<p>'.$pitanje->odgovor.'</p>';
                            echo '</div>';

                            echo '<form action="spremi_odgovor.php" method="post">';
                            echo '<textarea maxlength=100 cols="100" rows="10" name="tekstodgovora">';
                            echo $pitanje->odgovor;
                            echo '</textarea>';

                            echo '<input type="hidden" name="id_pitanja" value="'.$i.'"></input>';


                            echo '<input type="submit" value="Spremi">';
                            echo '</form>';
                            echo '<br>';
                            $i++;
                        }
                        }
                    ?>
               </div>
               </div>
            </div>
        </div>

    </div>




    </body>
</html>
