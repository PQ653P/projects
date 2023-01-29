<?php 
if(!array_key_exists('P', $_GET) || empty($_GET['P']))
	$_GET['P'] = 'home';

switch ($_GET['P']) {

	case 'test': require_once PROTECTED_DIR.'permission/permission_test.php'; break;

	case 'login': !IsUserLoggedIn() ? require_once PROTECTED_DIR.'felhasznalo/login.php' : header('Location: index.php'); break;

        case 'telefon': IsUserLoggedIn() ? require_once PROTECTED_DIR.'telefon/telefon.php' : header('Location: index.php'); break;

        case 'television': IsUserLoggedIn() ? require_once PROTECTED_DIR.'television/television.php' : header('Location: index.php'); break;
        
        case 'soldoutproduct': IsUserLoggedIn() ? require_once PROTECTED_DIR.'soldoutproduct/soldoutproduct.php' : header('Location: index.php'); break;
        
        case 'specialofferproduct': IsUserLoggedIn() ? require_once PROTECTED_DIR.'specialofferproduct/specialofferproduct.php' : header('Location: index.php'); break;
        
	case 'logout': IsUserLoggedIn() ? UserLogout() : header('Location: index.php'); break;
        
        case 'addtelefon': IsUserLoggedIn() ? require_once PROTECTED_DIR.'telefon/addtelefon.php' : header('Location: index.php'); break;
        
        case 'addtelevision': IsUserLoggedIn() ? require_once PROTECTED_DIR.'television/addtelevision.php' : header('Location: index.php'); break;
        
        case 'listtelefon': IsUserLoggedIn() ? require_once PROTECTED_DIR.'telefon/telefondelete.php': header('Location: index.php'); break;
        
        case 'listtelevision': IsUserLoggedIn() ? require_once PROTECTED_DIR.'television/televisiondelete.php': header('Location: index.php'); break;
        
        case 'picupload': IsUserLoggedIn() ? require_once PROTECTED_DIR.'picupload.php': header('Location: index.php'); break;
}

?>