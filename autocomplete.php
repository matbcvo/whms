<?php
if (isset($_GET["s"]) && isset($_GET["term"])) {
	require("inc/config.php");
	$otsingusona = $_GET['term'];
	
	
	
	if ($_GET["s"] == "varuosad") {
		global $ab, $konf;
		$stmt = $ab->prepare('SELECT * FROM '.$konf['ab_varuosanimetused'].' WHERE nimetus LIKE :nimetus LIMIT 10');
		$stmt->execute(array(
			':nimetus' => '%'.$otsingusona.'%'
		));
		//$tulemused = $stmt->fetchAll();
		$data = [];
		while ($tulemus = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = utf8_encode($tulemus["nimetus"]);
		}
		
		echo json_encode($data);
	}
	else if ($_GET["s"] == "uussoiduk-mudel") {
		global $ab, $konf;
		$stmt = $ab->prepare('SELECT * FROM '.$konf['ab_soidukid'].' WHERE mudel LIKE :mudel GROUP BY mudel LIMIT 10');
		$stmt->execute(array(
			':mudel' => '%'.$otsingusona.'%'
		));
		//$tulemused = $stmt->fetchAll();
		$data = [];
		while ($tulemus = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$data[] = utf8_encode($tulemus["mudel"]);
		}
		
		echo json_encode($data);
	}
}
?>