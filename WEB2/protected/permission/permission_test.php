<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Belépve userként</h1>
	
<?php else : ?>
	<h1>Belépve adminként</h1>
	
<?php endif; ?>