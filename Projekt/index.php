<?php

if(!isset($_SESSION))
{ 
    session_start();
} 

// all require stuff to work!!
require_once 'init/10_database.php';
require_once 'init/20_functions.php';

define('ROOT', str_replace('\\', '/', realpath(__DIR__)));

$GLOBALS['currentUser'] = '';

if (!isset($_GET['page']))
{
	$page = 'home';
}
else
{
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
		
		<main>
			<?php
				// Switch section content based on URI
				switch($page) {
					case '';
						include(ROOT.'/views/pages/home.php');
						break;
					case 'home':
						include(ROOT.'/views/pages/home.php');
						break;
					case 'top10':
						include(ROOT.'/views/pages/top10.php');
						break;
					case 'users':
						include(ROOT.'/views/pages/users.php');
						break;    
					case 'readArticle':
						include(ROOT.'/views/pages/readArticle.php');
						break;
					case 'contact':
						include(ROOT.'/views/pages/contact.php');
						break;
					case 'admin':
						include(ROOT.'/views/pages/admin.php');
						break;
					case 'login':
						include(ROOT.'/views/pages/login.php');
						break;
					case 'logout':
						include(ROOT.'/views/pages/logout.php');
						break;
					case 'profile':
						include(ROOT.'/views/pages/profile.php');
						break;
					case 'registration':
						include(ROOT.'/views/pages/registration.php');
						break;
					case 'impressum':
						include(ROOT.'/views/pages/impressum.html');
						break; 
					default:
						include(ROOT.'/views/pages/error404.php');
						break;
				}
			?>
		</main>

		
		<footer>
			<?php include "static/footer.php"; ?>
		</footer>
	</body>
</html>



