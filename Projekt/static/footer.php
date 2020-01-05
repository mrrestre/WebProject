<!DOCTYPE html>


<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link type="text/css" href="./assets/css/footerStyle.css" rel="stylesheet">
    </head>

    <body>
        <footer>
            &copy;TakeTec <?php
                $fromYear = 2019; 
                $thisYear = (int)date('Y'); 
                echo $fromYear . (($fromYear != $thisYear) ? '-' . $thisYear : '');?>.
        </footer>
    </body>

</html>