<?php 

define('BASE_DIR', './');
define('PUBLIC_DIR', BASE_DIR.'public/');
define('PROTECTED_DIR', BASE_DIR.'protected/');

define('DATABASE_CONTROLLER', PROTECTED_DIR.'database.php');
define('USER_MANAGER', PROTECTED_DIR.'userManager.php');

define('DB_PORT','3306');
define('DB_TYPE', 'mysql');
define('DB_HOST', 'remotemysql.com');
define('DB_NAME', 'te0CGdFOoc');
define('DB_USER', 'te0CGdFOoc');
define('DB_PASS', 'WybAXOr7et');
define('DB_CHARSET', 'utf8');

function getConnection(){
    $dsn = DB_TYPE.':host='.DB_HOST.':'.DB_PORT.';dbname='.DB_NAME;
    $connection = new PDO($dsn,DB_USER,DB_PASS);

    $connection->exec("SET NAMES 'utf8'");
    return $connection;
}

function insert($query, $params){
    $connection = getConnection();
    $statement = $connection->prepare($query);
    $success = $statement->execute($params);
    $statement->closeCursor();
    $connection = null; 
    return $success;}

function select($query, $params = []){
    $connection = getConnection();
    $statement = $connection->prepare($query);
    $success = $statement->execute($params);

    $records = $success ? $statement->fetchAll(PDO::FETCH_ASSOC) : [];
    $statement->closeCursor();
    $connection = null;

    return $records;

}

function getRecord($queryString, $queryParams = []) {
	$connection = getConnection();
	$statement = $connection->prepare($queryString);
	$success = $statement->execute($queryParams);
	$result = $success ? $statement->fetch(PDO::FETCH_ASSOC) : [];
	$statement->closeCursor();
	$connection = null;
	return $result;
}

function getList($queryString, $queryParams = []) {
	$connection = getConnection();
	$statement = $connection->prepare($queryString);
	$success = $statement->execute($queryParams);
	$result = $success ? $statement->fetchAll(PDO::FETCH_ASSOC) : [];
	$statement->closeCursor();
	$connection = null;
	return $result;
}

function executeDML($queryString, $queryParams = []) {
	$connection = getConnection();
	$statement = $connection->prepare($queryString);
	$success = $statement->execute($queryParams);
	$statement->closeCursor();
	$connection = null;
	return $success;
}

function getField($queryString, $queryParams = []) {
	$connection = getConnection();
	$statement = $connection->prepare($queryString);
	$success = $statement->execute($queryParams);
	$result = $success ? $statement->fetch()[0]: [];
	$statement->closeCursor();
	$connection = null;
	return $result;
}

function delete($query, $params){ 
    $connection = getConnection();
    $statement = $connection->prepare($query);
    $success = $statement->execute($params);
    $statement->closeCursor();
    $connection = null; 
    return $success;
}

function selectOne($query, $params = []){
    $connection = getConnection();
    $statement = $connection->prepare($query);
    $success = $statement->execute($params);

    $record = $success ? $statement->fetch(PDO::FETCH_ASSOC) : [];
    $statement->closeCursor();
    $connection = null;

    return $record;

}
?>