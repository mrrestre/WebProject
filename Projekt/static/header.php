<!DOCTYPE html>
<html lang="en">

<?php
    //If the user is searching for something
    if(isset($_GET['searchSubmit'])){
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
                    // Decides which button each user is allowed to see 
                    if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) { ?>
                        <a href="index.php?page=profile">Profile</a>
                        <a href="index.php?page=logout">Logout</a>
                        <?php 
                        //Admin Button appears only if the current user is an Admin
                        if( $_SESSION['admin'] === true )
                        {
                            ?> <a href="index.php?page=admin">Admin</a> <?php
                        }}  
                    // For the case the user hasn't logged in
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
                            <button class ="<?php $active = ($_GET['page'] === 'top10' || $_GET['page'] === '' ? 'tp10_active' : 'tp10'); 
                             echo $active; ?>">
                                Top 10
                             </button>
                            <ul>
                                <li><a href="index.php?page=top10&type=comment">Comments</a></li>
                                <li><a href="index.php?page=top10&type=likes">Likes</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <?php $random=getRandomNumberFromIdRange( $database ); //Used for the Random Article button?>

                    <a class="<?php $active = ($_GET['page'] === 'readArticle' ? 'btn_active' : 'btn');
                    echo $active; ?>" href="index.php?page=readArticle&newsid=<?echo $random?>">Random</a>
                    
                    <a class="<?php $active = ($_GET['page'] === 'aboutUs' ? 'btn_active' : 'btn');
                    echo $active; ?>" href="index.php?page=aboutUs">About Us</a>
                
                    <div class="search-container">
                        <form action="index.php?" name="searchform" method="GET">
                            <input type="text" id="search" name="search" placeholder="Search..." maxlength = "50">
                            <input type="submit" id="submit" name="searchSubmit" value="">
                        </form>                       
                    </div>
                </nav>
            </div>
        </header>
    </body> 
</html>