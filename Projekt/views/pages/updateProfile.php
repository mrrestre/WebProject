<?php
if(isset($_POST['submit']))
{
    if( !empty($_POST['newPassword'])
        &&!empty($_POST['repeatPassword']))
        {
            $isPasswordSafe = isPasswordSafe($_POST['newPassword']);
            if($isPasswordSafe == true)
            {
                $password = $_POST['newPassword'];
                $repeatPassword = $_POST['repeatPassword'];
                $userId = $_SESSION['currentUser'];
                if($password === $repeatPassword)
                {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $request = $database->prepare("UPDATE user SET password = ? WHERE userId =? ");
                    
                    $request->execute([$hash, $userId]);

                    echo 'The Update was Successful';
                }
                else{
                    echo 'The password is not the same !!! ';
                }
            }
            else{
                echo 'The Password is not safe enough';
            }
            
        }
}
?>



<div class="all">
    <h3>Update Your Password </h3>

    <form id="passwordForm" name="passwordForm" action="index.php?page=updateProfile" method="POST" onsubmit="return updatePassFormValidation()">
        
        <p>
            <strong>Password must contain:</strong>
            <br>
            Upper Case  
            <br>
            Lower Case
            <br>
            Special character [!@#$%^&*()\-_=+{};:,<.>] 
            <br>
            At least 8 characters long
        </p>    
        
      


        <label for="newPassword">New Password</label><br>
        <input type="password" id="newPassword" name="newPassword" placeholder="New Password" value="<?php if(isset($_POST['newPassword'])) echo htmlspecialchars($_POST['firstName']);?>"><br>

        <label for="repeatPassword">Repeat the New Password</label><br>
        <input type="password" id="repeatPassword" name="repeatPassword" placeholder="Repeat New Password"><br><br>

        <label for="submit">
            <input type="submit" name="submit" id="submit" value="Save Changes">
        </label>

    </form>
</div>
