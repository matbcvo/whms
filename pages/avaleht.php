<?php if(!isset($pagsys) && $pagsys != 321) die("LIGIPÄÄS KEELATUD"); ?>
<h1>Töölaud</h1>
<p>Tere tulemast, <?php echo kasutaja($_SESSION["uid"], 'username'); ?>.</p>
<p>Vasakus menüüs saab navigeerida.</p>