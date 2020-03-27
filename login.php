<?php
require("inc/init.php");

if (isset($_SESSION["logged"]) && isset($_SESSION["uid"])) {
	// sessioon sisaldab "logged" ja "uid"
	if (kasutaja_eksisteerib2($_SESSION["uid"])) {
		// andmebaasis sellist kasutajat eksisteerib
		header("Location: index.php");
	} else {
		// andmebaasis sellist kasutajat ei eksisteeri
		session_unset();
		session_destroy();
		//header("Location: login.php");
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["konto_nimi"]) && isset($_POST["konto_parool"])) {
		$knimi = $_POST["konto_nimi"];
		$kparool = $_POST["konto_parool"];
		
		$vead = array();

		if (strlen($knimi) < 1) $vead[] = 'Konto nimi sisestamata!';
		if (strlen($kparool) < 1) $vead[] = 'Konto parool sisestamata!';
		
		if (!kasutaja_eksisteerib($knimi)) $vead[] = 'Sellist kasutajat ei eksisteeri!';
		
		//if ($kparool != kasutaja(kasutaja_ID($knimi), "password")) $vead[] = 'Sisestatud konto parool on vale!';
		
		if (!password_verify($kparool, kasutaja(kasutaja_ID($knimi), "password"))) $vead[] = 'Sisestatud konto parool on vale!';
		
		if (count($vead) > 0) {
			//echo '<div class="alert alert-danger" role="alert"><strong>Veateade</strong><br>';
			//foreach($vead as $viga) echo $viga."<br>";
			//echo '</div>';
		} else {
			$_SESSION["logged"] = true;
			$_SESSION["uid"] = kasutaja_ID($knimi, "id");
			header("Location: index.php");
		}

	}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo $konf["meta_kirjeldus"]; ?>">
    <meta name="author" content="<?php echo $konf["meta_autor"]; ?>">
    <link rel="icon" href="favicon.ico">

    <title><?php echo $konf["tiitel"]." &bull; Sisselogimine"; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

	<?php
	if (isset($vead)) {
		if (count($vead) > 0) {
			echo '<div class="alert alert-danger" role="alert"><strong>Veateade</strong><br>';
			foreach($vead as $viga) echo $viga."<br>";
			echo '</div>';
		}
	}
	?>
	
      <form class="form-signin" action="" method="POST">
        <h2 class="form-signin-heading">Palun logi sisse...</h2>
        <label for="inputEmail" class="sr-only">Konto nimi</label>
        <input type="text" id="inputKontonimi" name="konto_nimi" class="form-control" placeholder="Konto nimi" required autofocus>
        <label for="inputPassword" class="sr-only">Konto parool</label>
        <input type="password" id="inputKontoparool" name="konto_parool" class="form-control" placeholder="Konto parool" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Logi sisse</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
