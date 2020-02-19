<html>
    <div class="news_container">
        <?php
            if(isset($_GET['type'])) 
            {
                if($_GET['type'] == 'comment') 
                {
                    $news = fetchNewsWithMostComments ($database);
                }
                else 
                {
                    $news = fetchNewsWithMostLikes ($database);
                }
            }        
        ?>
        <?php foreach ($news as $row) {
            
            $articleImage = getArticleImage ( $row['newsId'], $database );
            $articleImage = $articleImage[0];?>

            <div class="new">
                <div class="title">
                    <a href="index.php?page=readArticle&newsid=<?=$row['newsId'] ?>"><?=$row['newsTitle']?></a>
                </div>
                
                <a href="index.php?page=readArticle&newsid=<?=$row['newsId'] ?>">
                <img src="<?='./assets/images/'.$articleImage['imagePath'];?>" alt="<? echo $articleImage['copyright'] ?>"></a>

                <div class="info">
                    <p><?=$row['newsShortDescription'] ?></p>

                    <div class="published">
                        <?php if(isset($row['nmComments'])){
                            echo 'Comments: ';
                            echo $row['nmComments'];
                        }?>
                        <?php if(isset($row['likes'])){
                            echo 'Likes: ';
                            echo $row['likes'];
                        }?>
                        || Published on <?=$row['creation']?> by <?=$row['authorName'] ?>
                        <? if($row['updated'] != NULL){
                            echo 'updated on '.$row['updated'];
                        }?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>    
</html>