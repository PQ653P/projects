<hr>

<?php if(!IsUserLoggedIn()) : ?>
	<a href="index.php?P=login">Belépés</a>
<?php else : ?>
	<a href="index.php?P=test">Hozzáférés leellenőrzés</a>
        <span> &nbsp; | &nbsp; </span>
        <a href="index.php?P=telefon">Telefonok</a>
        <span> &nbsp; | &nbsp; </span>
        <a href="index.php?P=television">Tévék</a>
        <span> &nbsp; | &nbsp; </span>
        <a href="index.php?P=soldoutproduct">Elfogyott termékek</a>
        <span> &nbsp; | &nbsp; </span>
        <a href="index.php?P=specialofferproduct">Akciós termékek</a>
        <span> &nbsp; | &nbsp; </span>
	<?php if(isset($_SESSION['permission']) && $_SESSION['permission'] >= 1) : ?>
        <a href="index.php?P=addtelefon">Telefon hozzáadása</a>  
        <span> &nbsp; | &nbsp; </span>
        <a href="index.php?P=addtelevision">TV hozzáadása</a>
        <span> &nbsp; | &nbsp; </span>
        <a href="index.php?P=picupload">Telefon kép hozzáadása</a>
        <span> &nbsp; | &nbsp; </span>
        <a href="index.php?P=listtelefon">Telefon törlése</a>
        <span> &nbsp; | &nbsp; </span>
        <a href="index.php?P=listtelevision">TV törlése</a>
        <span> &nbsp; | &nbsp; </span>
	<?php else : ?>
	<?php endif; ?>
	<a href="index.php?P=logout">Kilépés</a>
<?php endif; ?>

<hr>