<?php if(!isset($pagsys) && $pagsys != 321) die("LIGIPÄÄS KEELATUD"); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["lisauusvaruosa"])) {
		
		$vo["nimetus"] = $_POST["nimetus"];
		$vo["kirjeldus"] = $_POST["kirjeldus"];
		$vo["tootekood"] = $_POST["tootekood"];
		$vo["hind"] = $_POST["hind"];
		$vo["asukoht"] = $_POST["asukoht"];
		$vo["soiduk_id"] = $_POST["soiduk_id"];
		$vo["markus"] = $_POST["markus"];

		
		$stmt = $ab->prepare('INSERT INTO '.$konf['ab_varuosad'].' (nimetus, kirjeldus, tootekood, hind, asukoht, soiduk_id, markus, unix) VALUES (:nimetus, :kirjeldus, :tootekood, :hind, :asukoht, :soiduk_id, :markus, :unix)');
		
		$tulemus = $stmt->execute(array(
			':nimetus' => $vo["nimetus"],
			':kirjeldus' => $vo["kirjeldus"],
			':tootekood' => $vo["tootekood"],
			':hind' => $vo["hind"],
			':asukoht' => $vo["asukoht"],
			':soiduk_id' => $vo["soiduk_id"],
			':markus' => $vo["markus"],
			':unix' => date("U")
		));
		
		if ($tulemus) {
			$uus_varuosa_id = $ab->lastInsertId();
			header('Location: index.php?p=varuosa&id='.$uus_varuosa_id);
		} else {
			echo '<div class="alert alert-info" role="alert"><strong>Veateade!</strong> Ei saanud lisada uue varuosa andmebaasi!</div>';
		}
	}
}
?>
          <h2 class="sub-header">Uus varuosa</h2>
<form action="" method="POST">
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Varuosa nimetus</label>
  <div class="col-xs-10">
    <input class="form-control" type="text" name="nimetus" id="varuosa-nimetus-input" placeholder="Iluvõre, kapott...">
  </div>
</div>
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Varuosa kirjeldus</label>
  <div class="col-xs-10">
    <textarea class="form-control" name="kirjeldus" rows="3"></textarea>
  </div>
</div>
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Varuosa tootekood</label>
  <div class="col-xs-10">
    <input class="form-control" type="text" name="tootekood">
  </div>
</div>
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Varuosa hind (€)</label>
  <div class="col-xs-10">
    <input class="form-control" type="number" name="hind" min="0" step="0.01" placeholder="123.45">
  </div>
</div>
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Varuosa asukoht <em>(laos)</em></label>
  <div class="col-xs-10">
    <input class="form-control" type="text" name="asukoht">
  </div>
</div>
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Romusõiduk</label>
  <div class="col-xs-10">
    <select class="form-control" name="soiduk_id">
		<option value="0">(puudub)</option>
		<?php
		$soidukid = soidukid();
		if (count($soidukid)) {
			foreach($soidukid as $soiduk) {
				$valitud = "";
				if (isset($_GET["romusoiduk"])) {
					if ($soiduk["id"] == $_GET["romusoiduk"]) {
						$valitud = " selected";
					}
				}
				echo '<option value="'.$soiduk["id"].'"'.$valitud.'>#'.$soiduk["id"]." // ".mark($soiduk['mark_id'])." ".$soiduk["mudel"]." ".$soiduk["mootor"]." ".$soiduk["voimsus"]."kW // ".$soiduk["valjalaske"]." // ".kaigukast($soiduk["kaigukast"])." // ".kytus($soiduk["kytus"])." // ".aeg($soiduk["unix"]).'</option>';
			}
		}
		?>
    </select>
  </div>
</div>
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Märkus</label>
  <div class="col-xs-10">
    <textarea class="form-control" name="markus" rows="3"></textarea>
  </div>
</div>
<div class="form-group row">
    <div class="col-xs-12">
        <button type="submit" name="lisauusvaruosa" class="btn btn-primary">Lisa uus varuosa</button>
		<button type="reset" class="btn btn-primary">Lähtesta väljad</button>
    </div>
</div>
</form>