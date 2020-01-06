<?
$username = getAllUsernamesAndPasswords( $database );
$status='';
$success = false;
if(isset($_POST['submit']))
{    
    if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false)
	{
		$email    = $_POST['email'] ?? null;
		$password = $_POST['password'] ?? null;

        foreach ($username as $row)
        {
            
            if($email === $row['eMail'] && $password === $row['password'])
            {
                $_SESSION['loggedIn'] = true;
                $GLOBALS['currentUser'] = getUserIDFromLogin( $database, $email );
                header('Location: index.php?page=home');
                $success = true;
            }
        }
        if (!$success)
	    {
		    echo 'Your username or password is wrong';
	    }
	}
	
}

?>

<html>
    <head>  
        <!-- hier den css von home hinzüfugen -->
    </head>
    <body>
        <h1>Welcome to Login</h1>
        <div class="loginclass">
            <form action="index.php?page=login" method="POST">
                <label for="email">E-Mail*</label><br>
                <input type="email" id="email" name="email" placeholder="E-Mail" required><br>

                <label for="password">Password*</label><br>
                <input type="password" id="password" name="password" placeholder="Password" required><br>

                <label for="submit"></label>
                <input type="submit" id="submit" name="submit" value="Login">   
            </form>
        </div>
            <p> No Account yet !! <a href="index.php?page=registration"><input type="submit" id="submit" name="submit" value="SignUp"> </a></p>
    </body>
</html>