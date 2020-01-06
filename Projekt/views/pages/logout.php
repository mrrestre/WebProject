<? 
    $_SESSION['loggedIn'] = false;
    session_destroy();
    $currentUser = null;
    header('Location: index.php?page=login');
    exit;
    session_start();
?>