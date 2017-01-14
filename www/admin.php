<?php
    require('/lib/fpdf/fpdf.php');
	include '/utility.php';
    include '/xml_u_bazu.php';
    require '/baza.php';
	
	if(!isset($_SESSION)) { 
        session_start(); 
    } 

    if(!isset($_SESSION['admin'])) {
            header("location: index.php");
            exit();
    }

    $table_pitanja = 'pitanja';
    $table_usluge = 'usluge';
    $table_kontakt = 'kontakt';

    if(isset($_GET['spremiubazu']) && $_GET['spremiubazu'] == "true") {
            spremixml();
    }

    $citaj_sve = array('' => '*' );
    $rezultat_pitanja = procitaj($table_pitanja,$citaj_sve);

    $csv_path = "csv/kontakt.csv";
    if(isset($_GET['generisi']) && $_GET['generisi'] == "true") {
    	if(isset($_GET['tip']) && $_GET['tip'] == "csv") {
                $rezultat_kontakt = procitaj($table_kontakt,$citaj_sve);
    			$_f = fopen($csv_path, 'w');
    			createCSV($rezultat_kontakt,$_f);
    			fclose($_f);

                header('Pragma: public');
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="kontakt.csv"');
                header("Cache-Control: no-cache, must-revalidate");
                readfile('csv/kontakt.csv');
                exit;

    	}else if(isset($_GET['tip']) && $_GET['tip']== "pdf") {
            $rezultat_usluge = procitaj($table_usluge,$citaj_sve);
            ob_start();
    		$pdf = new FPDF("p","mm","A4");
    		$pdf->AddPage();
    		$pdf->SetTitle('Izvjestaj');
    		$pdf->SetFont('Times');


    		$pdf->SetY(120);
    		$pdf->SetFont('Times','',20);
    		$pdf->Cell(0,0,"Izvjestaj - Upiti",0,0,"C");
    		$pdf->AddPage();
    		$posY = 40;
    		$pdf->SetY($posY);
    		$pdf->SetFont('Times','',11);
    		foreach ($rezultat_usluge as $usluge) {
    			
    			$pdf->SetX(30);
    			$pdf->Cell(30,8,"Ime i prezime:" ,1,0,"L");
    			$pdf->Cell(120,8,$usluge['ime'],1,2,"L");

    			$pdf->SetX(30);
    			$pdf->Cell(30,8,"Email:" ,1,0,"L");
    			$pdf->Cell(120,8,$usluge['email'],1,2,"L");

    			$pdf->SetX(30);
    			$pdf->Cell(30,8,"Vrsta usluge:" ,1,0,"L");
    			$pdf->Cell(120,8,$usluge['vrstausluge'],1,2,"L");

    			$pdf->SetX(30);
    			$pdf->Cell(30,8,"Kvadratura:" ,1,0,"L");
    			$pdf->Cell(120,8,$usluge['kvadratura'],1,2,"L");

    			$pdf->SetX(30);
    			$pdf->Cell(30,8,"Poruka:" ,1,0,"L");
    			$pdf->MultiCell(120,8,$usluge['poruka'],1,"L");

    			$pdf->Cell(4,7,"",0,2,"C");
    		}
    		$pdf->Output();
            ob_end_flush(); 


    	} else {

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
    	       <a href="admin.php?generisi=true&tip=pdf">PDF Izvještaj</a><br>
               <a href="admin.php?spremiubazu=true">XML -&gt BAZA</a>
               <div class="admin_pitanja">
               <div class="wrap_pitanja">
                    <?php 
                        foreach ($rezultat_pitanja as $pitanje) {
                            echo '<div class="wrap_pitanje">';
                            echo '<div class="edit_icons">';
                    
                            echo '<a href="remove_post.php?id='.$pitanje['id'].'"><img id="kontrola" src="./ikone/remove.png"></img></a>';
                            echo '</div>';
                            echo '<br>';

                            echo '<div class="info">';
                            echo '<p>'.$pitanje['ime'].'</p>';
                            echo '<a href="mailto:'.$pitanje['email'].'?Subject='.$pitanje['tema'].' target="_top">Odgovori na mail</a>';
                            echo '</div>';


                            echo '<div class="naslov">';
                            echo '<h4>'.$pitanje['tema'].'</h4>';
                            echo '</div>';

                            echo '<div class="pitanje">';
                            echo '<p>'.$pitanje['pitanje'].'</p>';
                            echo '</div>';

                            echo '<div class="odgovor">';
                            echo '<p>'.$pitanje['odgovor'].'</p>';
                            echo '</div>';

                            echo '<form action="spremi_odgovor.php" method="post">';
                            echo '<textarea maxlength=100 cols="100" rows="10" name="tekstodgovora">';
                            echo $pitanje['odgovor'];
                            echo '</textarea>';

                            echo '<input type="hidden" name="id_pitanja" value="'.$pitanje['id'].'"></input>';


                            echo '<input type="submit" value="Spremi">';
                            echo '</form>';
                            echo '<br>';
                        }
                    ?>
               </div>
               </div>
            </div>
        </div>

    </div>




    </body>
</html>
