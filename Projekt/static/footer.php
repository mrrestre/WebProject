<!DOCTYPE html>
<html lang="en">

<head>
    <link type="text/css" href="./assets/css/footerStyle.css" rel="stylesheet" />
</head>

<html>
    <body>
        <footer>
            <h4>&copy;TakeTec <?php
                $fromYear = 2019; 
                // Actual date always!
                $thisYear = (int)date('Y'); 
                echo $fromYear . (($fromYear != $thisYear) ? '-' . $thisYear : '');
                echo "<br>"?></h4>
            <a href="index.php?page=impressum">Impressum</a>
        </footer>
    </body>

</html>