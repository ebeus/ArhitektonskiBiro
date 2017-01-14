<?php
    require '/baza.php';
	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
	if(isset($_SESSION['user'])) {
		header("location: index.php");
	}
$error = '';
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        
    $username = '';
    $password = '';
    $found = false;
    $admin = false;
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $error = "Username ili password nisu uneseni.";
    } else {
        $username = data_filter($_POST['username']);
        $password = data_filter($_POST['password']);

        $table = 'korisnici';
        $polja = array('username','password');
        $rezultat = procitaj($table,$polja);

        //svaki korisnik je admin za sad
        foreach ($rezultat as $korisnici) {
                      if($korisnici['username'] == $username 
                && $korisnici['password'] == md5($password)) {
                    $found = true;
                    $admin == true;
                    $_SESSION['admin'] = true;
                    break;
            }
        }

        if($found) {
            $_SESSION['user'] = $username;          
            header("location: index.php");
        } else {
            $error = "Nevažeći username/password.";
        }

    }


    }    

    function data_filter($data)
    {
        $data = htmlspecialchars($data);
        return $data;
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
        <div class="login_form">
        <form action="login.php" method="POST" id="loginforma" name="login_form" onsubmit="return validateLogin()">
            <table>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input maxlength=100 type="text" name="username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input maxlength=256 type="password" name="password"></td>
                </tr>
              
                <tr>
                    <td></td>
                    <td><input type="submit" value="Login"></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td><p id="error_msg"><?php echo $error; ?> </p></td>
                </tr>
            </table>
        </form>
        </div>
        <footer>
            <a href="login.php">login</a>
        </footer>
    </body>

</html>
