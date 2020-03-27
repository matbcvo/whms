<?php
function kasutaja_eksisteerib($konto_nimi)
{
	global $ab, $konf;
	$stmt = $ab->prepare('SELECT username FROM '.$konf['ab_kasutajad'].' WHERE username = :konto_nimi');
	$stmt->execute(array(':konto_nimi' => $konto_nimi));
	$tulemus = $stmt->fetchAll();
	if (count($tulemus)) {
		return true;
	}
	return false;
}

function kasutaja_eksisteerib2($uid)
{
	global $ab, $konf;
	$stmt = $ab->prepare('SELECT id FROM '.$konf['ab_kasutajad'].' WHERE id = :uid');
	$stmt->execute(array(':uid' => $uid));
	$tulemus = $stmt->fetchAll();
	if (count($tulemus)) {
		return true;
	}
	return false;
}

function kasutaja_ID($kasutaja)
{
	global $ab, $konf;
	$stmt = $ab->prepare('SELECT id FROM '.$konf['ab_kasutajad'].' WHERE username = :kasutaja');
	$stmt->execute(array(':kasutaja' => $kasutaja));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row['id'];
}

function kasutaja($uid, $col)
{
	global $ab, $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf['ab_kasutajad'].' WHERE id = :id');
	$stmt->execute(array(':id' => $uid));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row[$col];
}

function soiduk_eksisteerib($id)
{
	global $ab, $konf;
	$stmt = $ab->prepare('SELECT id FROM '.$konf['ab_soidukid'].' WHERE id = :id');
	$stmt->execute(array(':id' => $id));
	$tulemus = $stmt->fetchAll();
	if (count($tulemus)) {
		return true;
	}
	return false;
}

function soiduk($soiduk_id, $col)
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_soidukid"].' WHERE id = :id');
	$stmt->execute(array(':id'=>$soiduk_id));
	$soiduk = $stmt->fetch(PDO::FETCH_ASSOC);
	return $soiduk[$col];
}

function soidukid()
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_soidukid"].'');
	$stmt->execute();
	$tulemus = $stmt->fetchAll();
	return $tulemus;
}

function soidukid_arv()
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT COUNT(*) as ARV FROM '.$konf["ab_soidukid"].'');
	$stmt->execute();
	$tulemus = $stmt->fetch(PDO::FETCH_ASSOC);
	return $tulemus["ARV"];
}

function mark($mark_id)
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_margid"].' WHERE id = :id');
	$stmt->execute(array(':id'=>$mark_id));
	$mark = $stmt->fetch(PDO::FETCH_ASSOC);
	return $mark['mark'];
}

function margid()
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_margid"].'');
	$stmt->execute();
	$tulemus = $stmt->fetchAll();
	return $tulemus;
}

function kytus($kytus_id)
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_kytused"].' WHERE id = :id');
	$stmt->execute(array(':id'=>$kytus_id));
	$kytus = $stmt->fetch(PDO::FETCH_ASSOC);
	return $kytus['kytus'];
}

function kytused()
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_kytused"].'');
	$stmt->execute();
	$tulemus = $stmt->fetchAll();
	return $tulemus;
}

function kaigukast($kaigukast_id)
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_kaigukastid"].' WHERE id = :id');
	$stmt->execute(array(':id'=>$kaigukast_id));
	$kaigukast = $stmt->fetch(PDO::FETCH_ASSOC);
	return $kaigukast['kaigukast'];
}

function kaigukastid()
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_kaigukastid"].'');
	$stmt->execute();
	$tulemus = $stmt->fetchAll();
	return $tulemus;
}

function varuosanimetus($varuosanimetus_id)
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf["ab_varuosanimetused"].' WHERE id = :id');
	$stmt->execute(array(':id'=>$varuosanimetus_id));
	$varuosanimetus = $stmt->fetch(PDO::FETCH_ASSOC);
	return $varuosanimetus['nimetus'];
}

function keretyybid()
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf['ab_keretyybid'].'');
	$stmt->execute();
	$keretyybid = $stmt->fetchAll();
	return $keretyybid;
}

function varuosa_eksisteerib($id)
{
	global $ab, $konf;
	$stmt = $ab->prepare('SELECT id FROM '.$konf['ab_varuosad'].' WHERE id = :id');
	$stmt->execute(array(':id' => $id));
	$tulemus = $stmt->fetchAll();
	if (count($tulemus)) {
		return true;
	}
	return false;
}

function varuosad_arv()
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT COUNT(*) as ARV FROM '.$konf["ab_varuosad"].'');
	$stmt->execute();
	$tulemus = $stmt->fetch(PDO::FETCH_ASSOC);
	return $tulemus["ARV"];
}

function pildid($tyyp, $tyyp_id)
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf['ab_pildid'].' WHERE tyyp = :tyyp AND tyyp_id = :tyyp_id');
	$stmt->execute(array(':tyyp'=>$tyyp,':tyyp_id'=>$tyyp_id));
	$pildid = $stmt->fetchAll();
	return $pildid;
}

function pildid_($tyyp, $tyyp_id, $limit)
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf['ab_pildid'].' WHERE tyyp = :tyyp AND tyyp_id = :tyyp_id LIMIT '.$limit);
	$stmt->execute(array(':tyyp'=>$tyyp,':tyyp_id'=>$tyyp_id));
	$pildid = $stmt->fetchAll();
	return $pildid;
}

function pilt($pilt_id, $col)
{
	global $ab;
	global $konf;
	$stmt = $ab->prepare('SELECT * FROM '.$konf['ab_pildid'].' WHERE id = :id');
	$stmt->execute(array(':id'=>$pilt_id));
	$pilt = $stmt->fetch(PDO::FETCH_ASSOC);
	return $pilt[$col];
}

function aeg($unix)
{
	return date("H:i d.m.y", $unix);
	//return date("d.m.Y", $unix);
}
?>