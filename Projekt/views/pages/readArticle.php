<?php
    if(isset($_POST['like']))
    {
        if(isset($_GET['newsid']))
        {
            likeCounterIncreasing($database, $_GET['newsid']);
        }
    }
?>
<html>
    <head>
        <!-- hier den css von home hinzüfugen -->
    </head>
    <body>
        <?php 
            if(!isset($id_article))
            {
                $id_article = $_GET['newsid'];
            }
            $article = getAnArticle( $id_article, $database );
            $article = $article[0];
            $articleImage = getArticleImage ( $id_article, $database );
            $articleImage = $articleImage[0];
            $articleComment = getArticleComments( $id_article, $database );
        ?>
        <?php if ( $article && !empty($article) ) :?>
                <h2><?=$article['newsTitle'] ?></h2>
                <div>
                    <img src="<?='./assets/images/'.$articleImage['imagePath'];?>" alt="<? echo $articleImage['copyright'] ?>">
                    <?=$article['content'] ?>
                    <hr>
                </div>
                <div>
                    published on <?= $article['creation']?> by <?=$article['authorName'] ?>
                    <? if($article['updated'] != NULL)
                        {
                            echo 'updated on '.$article['updated'];
                        }?>
                    <? endif?>
                </div>  
                <div>
                    <form action="index.php?page=readArticle&newsid=<?=$id_article?>" method="POST">
                        <input type="submit" name="like" Value="like">
                    </form>
                </div>
                
                <? foreach($articleComment as $row): ?>
                    <h4> Commented by: <?= $row['userName']; ?> </h4>
                    <p> <?= $row['content']; ?> </p>
                <? endforeach ?>
    </body>
</html>