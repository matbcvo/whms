<?php
if (isset($_GET['password'])) {
	$hash = password_hash($_GET['password'], PASSWORD_DEFAULT);
	echo "Krüpteeritud parool: ".'<input type="text" name="hashed_password" value="'.$hash.'"> pikkus: '.strlen($hash);
}
?>
<form action="" method="get">
	Parool: <input type="text" name="password" value="<?php if (isset($_GET["password"])) echo $_GET["password"]; ?>"><br>
	<input type="submit" value="Krüpteeri!">
</form>