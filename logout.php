<?php
require("inc/init.php");
session_unset();
session_destroy();
header("Location: login.php");
?>
LOGOUT