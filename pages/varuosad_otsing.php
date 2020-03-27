<?php if(!isset($pagsys) && $pagsys != 321) die("LIGIPÄÄS KEELATUD"); ?>
<h2 class="sub-header">Varuosade otsing</h2>
<div class="form-group row">
<div class="col-xs-6">
      <input type="text" class="form-control" placeholder="Sisesta otsingusõna näiteks kapott, iluvõre..." id="varuosadeotsing-input" onkeyup="varuosadeotsing()">
</div>
</div>
<div id="varuosadeotsing_tulemus"></div>
