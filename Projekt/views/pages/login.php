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
                $status = 'Your username or password is wrong';
            }
        }   
    }

?>

<html>
    <body>
        <section class="sectionAll">
            <section class="leftSection" >
                <?php 
                    if(isset($status))
                    {
                        echo "<div class=\"status\">$status</div>"; 
                    }
                ?>    
                <h1 class="salutation">Login</h1>

                <form class ="form" action="index.php?page=login" method="POST" onsubmit="validLoginForm()">
                    <label for="email">E-Mail*</label><span id="toJS" ></span><br>
                    <input type="email" id="email" name="email" placeholder="E-Mail" value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']);?>" required><br>

                    <label for="password">Password*</label><span id="toJS2"></span><br>
                    <input type="password" id="password" name="password" placeholder="Password" required><br>

                    <label for="submit"></label>
                    <input type="submit" class="loginButton" id="submit" name="submit" value="Login">   
                </form>
            </section>
            <section class ="rightSection">
                <p> No Account yet? What are you waiting for? 
                    <br> 
                    <a href="index.php?page=registration"><input type="submit" class="signupButton" id="submit" name="submit" value="Sign Up"></a>
                </p>
            </section>
    </section> <!-- end containerDiv -->
    </body>
</html>