<!DOCTYPE html>
<html lang="en">

<head>
    <link type="text/css" href="./assets/css/footerStyle.css" rel="stylesheet" />
</head>

<html>
    <body>
        <footer>
            &copy;TakeTec <?php
                $fromYear = 2019; 
                $thisYear = (int)date('Y'); 
                echo $fromYear . (($fromYear != $thisYear) ? '-' . $thisYear : '');
                echo "<br>"?>
            <a href="index.php?page=impressum">Impressum</a>
        </footer>
    </body>

</html>