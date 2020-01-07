<!DOCTYPE html>
<html lang="en">

<head>
    <link type="text/css" href="./assets/css/headerStyle.css" rel="stylesheet" />
</head>

<header>
    <div class="headerbackround">
        <div class="header">
            <a href="index.php?page=home" class="logo">
                <img src="./assets/logo/logo-crop.png" alt="TakeTec" style="width:200px;">
            </a>
            <div class="header-left">
                <nav>
                    <a href="index.php?page=home">Home</a>
                    <a href="index.php?page=top10">Top 10</a>
                    <a href="index.php?page=users">Users</a>
                    <?php $random = 0; ?>  <!-- Random Funktion hier hinzüfugen -->
                    <a href="index.php?page=readArticle&newsid=<?echo $random?>">Random</a>
                </nav>
            </div>
            <div class="header-right">
                <nav>
                    <a href="index.php?page=contact">Contact</a>
                    <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) : ?>
                        <a href="index.php?page=profile">Profile</a>
                        <a href="index.php?page=logout">Logout</a>
                        <?php 
                            if( $_SESSION['admin'] === true )
                            {
                                ?> <a href="index.php?page=admin">Admin</a> <?php
                            }
                        ?>
                    <?php else : ?>
                        <a href="index.php?page=login">Login</a> 
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </div>
</header>
    
</html>