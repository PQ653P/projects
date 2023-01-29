<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
  $postData = [
    'username' => $_POST['username'],
    'password' => $_POST['password']
  ];

  if(empty($postData['username']) || empty($postData['password'])) {
    echo "Hiányzó adat(ok)!";
  } else if(!UserLogin($postData['username'], $postData['password'])) {
    echo "Hibás felhasználói név vagy jelszó!";
  }

  $postData['password'] = "";
}
?>

<form method="post">
  <div class="form-group">
    <label for="loginUsername">Felhasználónév</label>
    <input type="text" class="form-control" id="loginUsername" name="username" value="">
  </div>
  <div class="form-group">
    <label for="loginPassword">Jelszó</label>
    <input type="password" class="form-control" id="loginPassword" name="password" value="">
  </div>
  <button type="submit" class="btn btn-primary" name="login">Belépés</button>
</form>