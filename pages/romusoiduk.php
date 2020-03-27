<?php if(!isset($pagsys) && $pagsys != 321) die("LIGIPÄÄS KEELATUD"); ?>
<?php
if (isset($_GET["id"]) && soiduk_eksisteerib($_GET["id"])) {
	$soiduk_id = $_GET["id"];
	global $ab, $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf['ab_soidukid'].' WHERE id = :id');
	$stmt->execute(array(':id' => $_GET["id"]));
	$soiduk = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if (isset($_GET["tegevus"])) {
		if ($_GET["tegevus"] == "kustuta") {
			$stmt = $ab->prepare('DELETE FROM '.$konf['ab_soidukid'].' WHERE id = :id');
			$tulemus = $stmt->execute(array(':id' => $_GET["id"]));
			if ($tulemus) {
				header('Location: index.php?p=romusoidukid');
			} else {
				echo '<div class="alert alert-info" role="alert"><strong>Veateade!</strong> Ei saanud kustutada romusõiduki andmebaasist!</div>';
			}
		}				else if ($_GET["tegevus"] == "muudakytus") {			$stmt = $ab->prepare('UPDATE '.$konf['ab_soidukid'].' SET kytus = :kytus WHERE id = :id');			$tulemus = $stmt->execute(array(				':id' => $_GET["id"],				':kytus' => $_GET["muudakytus"]			));			if ($tulemus) {				header('Location: index.php?p=romusoiduk&id='.$_GET["id"]);			} else {				echo '<div class="alert alert-info" role="alert"><strong>Veateade!</strong> Tekkis viga kütuse muutmisel!</div>';			}		}
		else if ($_GET["tegevus"] == "lammuta") {
			$stmt = $ab->prepare('UPDATE '.$konf['ab_soidukid'].' SET lammutatud = :lammutatud WHERE id = :id');
			$tulemus = $stmt->execute(array(
				':id' => $_GET["id"],
				':lammutatud' => 1
			));
			if ($tulemus) {
				header('Location: index.php?p=romusoiduk&id='.$_GET["id"]);
			} else {
				echo '<div class="alert alert-info" role="alert"><strong>Veateade!</strong> Ei saanud märkida romusõiduk lammutatuks!</div>';
			}
		}

		else if($_GET['tegevus'] === "kustuta-pilt" && isset($_GET['pilt_id']))
		{
			unlink(pilt($_GET['pilt_id'], 'pilt_url'));
			$stmt = $ab->prepare('DELETE FROM '.$konf['ab_pildid'].' WHERE id = :id');
			$stmt->execute(array(':id'=>$_GET['pilt_id']));
			header('Location: index.php?p=romusoiduk&id='.$soiduk_id);
		}
	}
	
	if(!empty($_FILES))
	{
		$sourcePath = $_FILES['file']['tmp_name'];
		$ext = pathinfo($_FILES['file']['tmp_name'].'/'.$_FILES['file']['name'], PATHINFO_EXTENSION);
		$targetPath = realpath('files')."/".$soiduk_id.'_'.date("U").'.'.$ext;
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
			'tyyp' => 1,
			'tyyp_id' => $soiduk_id,
			'pilt' => $pilt_blob,
			'pilt_url' => $targetPath,
			'unix' => date("U")
		));
		
		header('Location: index.php?p=romusoiduk&id='.$soiduk_id);
		//echo "loool";
	}
?>

