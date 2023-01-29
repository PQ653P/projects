<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>User nem tud hozzáadni televíziót!</h1>
<?php else : ?>

	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addtelevision'])) {
		$postData = [
			'name' => $_POST['name'],
			'stock' => $_POST['stock'],
			'price' => $_POST['price'],
		];

		if(empty($postData['name']) || empty($postData['stock']) || empty($postData['price']) ) {
			echo "Hiányzó adat(ok)!";
		} else {
			$query = "INSERT INTO television (name, stock, price) VALUES (:name, :stock, :price)";
			$params = [
				':name' => $postData['name'],
				':stock' => $postData['stock'],
				':price' => $postData['price'],
			];
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba az adatbevitel során!";
			} header('Location: index.php');
		}
	}
	?>

	<form method="post">
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="televisionname">TV</label>
				<input type="text" class="form-control" id="televisionname" name="name">
			</div>
			<div class="form-group col-md-6">
				<label for="televisionstock">Darabszám</label>
				<input type="text" class="form-control" id="televisionstock" name="stock">
			</div>
                        <div class="form-group col-md-6">
				<label for="television">Ár</label>
				<input type="text" class="form-control" id="televisiononprice" name="price">
			</div>
		</div>

		<button type="submit" class="btn btn-primary" name="addtelevision">TV hozzáadása</button>
	</form>
<?php endif; ?>