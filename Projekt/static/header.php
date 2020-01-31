<!DOCTYPE html>
<html lang="en">

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
                    <a class="<?php $active = ($_GET['page'] === 'home' || $_GET['page'] === '' ? 'btn active' : 'btn'); 
                    echo $active; ?>" href="index.php?page=home">Home</a>
                    
                    <div class = "dropdown">
                        <button class="dropbtn">
                            Top 10 
                        </button>
                        <div class = "dropdown-content">
                            <a href="index.php?page=top10">Comments</a>
                            <a href="index.php?page=top10">Likes</a>
                        </div>
                    </div>
                    
                    <?php $random=getRandomNumberFromIdRange( $database ); ?>
                    <a class="<?php $active = ($_GET['page'] === 'readArticle' ? 'btn active' : 'btn');
                    echo $active; ?>" href="index.php?page=readArticle&newsid=<?echo $random?>">Random</a>
                    
                    <a class="<?php $active = ($_GET['page'] === 'aboutUs' ? 'btn active' : 'btn');
                    echo $active; ?>" href="index.php?page=aboutUs">About Us</a>

                    <div class="search-container">
                        <form>
                            <input type="text" id="search" name="search" placeholder="Search...">    
                            <input type="image" src="./assets/icons/search.png" alt="Search"/>
                        </form>                       
                    </div>
                    
                </nav>
            </div>
        </header>
    </body> 
</html>