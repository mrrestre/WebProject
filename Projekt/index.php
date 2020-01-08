<?php

if(empty($_SESSION))
{ 
	session_start();
}

if(empty($_SESSION['loggedIn'])){
	$_SESSION['loggedIn'] = null;
}

if(empty($_SESSION['admin'])){
	$_SESSION['admin'] = null;
}

// all require stuff to work!!
require_once 'init/10_database.php';
require_once 'init/20_functions.php';


define('ROOT', str_replace('\\', '/', realpath(__DIR__)));


if (!isset($_GET['page']))
{
	$page = 'home';
}
else
{
	$page = $_GET['page'];      				// Set page variable in URI
}


$_SESSION['admin'] && $_SESSION['loggedIn']

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
						if($_SESSION['admin'] === true &&  $_SESSION['loggedIn'] === true)
						{include(ROOT.'/views/pages/admin.php');}
						else if($_SESSION['loggedIn'] === true)
						{
							echo 'Sorry!! you do not have a Permission to do that';
						}
						else{
							include(ROOT.'/views/pages/login.php');
							echo 'please Login first';
						}
						break;
					case 'login':
						include(ROOT.'/views/pages/login.php');
						break;
					case 'logout':
						include(ROOT.'/views/pages/logout.php');
						break;
					case 'profile':
						if($_SESSION['loggedIn'] === true)
						{include(ROOT.'/views/pages/profile.php');}
						else{
							include(ROOT.'/views/pages/login.php');
							echo 'please Login first';
						}
						break;
					case 'registration':
						include(ROOT.'/views/pages/registration.php');
						break;
					case 'impressum':
						include(ROOT.'/views/pages/impressum.html');
						break;
					case 'addArticle':
						if($_SESSION['admin'] === true &&  $_SESSION['loggedIn'] === true)
						{include(ROOT.'/views/pages/addArticle.php');}
						else if($_SESSION['loggedIn'] === true)
						{
							echo 'Sorry!! you do not have a Permission to do that';
						}
						else{
							include(ROOT.'/views/pages/login.php');
							echo 'please Login first';
						}
						break; 
					case 'deleteUser':
						if($_SESSION['admin'] === true &&  $_SESSION['loggedIn'] === true)
						{include(ROOT.'/views/pages/deleteUser.php');}
						else if($_SESSION['loggedIn'] === true)
						{
							echo 'Sorry!! you do not have a Permission to do that';
						}
						else{
							include(ROOT.'/views/pages/login.php');
							echo 'please Login first';
						}
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



