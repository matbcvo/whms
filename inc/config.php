<?php
$konf["tiitel"] = "Ladu";
$konf["meta_kirjeldus"] = "Veebipõhine laoprogramm";
$konf["meta_autor"] = "Martin Vooremäe";

$konf["ab_host"] = "";
$konf["ab_database"] = "";
$konf["ab_username"] = "";
$konf["ab_password"] = "";

$konf["ab_kasutajad"] = "kl_kasutajad";
$konf["ab_soidukid"] = "kl_soidukid";
$konf["ab_margid"] = "kl_margid";
$konf["ab_kytused"] = "kl_kytused";
$konf["ab_kaigukastid"] = "kl_kaigukastid";
$konf["ab_varuosad"] = "kl_varuosad";
$konf["ab_varuosanimetused"] = "kl_varuosanimetused";
$konf["ab_keretyybid"] = "kl_keretyybid";
$konf["ab_pildid"] = "kl_pildid";

try {
    $ab = new PDO('mysql:host='.$konf['ab_host'].';dbname='.$konf['ab_database'], $konf['ab_username'], $konf['ab_password']);
    $ab->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'VEATEADE: ' . $e->getMessage();
}

?>