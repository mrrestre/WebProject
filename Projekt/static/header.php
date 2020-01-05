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
                    <a href="index.php?page=random">Random</a>
                </nav>
           </div>
            
            <div class="header-right">
                <nav>
                    <a href="index.php?page=contact">Contact</a>
                    <a href="index.php?page=login">Login</a>
                    <a href="index.php?page=admin">Admin</a>
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
                case 'random':
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
                default:
                    include(ROOT.'/views/pages/error404.php');
                    break;
            }
            ?>
            
    </section>
</body>

</html>