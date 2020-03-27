<?php if(!isset($pagsys) && $pagsys != 321) die("LIGIPÄÄS KEELATUD"); ?>
          <h2 class="sub-header">Varuosade nimekiri</h2>
          <div class="table-responsive">
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
              <tbody>
				<?php
				global $ab, $konf;
				$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_varuosad"].' ORDER BY `id` DESC');
				$stmt->execute();
				$tulemused = $stmt->fetchAll();
				if (count($tulemused)) {
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
				} else {
					echo '<tr><td colspan="10"><div class="alert alert-info" role="alert">Andmebaasis ei ole ühtegi varuosa.</div></td></tr>';
				}
				?>
              </tbody>
            </table>
          </div>