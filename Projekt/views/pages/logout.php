<?php
    if(isset($_SESSION))
    { 
        session_unset();
        session_destroy();
    }
    header('Location: index.php?page=login');

?>