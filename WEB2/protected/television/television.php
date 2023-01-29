<?php require_once 'protected/database.php'; ?>
<?php require_once USER_MANAGER; ?>
<?php
    $query = "SELECT * FROM television ORDER BY name;";
    $records = select($query);
    $delivery = "SELECT * FROM delivery ORDER BY id;";
    $szallitas = select($delivery);
    ?>
<!DOCTYPE html>
<html>
<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<title>Tévék</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	<link rel="stylesheet" type="text/css" href="<?=PUBLIC_DIR.'style.css?'.date('YmdHis', filemtime(PUBLIC_DIR.'style.css'))?>">
        
</head>
<body>
    
    
    <div style="padding:1px 16px;height:1000px;">
<style>
h1 {text-align: center;
    color: coral;
}
table{
  border: 2px solid black;
  margin-left:auto; 
  margin-right:auto;
}
td{
    border: 2px solid black;
    font-size: 30px;
}
</style>
<h1>Tévék</h1>
            <br>
        <table>
        <thead>
            <tr>
                <th>Név</th>
                <th>Darabszám</th>
                <th>Ár</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($records as $record): ?>
            <tr>
                <td><?=$record['name']?></td>
                <td><?=$record['stock']?> darab</td>
                <td><?=$record['price']?> Ft</td>           
                
            </tr>
            <?php endforeach;?>
        </tbody>
             <br>   
      <table class="szallitas">
        <thead>
            <th colspan="10">Szállítás</th>
            <tr>
                <th>Név</th>
                <th>Ár</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($szallitas as $record): ?>
            <tr>
                <td><?=$record['name']?></td>
                <td><?=$record['price']?> Ft</td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
        </div>
	<div class="container-fluid">
		<header><?php include_once PROTECTED_DIR.'header.php'; ?></header>
		<nav><?php require_once PROTECTED_DIR.'nav.php'; ?></nav>
		<content><?php require_once PROTECTED_DIR.'routing.php'; ?></content>
	</div>
</body>
</html>