<?php require_once 'protected/database.php'; ?>
<?php require_once USER_MANAGER; ?>
<?php
    $query = "SELECT * FROM product ORDER BY id;";
    $records = select($query);
    $delivery = "SELECT * FROM delivery ORDER BY id;";
    $szallitas = select($delivery);
    ?>
<!DOCTYPE html>
<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<title>Telefonok</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="<?=PUBLIC_DIR.'style.css?'.date('YmdHis', filemtime(PUBLIC_DIR.'style.css'))?>">
        
</head>
<body>
    
    
<div style="padding:1px 16px;height:1000px;">

    <form method="POST" action="upload.php" enctype="multipart/form-data">
    <label for="upload">Fájl:</label>
    <input type="file" id="upload" name="file"/>
    <button type="submit" name="submit" value="upload">
    MENTÉS
    </button>
    
    <img class="kep" src="./pushedpic/telefon.png." alt="telefon"/>
    
    </form>
	<div class="container-fluid">
		<header><?php include_once PROTECTED_DIR.'header.php'; ?></header>
		<nav><?php require_once PROTECTED_DIR.'nav.php'; ?></nav>
		<content><?php require_once PROTECTED_DIR.'routing.php'; ?></content>
	</div>
</body>
</html>