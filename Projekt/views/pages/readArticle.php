<?php
    if(isset($_POST['like']))
    {
        if(isset($_GET['newsid']) && isset($_SESSION['loggedIn']))
        {
            likeCounterIncreasing($database, $_GET['newsid']);
        }
        else
        {
            echo 'you can only Like our Article if you logged in ';
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
                    <?php 
                    $likes = getNumberOfLikes($database, $id_article);
                    $likes = $likes[0];
                    ?>
                    <form action="index.php?page=readArticle&newsid=<?=$id_article?>" method="POST">
                    <input type="submit" name="like" Value="like"> <?=$likes['likes']?>
                    </form>
                </div>
                
                <? foreach($articleComment as $row): ?>
                    <h4> Commented by: <?= $row['userName']; ?> </h4>
                    <p> <?= $row['content']; ?> </p>
                <? endforeach ?>
    </body>
</html>