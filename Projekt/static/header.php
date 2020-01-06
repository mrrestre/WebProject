<!DOCTYPE html>
<html lang="en">

<head>
    <link type="text/css" href="./assets/css/headerStyle.css" rel="stylesheet" />
</head>

<body>
    <header>
        <div class="header">
            <a href="index.php?page=home" class="logo">Our Logo</a>
            <div class="header-left">
                <nav>
                    <a href="index.php?page=home">Home</a>
                    <a href="index.php?page=top10">Top10</a>
                    <a href="index.php?page=users">Users</a>
                    <? $random = 0; ?>  <!-- Random Funktion hier hinzüfugen -->
                    <a href="index.php?page=readArticle&newsid=<?echo $random?>">Random</a>
                </nav>
           </div>
           <? $permission = getUsersWithPermission ( $database );?>
           <? $permission = $permission[0]; ?>
            <div class="header-right">
                <nav>
                    <a href="index.php?page=contact">Contact</a>
                    <?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) : ?>
						<a href="index.php?page=profile">Profile</a>
                        <a href="index.php?page=logout">Logout</a>
                        <?php foreach($permission as $row): ?>
                            <? if($row === $currentUser): ?>
                                <a href="index.php?page=admin">Admin</a>
                            <?endif;?>
                        <?php endforeach; ?>
					<?php else : ?>
                        <a href="index.php?page=login">Login</a> 
					<?php endif; ?>
                    <button class="button" type="submit" id="send"><span>Search</span></button>
                    <input class="search" type="text" placeholder="Search.." name="search">
                </nav>
            </div>
        </div>
    </header>
    <section>

    <?php
            // Switch section content based on URI
            switch($page) {
                case '';
                    include(ROOT.'/views/pages/home.php');
                    break;
                case 'home':
                    include(ROOT.'/views/pages/home.php');
                    break;
                case 'top10':
                    include(ROOT.'/views/pages/top10.php');
                    break;
                case 'users':
                    include(ROOT.'/views/pages/users.php');
                    break;    
                case 'readArticle':
                    include(ROOT.'/views/pages/readArticle.php');
                    break;
                case 'contact':
                    include(ROOT.'/views/pages/contact.php');
                    break;
                case 'admin':
                    include(ROOT.'/views/pages/admin.php');
                    break;
                case 'login':
                    include(ROOT.'/views/pages/login.php');
                    break;
                case 'logout':
                    include(ROOT.'/views/pages/logout.php');
                    break;
                case 'profile':
                    include(ROOT.'/views/pages/profile.php');
                    break;
                case 'registration':
                    include(ROOT.'/views/pages/registration.php');
                    break; 
                default:
                    include(ROOT.'/views/pages/error404.php');
                    break;
            }
            ?>
            
    </section>
</body>

</html>