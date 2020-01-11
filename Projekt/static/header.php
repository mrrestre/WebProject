<!DOCTYPE html>
<html lang="en">

    <head>
        <link type="text/css" href="./assets/css/headerStyle.css" rel="stylesheet" />
    </head>

    <body>
        <header>
            <div class="top_header">

            </div>
            <div class="middle_header">
                <a href="index.php?page=home" class="logo">
                    <img src="./assets/logo/logo-crop.png" alt="TakeTec" style="width:200px;">
                </a>
            </div>
            <div class="bottom_header">
                <nav>
                    <a href="index.php?page=home">Home</a>
                    <a href="index.php?page=top10">Top 10</a>
                    <?php $random=getRandomNumberFromIdRange( $database ); ?>
                    <a href="index.php?page=readArticle&newsid=<?echo $random?>">Random</a>
                    <a href="index.php?page=contact">Contact</a>

                    <?php 
                        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) { ?>
                            <a href="index.php?page=profile">Profile</a>
                            <a href="index.php?page=logout">Logout</a>
                            <?php 
                            if( $_SESSION['admin'] === true )
                            {
                                ?> <a href="index.php?page=admin">Admin</a> <?php
                            }}  
                        else { ?>
                        <a href="index.php?page=login">Login</a>
                        <?php } ?>                
                </nav>
            </div>
        </header>
    </body> 
</html>