<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (isset($_GET["q"])) {
		require("inc/config.php");
		require("inc/functions.php");
		
		$q = $_GET["q"];
		
		global $ab;
		global $konf;
		$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_varuosad"].' WHERE (id = :id) OR (nimetus LIKE :nimetus) OR (kirjeldus LIKE :kirjeldus) OR (tootekood LIKE :tootekood) OR (markus LIKE :markus)');
		$stmt->execute(array(
			':id' => (int)$q,
			':nimetus' => "%".$q."%",
			':kirjeldus' => "%".$q."%",
			':tootekood' => "%".$q."%",
			':markus' => "%".$q."%"
		));
		$tulemused = $stmt->fetchAll();
		if (count($tulemused)) {
			echo '          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nimetus</th>
				  <th>Kirjeldus</th>
                  <th>Tootekood</th>
				  <th>Romusõiduk</th>
				  <th>Hind</th>
				  <th>Lisatud</th>
				  <th>Valik</th>
                </tr>
              </thead>
              <tbody>';
			foreach($tulemused as $tulemus) {
				echo '<tr>';
				echo '<td>'.$tulemus["id"].'</td>';
				echo '<td>'.$tulemus["nimetus"].'</td>';
				echo '<td>'.$tulemus["kirjeldus"].'</td>';
				echo '<td>'.$tulemus["tootekood"].'</td>';
				echo '<td>'.mark(soiduk($tulemus["soiduk_id"], "mark_id"))." ".soiduk($tulemus["soiduk_id"], "mudel").'</td>';
				echo '<td>'.$tulemus["hind"].'€</td>';
				echo '<td>'.aeg($tulemus["unix"]).'</td>';
				echo '<td><a href="?p=varuosa&id='.$tulemus["id"].'" class="btn btn-primary btn-sm">Ava</a></td>';
				echo '</tr>';
			}
			echo '</tbody></table></div>';
		} else {
			echo '<div class="alert alert-warning" role="alert">Ei leitud andmebaasist varuosa, mis sisaldaks seda otsingusõna. <sup>('.date("U").')</sup></div>';
		}
		

	}
}
?>