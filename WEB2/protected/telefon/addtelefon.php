<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>User nem tud hozzáadni telefont!</h1>
<?php else : ?>

	<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addtelefon'])) {
		$postData = [
			'name' => $_POST['name'],
			'stock' => $_POST['stock'],
			'price' => $_POST['price'],
		];

		if(empty($postData['name']) || empty($postData['stock']) || empty($postData['price']) ) {
			echo "Hiányzó adat(ok)!";
		} else {
			$query = "INSERT INTO products (name, stock, price) VALUES (:name, :stock, :price)";
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
				<label for="telefonname">Telefon</label>
				<input type="text" class="form-control" id="telefonname" name="name">
			</div>
			<div class="form-group col-md-6">
				<label for="telefonstock">Darabszám</label>
				<input type="text" class="form-control" id="telefonstock" name="stock">
			</div>
                        <div class="form-group col-md-6">
				<label for="telefonprice">Ár</label>
				<input type="text" class="form-control" id="telefonprice" name="price">
			</div>
		</div>

		<button type="submit" class="btn btn-primary" name="addtelefon">Telefon hozzáadása</button>
	</form>
<?php endif; ?>