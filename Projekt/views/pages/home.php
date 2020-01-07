<html>
    <head>
    <!-- hier den css von home hinzüfugen -->
    </head>
    <body>
        <?php $news = fetchNews ($database); ?>
        <? foreach ($news as $row) :?>
            <h2><a href="index.php?page=readArticle&newsid=<?=$row['newsId'] ?>"><?=$row['newsTitle'] ?></a></h2>
            <p><?=$row['newsShortDescription'] ?></p>
            <div>
                published on <?=$row['creation']?> by <?=$row['authorName'] ?>
                <? if($row['updated'] != NULL){
                    echo 'updated on '.$row['updated'];
                }?>
            </div>
        <? endforeach?>
    </body>    
</html>