<?php if(!isset($pagsys) && $pagsys != 321) die("LIGIPÄÄS KEELATUD"); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["vahetaparool"])) {
		
		$parool["vana"] = $_POST["parool_vana"];
		$parool["uus"] = $_POST["parool_uus"];
		$parool["uus2"] = $_POST["parool_uus2"];
		
		$vead = array();
		
		if (!password_verify($parool["vana"], kasutaja($_SESSION["uid"], "password"))) $vead[] .= 'Vana parool ei ole õige!';
		if ($parool["uus"] != $parool["uus2"]) $vead[] .= 'Uued paroolid ei kattu!';
		if (strlen($parool["vana"]) < 1) $vead[] = 'Vana parool sisestamata!';
		if (strlen($parool["uus"]) < 1) $vead[] = 'Uus parool sisestamata!';
		if (strlen($parool["uus2"]) < 1) $vead[] = 'Uus parool (2) sisestamata!';
		
		if (count($vead)) {
			echo '<div class="alert alert-danger" role="alert"><strong>Veateade</strong>';
			foreach($vead as $viga) echo '<p>'.$viga.'</p>';
			echo '</div>';
		} else {
			$uus_parool = password_hash($parool["uus"], PASSWORD_DEFAULT);
			$stmt = $ab->prepare('UPDATE '.$konf['ab_kasutajad'].' SET password = :uus_parool WHERE id = :id');
			$stmt->execute(array(
				':id' => $_SESSION["uid"],
				':uus_parool' => $uus_parool
			));
			//echo '<div class="alert alert-danger" role="alert">Parool on vahetatud!</div>';
			header("Location: logout.php");
		}
		
	}
}
?>
<h2 class="sub-header">Konto sätted</h2>
<form action="" method="POST">
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Vana parool</label>
  <div class="col-xs-10">
    <input class="form-control" type="password" name="parool_vana">
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Uus parool</label>
  <div class="col-xs-10">
    <input class="form-control" type="password" name="parool_uus">
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Korda uus parool</label>
  <div class="col-xs-10">
    <input class="form-control" type="password" name="parool_uus2">
  </div>
</div>

<div class="form-group row">
    <div class="col-xs-12">
        <button type="submit" name="vahetaparool" class="btn btn-primary">Vaheta parool</button>
		<button type="reset" class="btn btn-primary">Lähtesta väljad</button>
    </div>
</div>
</form>