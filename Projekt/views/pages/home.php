<?php
    // How to work with the Filter
    if(isset($_GET['filterSubmit'])){
        if($_GET['filterSubmit'] == 'Unset'){
            unset($_GET['filterSubmit']);
        }
        else{
        $category = $_GET['filterSubmit'];
    
        $news = getArticlesFromCategory ($category,$database);
        }
    }
?>

<html>
    <body>
        <!-- Filters -->
        <div class="filter" id="filter">
            <form action="index.php?page=home" method="GET" class="formfilter">
                <input type="submit" id="IOSFilter" name="filterSubmit" value="IOS" class="filterSubmit">     
            </form>
            <form action="index.php?page=home" method="GET" class="formfilter">
                <input type="submit" id="AndroidFilter" name="filterSubmit" value="Android" class="filterSubmit">     
            </form>
            <form action="index.php?page=home" method="GET" class="formfilter">
                <input type="submit" id="AppleFilter" name="filterSubmit" value="Apple" class="filterSubmit">     
            </form>
            <form action="index.php?page=home" method="GET" class="formfilter">
                <input type="submit" id="WindowsFilter" name="filterSubmit" value="Windows" class="filterSubmit">     
            </form>
            <form action="index.php?page=home" method="GET" class="formfilter">
                <input type="submit" id="WearablesFilter" name="filterSubmit" value="Wearables" class="filterSubmit">     
            </form>
            <form action="index.php?page=home" method="GET" class="formfilter">
                <input type="submit" id="AudioFilter" name="filterSubmit" value="Audio" class="filterSubmit">     
            </form>
            <form action="index.php?page=home" method="GET" class="formfilter">
                <input type="submit" id="ChromeOSFilter" name="filterSubmit" value="Chrome OS" class="filterSubmit">     
            </form>
            <form action="index.php?page=home" method="GET" class="formfilter">
                <input type="submit" id="UnsetFilter" name="filterSubmit" value="Unset" class="filterSubmit">     
            </form>          
        </div>

        <!-- Button to toogle between show and hide Filters -->
        <button onclick="toggleFilter()" class="btnFilter"></button>


        <?php
            // Welcome message (if logged in)
            if($_SESSION['loggedIn'] === true && $_SESSION['justLoggedIn'] === true)
            {
                $name = getUserNameByID ( $database, $_SESSION['currentUser'] );
                $_SESSION['justLoggedIn'] = false;

                ?><h4>Welcome Back: <?=$name['userName']?></h4><?php
            }
        ?>

        <!-- The Container for all the news -->
        <div class="news_container" id = "wrap">
            <?php 
                if(empty($news)){
                    $news = fetchNews ($database);
                } 
            ?>
            <?php
            
            foreach ($news as $row) {
                                
                $articleImage = getArticleImage ( $row['newsId'], $database );
                $articleImage = $articleImage[0];?>
                
                <?php
                    // Depending on what have the user buyed, this decides where should the link take him to
                    $href = whereShouldTheLinkTakeMeTo($row, $database);
                    $alreadyBought = '';
                    if(isset($_SESSION['currentUser'])){
                        $userid = $_SESSION['currentUser'];
                        $alreadyBought = hasUserBuyedThisArticle($userid, $row['newsId'], $database);
                    }
                ?>

                <!-- Each New -->
                <div class="new">

                    <div class="title">
                        <a href=<?=$href?>><?=$row['newsTitle'] ?></a>
                    </div>
                    
                    <!-- Explanation: Look in the PHP code just above this -->
                    <a href=<?=$href?>>
                    <img src="<?='./assets/images/'.$articleImage['imagePath'];?>" alt="<? echo $articleImage['copyright'] ?>"></a>

                    <!-- The bottom Information from each Article -->
                    <div class="info">
                        <p><?=$row['newsShortDescription'] ?></p>

                        <div class="published">
                            
                            <!-- Decides if the Price is showed or if this user has already bought this article -->
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
    </body>
</html>