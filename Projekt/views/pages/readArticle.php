<?php
    $newsid = $_GET['newsid'];
    $userid = -1;
    
    if(isset($_SESSION['currentUser'])){
        $userid = $_SESSION['currentUser'];
    }

    $isPaid = isAPaidArticle ($newsid, $database);

    if($isPaid == true){
        if($userid == -1){
            header("Location: index.php?page=login");
        }
        else {
            $boughtIt = hasUserBuyedThisArticle ($userid, $newsid, $database);
            if ($boughtIt == false) {
                $link = 'index.php?page=buyArticle&newsid='.$newsid;
                header("Location: $link");
            }
        }
        
    }

    if(isset($_GET['like']))
    {
        if(isset($_GET['newsid']) && isset($_SESSION['loggedIn']))
        {
            likeCounterIncreasing($database, $_GET['newsid']);
        }
        else
        {
            echo 'You can only Like this Article if you are logged in ';
        }
    }
    if(isset($_POST['submit']))
    {
        if(isset($_POST['comment'])
        &&isset($_GET['newsid']) 
        &&isset($_SESSION['currentUser']))
        {
            $request = $database->prepare("INSERT INTO comment (content, newsId, userId) 
                                         VALUES (:comment, :newsId, :userId)");
            $request->execute(['comment' => $_POST['comment'],
                            'newsId' => $_GET['newsid'],
                            'userId' => $_SESSION['currentUser']]);
        }
    }
?>
<html>
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
                <div class="title">
                    <?=$article['newsTitle'] ?>
                    <p>
                        <?=$article['newsShortDescription']?><br>
                        By: <?=$article['authorName'] ?>
                    </p>
                </div>
                <div class="prove">
                    <div class="article">
                        <div class="image">
                            <img src="<?='./assets/images/'.$articleImage['imagePath'];?>" alt="<? echo $articleImage['copyright'] ?>">
                        </div>
                        <div class="content">
                            <p><?=nl2br($article['content'])?></p>
                        </div>
                        <div class="creation">
                            Published on <?= $article['creation']?> by <?=$article['authorName'] ?>
                            <? if($article['updated'] != NULL)
                                {
                                    echo 'updated on '.$article['updated'];
                                }?>
                            <? endif?>
                            <br>Copyright: <?=$article['copyright'] ?>
                        </div>
                    </div>  
                    <div class="comments">
                        <?php 
                        $likes = getNumberOfLikes($database, $id_article);
                        $likes = $likes[0];
                        ?>
                        <form action="index.php?page=readArticle&newsid=<?=$id_article?>&like=true" method="POST">
                                <input type="image" src="./assets/icons/like.png" alt="Like" name="like" value="like"/> <?=$likes['likes']?>
                        </form>                     
                        
                        <? foreach($articleComment as $row): ?>
                            <div class="singular">
                                <h5> Commented by: <?= $row['userName']; ?> </h5>
                                <p> <?= $row['content']; ?> </p>
                            </div>
                        <? endforeach ?>
                        <?php
                        if(isset($_SESSION['loggedIn'])) {
                            ?>
                            <div class="makecomment">
                                <h5> Do you want to comment? </h5>
                                <form action="index.php?page=readArticle&newsid=<?=$id_article?>" method="POST">
                                    <textarea id="comment" name="comment" placeholder="Your Comment here" style="height:100px; width:100%"></textarea>
                                    <label for="submit">
                                        <input type="submit" id="submit" name="submit" value="Save">
                                    </label>
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
    </body>
</html>