<html>
    <head>
        <!-- hier den css von home hinzüfugen -->
    </head>
    <body>
    <?php 
        $id_article = (int)$_GET['newsid'];
        
        $article = getAnArticle( $id_article, $database );
        $article = $article[0];
        $articleImage = getArticleImage ( $id_article, $database );
        $articleImage = $articleImage[0];
        $articleComment = getArticleComments( $id_article, $database );
    ?>
    <?php if ( $article && !empty($article) ) :?>
    
    <h2><?= $article['newsTitle'] ?></h2>
    <div>
        <?= $article['content'] ?>
        <hr>
        <img src="<?ROOT.$articleImage['imagePath'];?>" alt="<? echo $articleImage['copyright'] ?>">
        <?php echo ROOT.$articleImage['imagePath'];?>
        <hr>
    </div>
    <div>
        published on <?= $article['creation']?> by <?= $article['authorName'] ?>
        <?if($article['updated'] != NULL){
                echo 'updated on '.$article['updated'];
            }?>
    </div>  
        <?php endif?>
    <hr>
    <? foreach($articleComment as $row): ?>
        <h4> Commented by: <?=$row['userName']; ?> </h4>
        <p> <?=$row['content']; ?> </p>
    <?php endforeach ?>
    <hr><hr><hr><hr><hr><hr><hr>
    </body>
</html>