<h2 class="sub-header">Romusõiduk #<?php echo $_GET["id"]; ?> andmed</h2>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Mark ja mudel</label>
  <div class="col-xs-10">
    <?php echo mark($soiduk["mark_id"])." ".$soiduk["mudel"]; ?>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Mootori maht</label>
  <div class="col-xs-10">
    <?php echo $soiduk["mootor"]; ?>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Mootori võimsus</label>
  <div class="col-xs-10">
    <?php echo $soiduk["voimsus"]; ?>kW
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Mootori kubatuur</label>
  <div class="col-xs-10">
    <?php echo $soiduk["kubatuur"]; ?>cm<sup>3</sup>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Keretähis</label>
  <div class="col-xs-10">
    <?php echo $soiduk["keretahis"]; ?>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Väljalaske</label>
  <div class="col-xs-10">
    <?php echo $soiduk["valjalaske"]; ?>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Kütus</label>
  <div class="col-xs-10">
    <?php echo kytus($soiduk["kytus"]); ?>	<form action="" method="GET">		<input type="hidden" id="" name="p" value="romusoiduk">	<input type="hidden" id="" name="id" value="<?php echo $_GET["id"]; ?>">	<input type="hidden" id="" name="tegevus" value="muudakytus">		<select class="form-control" name="muudakytus">		<?php		$kytused = kytused();		if (count($kytused) > 0) {			foreach($kytused as $kytus) {								$selected = "";								if ($kytus['id'] == $soiduk["kytus"]) {					$selected = " selected";				}								echo '<option value="'.$kytus['id'].'"'.$selected.'>'.utf8_decode($kytus['kytus']).'</option>';			}		} else {			echo "Andmebaasis ei ole ühtegi kütuseid!";		}		?>    </select>	<button type="submit" name="" class="btn btn-primary">Muuda: Kütus</button>	</form>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Käigukast</label>
  <div class="col-xs-10">
    <?php echo kaigukast($soiduk["kaigukast"]); ?>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Märkus</label>
  <div class="col-xs-10">
    <?php echo $soiduk["informatsioon"]; ?>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Lisatud</label>
  <div class="col-xs-10">
    <?php echo aeg($soiduk["unix"]); ?>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Staatus</label>
  <div class="col-xs-10">
    <?php echo ($soiduk["lammutatud"]==0?'<span class="label label-danger">Lammutamata</span>':'<span class="label label-success">Lammutatud</span>'); ?>
  </div>
</div>

<a href="?p=varuosad_uus&romusoiduk=<?php echo $_GET["id"]; ?>" class="btn btn-primary btn-sm">Lisa selle sõiduki varuosa</a>
<a href="?p=romusoiduk&id=<?php echo $_GET["id"]; ?>&tegevus=lammuta" class="btn btn-primary btn-sm">Märgi lammutatuks</a>
<a href="?p=romusoiduk&id=<?php echo $_GET["id"]; ?>&tegevus=kustuta" class="btn btn-danger btn-sm">Kustuta sõiduk andmebaasist</a>
<a href="?p=romusoidukid" class="btn btn-primary btn-sm">Tagasi romusõidukite nimekirja</a>
<p>&nbsp;</p>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Pildid</h3>
  </div>
  <div class="panel-body">
	<p>
							<?php
							$pildid = pildid(1, $soiduk_id);
							foreach($pildid as $pilt)
							{
								echo '
  <div class="col-md-4">';
								//echo '<a href="?p=romusoiduk&id='.$soiduk_id.'&pilt_id='.$pilt['id'].'&tegevus=kustuta-pilt"><img src="'.$pilt['pilt'].'" width="25%" height="25%"></a>';
								
								echo '<div class="panel panel-default">
  <div class="panel-heading">Pilt #'.$pilt["id"].'</div>
  <div class="panel-body">
    <img src="'.$pilt['pilt'].'" width="100%" height="100%">
	
  </div>
  <div class="panel-footer"><a href="?p=romusoiduk&id='.$soiduk_id.'&pilt_id='.$pilt['id'].'&tegevus=kustuta-pilt">KUSTUTA</a></div>
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

<h2 class="sub-header">Romusõiduk #<?php echo $_GET["id"]; ?> varuosad</h2>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nimetus</th>
                  <th>Kirjeldus</th>
                  <th>Tootekood</th>
				  <th>Hind</th>
				  <th>Lisatud</th>
				  <th>Valik</th>
                </tr>
              </thead>
              <tbody>
				<?php
				global $ab, $konf;
				$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_varuosad"].' WHERE soiduk_id = :soiduk_id');
				$stmt->execute(array(
					':soiduk_id' => $_GET["id"]
				));
				$tulemused = $stmt->fetchAll();
				if (count($tulemused)) {
					foreach($tulemused as $tulemus) {
						echo '<tr>';
						echo '<td>'.$tulemus["id"].'</td>';
						echo '<td>'.$tulemus["nimetus"].'</td>';
						echo '<td>'.$tulemus["kirjeldus"].'</td>';
						echo '<td>'.$tulemus["tootekood"].'</td>';
						echo '<td>'.$tulemus["hind"].'€</td>';
						echo '<td>'.aeg($tulemus["unix"]).'</td>';
						echo '<td><a href="?p=varuosa&id='.$tulemus["id"].'" class="btn btn-primary btn-sm">Ava</a></td>';
						echo '</tr>';
					}
				} else {
					echo '<tr><td colspan="10"><div class="alert alert-info" role="alert">Selle sõiduki varuosad ei ole andmebaasi lisatud!</div></td></tr>';
				}
				?>
			  </tbody>
			</table>
		  </div>

<?php	
} else {
	echo '<div class="alert alert-danger" role="alert">Sellise ID-ga romusõiduk ei leitud andmebaasist!</div>';
}
?>