<?php

session_start();

// all require stuff to work!!
require_once 'init/10_database.php';
require_once 'init/20_functions.php';
require_once 'init/30_const.php';

?> 

<html>
<head></head>
<body>
	<?php 
 		$article = getAnArticle( 0, $database );
		$image = getArticleImage( 0, $database );
		$category = getArticleCategory ( 0, $database);
	?>

	<h2><?= $article->newsTitle ?></h2>
	<span>published on <?= $article->creation ?> by <?= $article->authorName ?></span>
	<?= $article->content ?>
	<hr>

	<? echo $image->imagePath ?>

	<hr>
	<!-- <img src="assets\images\apple.jpg"> -->

	<hr>
	<img src="<?= $image->imagePath ?>">
	<hr>

	<? echo $category->catId ?>



	

</body>
</html>



