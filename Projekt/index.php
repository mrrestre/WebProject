<?php

// all require stuff to work!!
require_once 'init/10_database.php';
require_once 'init/20_functions.php';

define('ROOT', realpath(__DIR__.'/.'));   		// Define absolute path to this file's directory

if (!isset($_GET['page'])){
	$page = 'home';
}
else{
	$page = $_GET['page'];      				// Set page variable in URI
}
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



