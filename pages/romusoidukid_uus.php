<?php if(!isset($pagsys) && $pagsys != 321) die("LIGIPÄÄS KEELATUD"); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST["lisauusromusoiduk"])) {
		
		$rs["mark_id"] = $_POST["mark_id"];
		$rs["mudel"] = $_POST["mudel"];
		$rs["keretyyp_id"] = $_POST["keretyyp_id"];
		$rs["labisoit"] = $_POST["labisoit"];
		$rs["mmaht"] = $_POST["mmaht"];
		$rs["mvoimsus"] = $_POST["mvoimsus"];
		$rs["mkubatuur"] = $_POST["mkubatuur"];
		$rs["valjalaske"] = $_POST["valjalaske"];
		$rs["kytus"] = $_POST["kytus"];
		$rs["kaigukast"] = $_POST["kaigukast"];
		$rs["keretahis"] = $_POST["keretahis"];
		$rs["informatsioon"] = $_POST["informatsioon"];
		
		$stmt = $ab->prepare('INSERT INTO '.$konf['ab_soidukid'].' (mark_id, mudel, kere_id, labisoit, keretahis, mootor, kubatuur, voimsus, valjalaske, kytus, kaigukast, informatsioon, unix) VALUES (:mark_id, :mudel, :kere_id, :labisoit, :keretahis, :mootor, :kubatuur, :voimsus, :valjalaske, :kytus, :kaigukast, :informatsioon, :unix)');
		
		$tulemus = $stmt->execute(array(
			':mark_id' => $rs["mark_id"],
			':mudel' => $rs["mudel"],
			':kere_id' => $rs["keretyyp_id"],
			':labisoit' => $rs["labisoit"],
			':keretahis' => $rs["keretahis"],
			':mootor' => $rs["mmaht"],
			':kubatuur' => $rs["mkubatuur"],
			':voimsus' => $rs["mvoimsus"],
			':valjalaske' => $rs["valjalaske"],
			':kytus' => $rs["kytus"],
			':kaigukast' => $rs["kaigukast"],
			':informatsioon' => $rs["informatsioon"],
			':unix' => date("U")
		));
		
		if ($tulemus) {
			$uus_soiduk_id = $ab->lastInsertId();
			header('Location: index.php?p=romusoiduk&id='.$uus_soiduk_id);
		} else {
			echo '<div class="alert alert-info" role="alert"><strong>Veateade!</strong> Ei saanud lisada uue romusõiduki andmebaasi!</div>';
		}
	}
}
?>
          <h2 class="sub-header">Uus romusõiduk</h2>
<form action="" method="POST">
<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Mark</label>
  <div class="col-xs-10">
    <select class="form-control" name="mark_id">
		<?php
		$margid = margid();
		if (count($margid) > 0) {
			foreach($margid as $mark) {
				echo '<option value="'.$mark['id'].'">'.utf8_encode($mark['mark']).'</option>';
			}
		} else {
			echo "Andmebaasis ei ole ühtegi marke!";
		}
		?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Mudel</label>
  <div class="col-xs-10">
    <input class="form-control" type="text" name="mudel" id="uussoiduk-mudel-input" placeholder="A4 Avant, Passat...">
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Kere tüüp</label>
  <div class="col-xs-10">
    <select class="form-control" name="keretyyp_id">
		<?php
		$keretyybid = keretyybid();
		if (count($keretyybid) > 0) {
			foreach($keretyybid as $keretyyp) {
				echo '<option value="'.$keretyyp['id'].'">'.utf8_encode($keretyyp['kere']).'</option>';
			}
		} else {
			echo "Andmebaasis ei ole ühtegi kere tüüpe!";
		}
		?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Mootori maht</label>
  <div class="col-xs-10">
    <input class="form-control" type="text" name="mmaht" placeholder="1.9TDI, 1.8T, 1.6...">
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Mootori võimsus (kW)</label>
  <div class="col-xs-10">
    <input class="form-control" type="number" name="mvoimsus" placeholder="81, 132, 75...">
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Mootori kubatuur (cm<sup>3</sup>)</label>
  <div class="col-xs-10">
    <input class="form-control" type="number" name="mkubatuur" placeholder="1969, 2400...">
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Läbisõit (km)</label>
  <div class="col-xs-10">
    <input class="form-control" type="number" name="labisoit">
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Väljalaske</label>
  <div class="col-xs-10">
    <input class="form-control" type="text" name="valjalaske" placeholder="06.1997, 12.1998, 1999...">
	<small id="emailHelp" class="form-text text-muted">Aastaarv</small>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Kütus</label>
  <div class="col-xs-10">
    <select class="form-control" name="kytus">
		<?php
		$kytused = kytused();
		if (count($kytused) > 0) {
			foreach($kytused as $kytus) {
				echo '<option value="'.$kytus['id'].'">'.utf8_decode($kytus['kytus']).'</option>';
			}
		} else {
			echo "Andmebaasis ei ole ühtegi kütuseid!";
		}
		?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Käigukast</label>
  <div class="col-xs-10">
    <select class="form-control" name="kaigukast">
		<?php
		$kaigukastid = kaigukastid();
		if (count($kaigukastid) > 0) {
			foreach($kaigukastid as $kaigukast) {
				echo '<option value="'.$kaigukast['id'].'">'.utf8_decode($kaigukast['kaigukast']).'</option>';
			}
		} else {
			echo "Andmebaasis ei ole ühtegi käigukaste!";
		}
		?>
    </select>
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Keretähis</label>
  <div class="col-xs-10">
    <input class="form-control" type="text" name="keretahis" placeholder="WAUZZZXXXYYY12345">
  </div>
</div>

<div class="form-group row">
  <label for="example-text-input" class="col-xs-2 col-form-label">Informatsioon</label>
  <div class="col-xs-10">
    <textarea class="form-control" name="informatsioon" rows="3"></textarea>
  </div>
</div>

<div class="form-group row">
    <div class="col-xs-12">
        <button type="submit" name="lisauusromusoiduk" class="btn btn-primary">Lisa uus romusõiduk</button>
		<button type="reset" class="btn btn-primary">Lähtesta väljad</button>
    </div>
</div>
</form>