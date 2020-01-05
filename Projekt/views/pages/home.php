<!DOCTYPE html>


<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" href="./assets/css/homeStyle.css" rel="stylesheet">
    </head>

    <body>
        <? $news = fetchNews ($database); ?>
        <?php foreach ($news as $row) ?>
            <h2><a href="read-news.php?newsid=<?= $row['newsId'] ?>"><?= $row['newsTitle'] ?></a></h2>
            <p><?= $row['newsShortDescription'] ?></p>
            <span>published on <?= $row['creation']?> by <?= $row['authorName'] ?></span>
    </body>    
</html>