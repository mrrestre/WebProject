<html>
    <div class="news_container">
        <?php 

            if(isset($_GET['search'])){
                $parameter = $_GET['search'];
            }

            $news = searchWithParameter ($parameter, $database); 
        
                        
        ?>
        <?php foreach ($news as $row) {
            
            $articleImage = getArticleImage ( $row['newsId'], $database );
            $articleImage = $articleImage[0];?>

            <?php
                $href = whereShouldTheLinkTakeMeTo($row, $database);
                $alreadyBought = '';
                if(isset($_SESSION['currentUser'])){
                    $userid = $_SESSION['currentUser'];
                    $alreadyBought = hasUserBuyedThisArticle($userid, $row['newsId'], $database);
                }
            ?>

            <div class="new">
                <div class="title">
                    <a href=<?=$href?>><?=$row['newsTitle'] ?></a>
                </div>
                
                <a href=<?=$href?>>
                <img src="<?='./assets/images/'.$articleImage['imagePath'];?>" alt="<? echo $articleImage['copyright'] ?>"></a>

                <div class="info">
                    <p><?=$row['newsShortDescription'] ?></p>

                    <div class="published">
                        <?php 
                            if(isset($row))
                            {
                                if($row['paidNew'] == 1){
                                    if($alreadyBought == true){
                                        echo 'You already bought this article <br>';
                                    }
                                    else{
                                        echo 'Price: '.$row['price'].'€<br>';
                                    }
                                }
                            }
                        ?>
                        Published on <?=$row['creation']?> by <?=$row['authorName'] ?>
                        <? if($row['updated'] != NULL){
                            echo 'updated on '.$row['updated'];
                        }?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>    
</html>