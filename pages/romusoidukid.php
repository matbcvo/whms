<?php if(!isset($pagsys) && $pagsys != 321) die("LIGIPÄÄS KEELATUD"); ?>
          <h2 class="sub-header">Romusõidukite nimekiri</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Mark, mudel</th>
                  <th>Mootor, võimsus</th>
                  <th>Väljalaske</th>
				  <th>Kütus</th>
				  <th>Käigukast</th>
                  <th>Lisatud</th>
				  <th>Staatus</th>
				  <th>Valik</th>
                </tr>
              </thead>
              <tbody>
				<?php
				global $ab, $konf;
				$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_soidukid"].' ORDER BY `id` DESC');
				$stmt->execute();
				$tulemused = $stmt->fetchAll();
				if (count($tulemused)) {
					foreach($tulemused as $tulemus) {
						echo '<tr>';
						echo '<td>'.$tulemus["id"].'</td>';
						echo '<td>'.mark($tulemus["mark_id"])." ".$tulemus["mudel"].'</td>';
						echo '<td>'.$tulemus["mootor"]." ".(empty($tulemus["voimsus"])?'':''.$tulemus["voimsus"].'kW').'</td>';
						echo '<td>'.$tulemus["valjalaske"].'</td>';
						echo '<td>'.kytus($tulemus["kytus"]).'</td>';
						echo '<td>'.kaigukast($tulemus["kaigukast"]).'</td>';
						echo '<td>'.aeg($tulemus["unix"]).'</td>';
						echo '<td>'.($tulemus["lammutatud"]==0?'<span class="label label-danger">Lammutamata</span>':'<span class="label label-success">Lammutatud</span>').'</td>';
						echo '<td><a href="?p=romusoiduk&id='.$tulemus["id"].'" class="btn btn-primary btn-sm">Ava</a></td>';
						echo '</tr>';
					}
				} else {
					echo '<tr><td colspan="10"><div class="alert alert-info" role="alert">Andmebaasis ei ole ühtegi romusõidukeid.</div></td></tr>';
				}
				?>
              </tbody>
            </table>
          </div>