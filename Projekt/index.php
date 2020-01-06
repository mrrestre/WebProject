<?php

session_start();

// all require stuff to work!!
require_once 'init/10_database.php';
require_once 'init/20_functions.php';

define('ROOT', str_replace('\\', '/', realpath(__DIR__)));

if (!isset($_GET['page'])){
	$page = 'home';
}
else{
	$page = $_GET['page'];      				// Set page variable in URI
}

$GLOBALS['currentUser'] = null;

?>

<html>
	<head>
		<?php echo file_get_contents("static/head.html"); ?>
	</head>

	<body>
		<header>
			<?php include "static/header.php"; ?>
		</header>
		
		<footer>
				<?php include "static/footer.php"; ?>
		</footer>
	</body>
</html>



