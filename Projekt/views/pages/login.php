<?php
    $username = getAllUsernamesAndPasswords( $database );   //All usernames (Email + password) are saved in this variables
    $status='';                                             //Just in case something goes wrong 
    $success = false;                                       //Works to determine if the login was succesfull

    if(isset($_POST['submit']))
    {    
        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false)
        {
            $email    = $_POST['email']     ?? null;
            $password = $_POST['password']  ?? null;
            
            foreach ($username as $row)
            {
                $verifyPassword = password_verify($password, $row['password']);

                if($email === $row['eMail'] && $verifyPassword === true)
                {
                    $_SESSION['loggedIn'] = true;

                    $thisUserID = getUserIDByEMail( $database, $email );
                    $thisUserID = $thisUserID[0];
                    $thisUserID = $thisUserID['userId'];

                    $_SESSION['currentUser'] = $thisUserID;
                    
                    $permission = getUsersWithPermission ( $database );

                    $_SESSION['justLoggedIn'] = true;

                    foreach($permission as $row)
                    {
                        if( $row['userId'] === $_SESSION['currentUser'] )
                        {
                            $_SESSION['admin'] = true;
                            break;
                        }
                        else
                        {
                            $_SESSION['admin'] = false;
                        }
                    }
                    $success = true;
                    header('Location: index.php?page=home');
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
            <p> No Account yet? What are you waiting? <a href="index.php?page=registration"><input type="submit" id="submit" name="submit" value="SignUp"> </a></p>
    </body>
</html>