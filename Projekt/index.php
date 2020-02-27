<?php
	//For the first load of the page
	if(empty($_SESSION))
	{ 
		session_start();
	}

	//If a session exists and no one is logged in
	if(empty($_SESSION['loggedIn'])){
		$_SESSION['loggedIn'] = null;
		$_SESSION['justLoggedIn'] = null;
	}

	//If a session exists and no one with Admin Permission is logged in
	if(empty($_SESSION['admin'])){
		$_SESSION['admin'] = null;
	}

	//All require stuff to work
	require_once 'init/10_database.php';
	require_once 'init/20_functions.php';

	//Definition of absolute path from the whole Proyect
	define('ROOT', str_replace('\\', '/', realpath(__DIR__)));

	//Set page variable in URI
	if (!isset($_GET['page']))
	{
		$page = 'home';
	}
	else
	{
		$page = $_GET['page'];      				
	}
?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<?php echo file_get_contents("static/head.html"); ?>
		<link type="text/css" href="./assets/css/home.css" rel="stylesheet"/>
		<!-- Automatic include the CSS design file for each page -->
		<?php 
			if($page !== 'home')
			{
				?> <link type="text/css" href="./assets/css/<?=$page?>.css" rel="stylesheet"/> <?php
			}
		?>

			<!-- Automatic include the JS  file for each page -->
		<script language="javascript" type="text/javascript" src="./assets/js/<?=$page?>.js"></script>
	</head>

	<body>
		<div class="content_wrap" id="content_wrap">
		
			<header>
				<?php include_once "static/header.php"; ?>
			</header>

			<noscript>
				<p>
					Your browser does not support JavaScript!
					To enjoy all the functions of this Website please turn on JavaScript
				</p>
			</noscript>
				
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
						case 'aboutUs':
							include(ROOT.'/views/pages/aboutUs.php');
							break;
						case 'searchResults':
							include(ROOT.'/views/pages/searchResults.php');
							break;
						case 'readArticle':
							include(ROOT.'/views/pages/readArticle.php');
							break;
						case 'contact':
							include(ROOT.'/views/pages/contact.php');
							break;
						case 'buyArticle':
							include(ROOT.'/views/pages/buyArticle.php');
							break;
						case 'admin':
							// First case: Logged in and Admin?
							if($_SESSION['admin'] === true &&  $_SESSION['loggedIn'] === true)
							{
								include(ROOT.'/views/pages/admin.php');
							}
							// Second case: Logged in but not an Admin 
							else if($_SESSION['loggedIn'] === true)
							{ 
								echo 'Sorry!! you do not have Permission to do that';
							}
							// Third case: not logged in at all
							else
							{
								header("Location: index.php?page=login");
								echo 'Please Login first';
							}
							break;
						case 'login':
							// You can cannot Log in if already logged in
							if($_SESSION['loggedIn'] === true)
							{
								?><br><a href="index.php?page=home">Go to Home</a><?php
								echo 'You are already logged in ';	
							}
							else 
							{
								include(ROOT.'/views/pages/login.php');
							}
							break;
						case 'logout':
							include(ROOT.'/views/pages/logout.php');
							break;
						case 'profile':
							//only if logged in is shown
							if($_SESSION['loggedIn'] === true)
							{
								include(ROOT.'/views/pages/profile.php');
							}
							else{
								header("Location: index.php?page=login");
								echo 'Please Login first';
							}
							break;
						case 'updateProfile':
							//only if logged in is shown
							if($_SESSION['loggedIn'] === true)
							{
								include(ROOT.'/views/pages/updateProfile.php');
							}
							else{
								header("Location: index.php?page=login");
								echo 'Please Login first';
							}
							break;
						case 'registration':
							if($_SESSION['loggedIn'] !== true)
							{
								include(ROOT.'/views/pages/registration.php');
							}
							else if($_SESSION['loggedIn'] === true)
							{
								header("Location: index.php?page=home");
								echo 'You are already registered';
							}
							break;
						case 'impressum':
							include(ROOT.'/views/pages/impressum.html');
							break;
						case 'addArticle':
							//only if admin is shown
							if($_SESSION['admin'] === true &&  $_SESSION['loggedIn'] === true)
							{
								include(ROOT.'/views/pages/addArticle.php');
							}
							else if($_SESSION['loggedIn'] === true)
							{
								echo 'Sorry!! you do not have a Permission to do that';
							}
							else{
								header("Location: index.php?page=login");
								echo 'Please Login first';
							}
							break; 
						case 'deleteUser':
							//only if admin is shown
							if($_SESSION['admin'] === true &&  $_SESSION['loggedIn'] === true)
							{
								include(ROOT.'/views/pages/deleteUser.php');
							}
							else if($_SESSION['loggedIn'] === true)
							{
								echo 'Sorry!! you do not have a Permission to do that';
							}
							else{
								header("Location: index.php?page=login");
								echo 'Please Login first';
							}
							break; 
						case 'error404':
							include(ROOT.'/views/pages/error404.php');
							break;
						default:
							header("Location: index.php?page=error404");
							break;
					}
				?>
			</main>
		</div>
		
		<footer>
			<?php include "static/footer.php"; ?>
		</footer>
	
	</body>
</html>