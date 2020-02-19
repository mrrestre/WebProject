<!DOCTYPE html>
<html lang="en">

<?php
    if(isset($_GET['submit'])){
        $search = $_GET['search'];
        header("Location: index.php?page=searchResults&search=$search");
    }
?>

    <head>
        <link type="text/css" href="./assets/css/headerStyle.css" rel="stylesheet" />      
        <?php include 'init/30_fonts.php' ?>
    </head>

    <body>
        <header>

            <div class="top_header">
                <nav>
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

            <div class="middle_header">
                <a href="index.php?page=home" class="logo">
                    <img src="./assets/logo/logo-crop.png" alt="TakeTec">
                </a>
            </div>

            <div class="bottom_header">
                <nav>
                    <a class="<?php $active = ($_GET['page'] === 'home' || $_GET['page'] === '' ? 'btn_active' : 'btn'); 
                    echo $active; ?>" href="index.php?page=home">Home</a>
                    
                    <div class = "btn">
                        <div class = "top10">
                            <button class = "tp10">Top 10</button>
                            <ul>
                                <li><a href="index.php?page=top10&type=comment">Comments</a></li>
                                <li><a href="index.php?page=top10&type=likes">Likes</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <?php $random=getRandomNumberFromIdRange( $database ); ?>

                    <a class="<?php $active = ($_GET['page'] === 'readArticle' ? 'btn_active' : 'btn');
                    echo $active; ?>" href="index.php?page=readArticle&newsid=<?echo $random?>">Random</a>
                    
                    <a class="<?php $active = ($_GET['page'] === 'aboutUs' ? 'btn_active' : 'btn');
                    echo $active; ?>" href="index.php?page=aboutUs">About Us</a>
                
                    <div class="search-container">
                        <form action="index.php?" name="searchform" method="GET">
                            <input type="text" id="search" name="search" placeholder="Search..." maxlength = "50">
                            <input type="submit" id="submit" name="submit" value="">
                        </form>                       
                    </div>
                </nav>
            </div>
        </header>
    </body> 
</html>