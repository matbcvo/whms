<?php if(!isset($pagsys) && $pagsys != 321) die("LIGIPÄÄS KEELATUD"); ?>
<?php
if (isset($_GET["id"]) && varuosa_eksisteerib($_GET["id"])) {
	$varuosa_id = $_GET["id"];
	global $ab, $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf['ab_varuosad'].' WHERE id = :id');
	$stmt->execute(array(':id' => $_GET["id"]));
	$varuosa = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if (isset($_GET["tegevus"])) {
		if ($_GET["tegevus"] == "kustuta") {
			$stmt = $ab->prepare('DELETE FROM '.$konf['ab_varuosad'].' WHERE id = :id');
			$tulemus = $stmt->execute(array(':id' => $_GET["id"]));
			if ($tulemus) {
				header('Location: index.php?p=varuosad');
			} else {
				echo '<div class="alert alert-info" role="alert"><strong>Veateade!</strong> Ei saanud kustutada varuosa andmebaasist!</div>';
			}
		}
		else if($_GET['tegevus'] === "kustuta-pilt" && isset($_GET['pilt_id']))
		{
			unlink(pilt($_GET['pilt_id'], 'pilt_url'));
			$stmt = $ab->prepare('DELETE FROM '.$konf['ab_pildid'].' WHERE id = :id');
			$stmt->execute(array(':id'=>$_GET['pilt_id']));
			header('Location: index.php?p=varuosa&id='.$varuosa_id);
		}
	}
	
	if(!empty($_FILES))
	{
		$sourcePath = $_FILES['file']['tmp_name'];
		$ext = pathinfo($_FILES['file']['tmp_name'].'/'.$_FILES['file']['name'], PATHINFO_EXTENSION);
		$targetPath = realpath('files')."/2_".$varuosa_id.'_'.date("U").'.'.$ext;
		move_uploaded_file($sourcePath,$targetPath);
		
		$pilt = new Imagick();
		$pilt->readImage($targetPath);
		$pilt->resizeImage(800,600,Imagick::FILTER_UNDEFINED,1);
		$blob = $pilt->getImageBlob();
		$pilt->writeImage($targetPath);
		$pilt->clear();
		$pilt->destroy(); 
		
		$pilt_blob = "data:image/".$ext.";base64,".base64_encode($blob);
		
		$stmt = $ab->prepare('INSERT INTO '.$konf['ab_pildid'].' (tyyp, tyyp_id, pilt, pilt_url, unix)VALUES(:tyyp, :tyyp_id, :pilt, :pilt_url, :unix)');
		$stmt->execute(array(
			'tyyp' => 2,
			'tyyp_id' => $varuosa_id,
			'pilt' => $pilt_blob,
			'pilt_url' => $targetPath,
			'unix' => date("U")
		));
		
		header('Location: index.php?p=varuosa&id='.$varuosa_id);
		//echo "loool";
	}
?>

<h2 class="sub-header">Varuosa #<?php echo $_GET["id"]; ?> andmed</h2>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Nimetus</label>
  <div class="col-xs-10">
    <?php echo $varuosa["nimetus"]; ?>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Kirjeldus</label>
  <div class="col-xs-10">
    <?php echo $varuosa["kirjeldus"]; ?>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Tootekood</label>
  <div class="col-xs-10">
    <?php echo $varuosa["tootekood"]; ?>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Hind</label>
  <div class="col-xs-10">
    <?php echo $varuosa["hind"]; ?>€
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Asukoht</label>
  <div class="col-xs-10">
    <?php echo $varuosa["asukoht"]; ?>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Märkus</label>
  <div class="col-xs-10">
    <?php echo $varuosa["markus"]; ?>
  </div>
</div>
<?php if (soiduk_eksisteerib($varuosa["soiduk_id"])) { ?>
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Romusõiduk</label>
  <div class="col-xs-10">
    
	<div class="panel panel-default">
	  <!-- Default panel contents -->
	  <div class="panel-heading">
		Romusõiduk #<?php echo $varuosa["soiduk_id"]; ?>
	  </div>
	  <div class="panel-body">
		<p>Mark ja mudel: <?php echo mark(soiduk($varuosa["soiduk_id"], "mark_id"))." ".soiduk($varuosa["soiduk_id"], "mudel"); ?></p>
		<p>Väljalaske: <?php echo soiduk($varuosa["soiduk_id"], "valjalaske"); ?></p>
		<p>Kütus: <?php echo kytus(soiduk($varuosa["soiduk_id"], "kytus")); ?></p>
		<p>Kaigukast: <?php echo kaigukast(soiduk($varuosa["soiduk_id"], "kaigukast")); ?></p>
		<p><a href="?p=romusoiduk&id=<?php echo $varuosa["soiduk_id"]; ?>" class="btn btn-primary btn-xs">Ava selle romusõiduki andmete leht</a></p>
	  </div>
	</div>
  </div>
</div>
<?php } ?>

<a href="?p=varuosa&id=<?php echo $_GET["id"]; ?>&tegevus=kustuta" class="btn btn-danger btn-sm">Kustuta varuosa andmebaasist</a>
<a href="?p=varuosad" class="btn btn-primary btn-sm">Tagasi varuosade nimekirja</a>

<h2 class="sub-header">Pildid</h2>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Pildid</h3>
  </div>
  <div class="panel-body">
	<p>
							<?php
							$pildid = pildid(2, $varuosa_id);
							foreach($pildid as $pilt)
							{
								echo '
  <div class="col-md-4">';
								//echo '<a href="?p=romusoiduk&id='.$varuosa_id.'&pilt_id='.$pilt['id'].'&tegevus=kustuta-pilt"><img src="'.$pilt['pilt'].'" width="25%" height="25%"></a>';
								
								echo '<div class="panel panel-default">
  <div class="panel-heading">Pilt #'.$pilt["id"].'</div>
  <div class="panel-body">
    <img src="'.$pilt['pilt'].'" width="100%" height="100%">
	
  </div>
  <div class="panel-footer"><a href="?p=varuosa&id='.$varuosa_id.'&pilt_id='.$pilt['id'].'&tegevus=kustuta-pilt">KUSTUTA</a></div>
</div>';
								echo '</div>';
								
							}
							?>
							</p>
							
  </div>
  <div class="panel-footer"><p>Lae pilt üles
							<form action="" method="post" enctype="multipart/form-data">
								<input type="file" name="file" id="file">
								<input type="submit" value="Lae pilt üles" class="submit">
							</form>
							</p></div>
</div>


<?php	
} else {
	echo '<div class="alert alert-danger" role="alert">Sellise ID-ga varuosa ei leitud andmebaasist!</div>';
}
?>