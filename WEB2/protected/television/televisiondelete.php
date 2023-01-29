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
<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	
<?php else : ?>
	<?php 
		if(array_key_exists('d', $_GET) && !empty($_GET['d'])) {
			$query = "DELETE FROM television WHERE id = :id";
			$params = [':id' => $_GET['d']];
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba törlés közben!";
			}
		}
	?>
<?php 
	$query = "SELECT id, name, stock, price FROM television ORDER BY name";
	require_once DATABASE_CONTROLLER;
	$televisions = getList($query);
?>
	<?php if(count($televisions) <= 0) : ?>
		<h1>Nincs tévé az adattáblában</h1>
	<?php else : ?>
        
		<table>
			<thead>
				<tr>
					<th scope="col">id</th>
					<th scope="col">Név</th>
					<th scope="col">Darabszám</th>
					<th scope="col">Ár</th>
					<th scope="col">Törlés</th>					
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($televisions as $t) : ?>
					<?php $i++; ?>
					<tr>
						<td scope="row"><?=$i ?></td>
						<td><?=$t['name'] ?></td>
						<td><?=$t['stock'] ?></td>
						<td><?=$t['price'] ?></td>
                                                <td><a href="?P=listtelevision&d=<?=$t['id'] ?>"><button>Törlés</button></td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	<?php endif; ?>
<?php endif; ?>