<?php
    if(isset($_GET['filterSubmit'])){
        $category = $_GET['category'];
        $category = $category[0];
        
        $news = getArticlesFromCategory ($category,$database);
    }
?>

<html>
    <form action="index.php?page=home" method="GET">
        <div class="filter">
            <div class="categories">
                <input type="checkbox" class="regular-checkbox" id="IOS" name="category[]" value="IOS"> <label for="IOS">IOS</label>
                <input type="checkbox" class="regular-checkbox" id="Android" name="category[]" value="Android"> <label for="Android">Android</label>
                <input type="checkbox" class="regular-checkbox" id="Apple" name="category[]" value="Apple"> <label for="Apple">Apple</label>
                <input type="checkbox" class="regular-checkbox" id="Windows" name="category[]" value="Windows"> <label for="Windows">Windows</label>
                <input type="checkbox" class="regular-checkbox" id="Wearables" name="category[]" value="Wearables"> <label for="Wearables"> Wearables</label>
                <input type="checkbox" class="regular-checkbox" id="Audio" name="category[]" value="Audio">  <label for="Audio">Audio</label>
                <input type="checkbox" class="regular-checkbox" id="ChromeOS" name="category[]" value="Chrome OS">  <label for="ChromeOS">Chrome OS</label>
            </div>
            <input type="submit" id="filterSubmit" name="filterSubmit" value="Filter" class="filterSubmit">     
        </div>
        
    </form>

    <div class="news_container">
        <?php 
            if(empty($news)){
                $news = fetchNews ($database);
            } 
        ?>
        <?php foreach ($news as $row) {
            
            $articleImage = getArticleImage ( $row['newsId'], $database );
            $articleImage = $articleImage[0];?>

            <div class="new">
                <div class="title">
                    <a href="index.php?page=readArticle&newsid=<?=$row['newsId'] ?>"><?=$row['newsTitle'] ?></a>
                </div>
                
                <a href="index.php?page=readArticle&newsid=<?=$row['newsId'] ?>">
                <img src="<?='./assets/images/'.$articleImage['imagePath'];?>" alt="<? echo $articleImage['copyright'] ?>"></a>

                <div class="info">
                    <p><?=$row['newsShortDescription'] ?></p>

                    <div class="published">
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