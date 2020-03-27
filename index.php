<?php
require("inc/init.php");

$pagsys = 321;

if (isset($_SESSION["logged"]) && isset($_SESSION["uid"])) {
	if (!kasutaja_eksisteerib2($_SESSION["uid"])) {
		// andmebaasis sellist kasutajat ei eksisteeri
		session_unset();
		session_destroy();
		header("Location: login.php");
	}
} else {
	session_unset();
	session_destroy();
	header("Location: login.php");
}

/*require("inc/template.class.php");

$navbar = new Template("template/navbar.tpl");

$navbar->set("projektinimi", "Ladu");

$sidebar = new Template("template/sidebar.tpl");

$layout = new Template("template/layout.tpl");

$layout->set("title", $konf["tiitel"]);
$layout->set("navbar", $navbar->output());
$layout->set("sidebar", $sidebar->output());

$content = new Template("template/content.tpl");

switch($_GET['p']) {
	case "varuosad":
		$varuosad = new Template("template/p_varuosad.tpl");
		
		
		
		$users = array(
			array("id" => "1", "mark" => "audi"),
			array("id" => "2", "mark" => "skoda"),
			array("id" => "3", "mark" => "vw")
		);

		foreach ($users as $user) {
			$row = new Template("template/p_varuosad_tabel.tpl");
			
			foreach ($user as $key => $value) {
				$row->set($key, $value);
			}
			$usersTemplates[] = $row;
		}
		
		$usersContents = Template::merge($usersTemplates);
		
		$varuosad->set("varuosad_tabel", $usersContents);
	
		$layout->set("content", $varuosad->output());
	break;
    default: 
		if (empty($_GET['p'])) {
            include './template/p_avaleht.php';
        } else { 
            $pag = explode('/', $_GET['p']); 
            if (file_exists('./template/p_'.end($pag).'.tpl') == true) { 
                include './template/p_'.end($pag).'.tpl'; 
            } else { 
                //echo '<span style="color:red;">Lehte ei leitud!</span>'; 
				$layout->set("content", '<span style="color:red;">Lehte ei leitud!</span>');
			} 
        } 
    break;  
}

echo $layout->output();
*/
?>
<!DOCTYPE html>
<html lang="et">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo $konf["meta_kirjeldus"]; ?>">
    <meta name="author" content="<?php echo $konf["meta_autor"]; ?>">
    <link rel="icon" href="favicon.ico">

    <title><?php echo $konf["tiitel"]; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
	
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo $konf["tiitel"]; ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
            <li><a href="index.php">Töölaud</a></li>
            <li><a href="?p=satted">Sätted</a></li>
            <li><a href="?p=abi">Abi</a></li>
          </ul>
          
		  <ul class="nav navbar-nav navbar-right">
            <li><a href="#">{ Sisselogitud kasutajana <?php echo kasutaja($_SESSION["uid"], "username"); ?> }</a></li>
            <li><a href="logout.php">Logi välja</a></li>
          </ul>
		  
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
		<br>
          <ul class="nav nav-pills nav-stacked">
        <li<?php if(isset($_GET["p"]) && $_GET["p"] == "romusoidukid") echo ' class="active"'; ?>><a href="?p=romusoidukid">Romusõidukid<?php echo '&nbsp;<span class="badge">'.soidukid_arv().'</span>'; ?></a></li>
        <li<?php if(isset($_GET["p"]) && $_GET["p"] == "romusoidukid_uus") echo ' class="active"'; ?>><a href="?p=romusoidukid_uus">Lisa uus romusõiduk</a></li>
        <li<?php if(isset($_GET["p"]) && $_GET["p"] == "varuosad") echo ' class="active"'; ?>><a href="?p=varuosad">Varuosad<?php echo '&nbsp;<span class="badge">'.varuosad_arv().'</span>'; ?></a></li>
        <li<?php if(isset($_GET["p"]) && $_GET["p"] == "varuosad_uus") echo ' class="active"'; ?>><a href="?p=varuosad_uus">Lisa uus varuosa</a></li>
		<li<?php if(isset($_GET["p"]) && $_GET["p"] == "varuosad_otsing") echo ' class="active"'; ?>><a href="?p=varuosad_otsing">Varuosade otsing</a></li>
      </ul>
	  </div>
        <div class="col-md-10 main">

		<?php
			switch(@$_GET["p"]) { 
				default: 
					if (empty($_GET['p'])) {
						include './pages/avaleht.php';
					} else { 
						$pag = explode('/', $_GET['p']); 
						if (file_exists('./pages/'.end($pag).'.php') == true) { 
							include './pages/'.end($pag).'.php'; 
						} else { 
							echo '<div class="alert alert-danger" role="alert"><strong>Veateade</strong><br>Lehte ei leitud!</div>';
						} 
					} 
				break;  
			}
			?>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="js/ladu.js"></script>
  </body>
</html>